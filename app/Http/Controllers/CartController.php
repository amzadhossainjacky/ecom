<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
use Session;

class CartController extends Controller
{
    //

    public function addCart(Request $request){

        $product = DB::table('products')->where('id',$request->product_id)->first();

        if($product->discount_price == NULL){
            if($request->qty <= 0){
                $notification=array(
                    'messege'=>'Please enter valid product quantity',
                    'alert-type'=>'error'
                     );
                return Redirect()->to('/')->with($notification);
            }else{
                $data = array();
                $data['id'] = $product->id;
                $data['name'] = $product->product_title;
                $data['qty'] = $request->qty;
                $data['price'] = $product->selling_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $request->color;
                $data['options']['size'] = $request->size;
                Cart::add($data);

                if(Session::has('coupon')){
                    $subtotal = str_replace( ',', '', Cart::subtotal());
                    session::put('coupon',[
                        'name' => Session::get('coupon')['name'],
                        'discount' => Session::get('coupon')['discount'],
                        'balance' => $subtotal  - ($subtotal * Session::get('coupon')['discount'] /100)
                    ]);
                }
            
                $notification=array(
                    'messege'=>'Successfully added on your cart!',
                    'alert-type'=>'success'
                     );
                return Redirect()->to('/')->with($notification);
            }
           
        }else{

            if($request->qty <= 0){
                $notification=array(
                    'messege'=>'Please enter valid product quantity',
                    'alert-type'=>'error'
                     );
                return Redirect()->to('/')->with($notification);
            }else{
                $data = array();
                $data['id'] = $product->id;
                $data['name'] = $product->product_title;
                $data['qty'] = $request->qty;
                $data['price'] = $product->discount_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $request->color;
                $data['options']['size'] = $request->size;         
                Cart::add($data);

                if(Session::has('coupon')){
                    $subtotal = str_replace( ',', '', Cart::subtotal());
                    session::put('coupon',[
                        'name' => Session::get('coupon')['name'],
                        'discount' => Session::get('coupon')['discount'],
                        'balance' => $subtotal  - ($subtotal * Session::get('coupon')['discount'] /100)
                    ]);
                }
            
                $notification=array(
                    'messege'=>'Successfully added on your cart!',
                    'alert-type'=>'success'
                     );
                return Redirect()->to('/')->with($notification);
            }    
        }
    }

    public function check(){

        $data = Cart::content();
        return response()->json($data);
    }

    public function showCart(){

        $cart = Cart::content();
        return view('pages.show_cart', compact('cart'));
    }

    public function removeCart($rowId){

        Cart::remove($rowId);

        if(Session::has('coupon')){
            $subtotal = str_replace( ',', '', Cart::subtotal());
            session::put('coupon',[
                'name' => Session::get('coupon')['name'],
                'discount' => Session::get('coupon')['discount'],
                'balance' => $subtotal  - ($subtotal * Session::get('coupon')['discount'] /100)
            ]);
        }

        return redirect()->back();
    }

    public function updateCart(Request $request, $rowId){
        
        $qty = $request->qty;
        Cart::update($rowId, $qty);

        if(Session::has('coupon')){
            $subtotal = str_replace( ',', '', Cart::subtotal());
            session::put('coupon',[
                'name' => Session::get('coupon')['name'],
                'discount' => Session::get('coupon')['discount'],
                'balance' => $subtotal  - ($subtotal * Session::get('coupon')['discount'] /100)
            ]);
        }
        
        return redirect()->back();
    }

    public function showWishlists(){

        $user_id = Auth::id();

        if(Auth::check()){
            $product = DB::table('wishlists')
                        ->join('products','wishlists.product_id', 'products.id')
                        ->select('products.*','wishlists.user_id')
                        ->where('wishlists.user_id',$user_id)
                        ->get();

            //return response()->json($product);

            return view('pages.show_wishlists',compact('product'));
        }
    }

    public function checkout(){
        
        if(Auth::check()) {

            if(Cart::count() == 0){
                Session::forget('coupon');
            }

            $cart=Cart::content();
            return view('pages.checkout',compact('cart'));

            }else{
                $notification=array(
                            'messege'=>'At first login your account',
                             'alert-type'=>'success'
                       );
            return redirect()->route('login')->with($notification);
      }
    }

    public function couponApply(Request $request){

        $coupon=$request->coupon;
        $check=DB::table('coupons')->where('coupon_code',$coupon)->first();
        $subtotal = str_replace( ',', '', Cart::subtotal());

        if ($check) {
              session::put('coupon',[
                  'name' => $check->coupon_code,
                  'discount' => $check->discount,
                  'balance' => $subtotal  - ($subtotal * $check->discount /100)
              ]);
              $notification=array(
                              'messege'=>'Successfully Coupon Applied',
                               'alert-type'=>'success'
                         );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                              'messege'=>'Invalid Coupon',
                               'alert-type'=>'error'
                         );
            return redirect()->back()->with($notification);
        }
    }

    public function couponRemove(){
        Session::forget('coupon');
        $notification=array(
            'messege'=>'Successfully Coupon Destroy',
             'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    
}
