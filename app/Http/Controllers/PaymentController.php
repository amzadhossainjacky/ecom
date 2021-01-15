<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use Session;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function payment(){

        $cart = Cart::content();
        $setting=DB::table('settings')->first();
        $charge=$setting->shipping_charge;
        
        return view('pages.payment.payment',compact('cart', 'charge'));
    }

    public function paymentType(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['paymentType'] = $request->paymentType;

        $setting=DB::table('settings')->first();
        $charge=$setting->shipping_charge;

        if($request->paymentType == 'stripe'){
            

            return view('pages.payment.stripe',compact('data','charge'));
        }
        /* else if($request->paymentType == 'paypal'){
            echo "paypal";
        }
        else if($request->paymentType == 'ideal'){
            echo "ideal";
        } */
        else if($request->paymentType == 'cash'){
           //return response()->json($data);

           $number = mt_rand(10,100000);
           $t=time();
           $random = $number.''.str_replace( '-', '', date('d-m-y')).$t;

           $total =0;
           if(Session::has('coupon')){
                $total =Session::get('coupon')['balance'] + $charge;
                $total = number_format($total, 2,".",",");
           }
                  
           else{
               $subtotal = str_replace( ',', '', Cart::subtotal());
               $total = number_format($subtotal  + $charge, 2,".",",");
           }

       
           $data=array();
           $data['user_id']=Auth::id();
           $data['payment_id']= uniqid();
           $data['paying_amount']=$total;
           //$data['blnc_transaction']=NULL;
           $data['ptype_order_id']=uniqid();
           $data['shipping']=$charge;
           $data['vat']=0;
           $data['total']=$total;
           $data['payment_type']="cash";
            if (Session::has('coupon')) {
                 $data['subtotal']=Session::get('coupon')['balance'];
            }else{
                   $data['subtotal']=str_replace( ',', '', Cart::subtotal()); 
           }
           $data['status']=0;
           $data['status_code']=$random;
           $data['return_order']=0;
           $data['date']=date('d-m-y');
           $data['month']=date('F');
           $data['year']=date('Y');
          // $data['status_code']=mt_rand(100000,999999); 
           $order_id=DB::table('orders')->insertGetId($data);

           // insert shipping details table

               $shipping=array();
               $shipping['order_id']=$order_id;
               $shipping['ship_name']=$request->name;
               $shipping['ship_email']=$request->email;
               $shipping['ship_phone']=$request->phone;
               $shipping['ship_address']=$request->address;
               $shipping['ship_city']=$request->city;
               DB::table('shipping')->insert($shipping);

               //insert data into orderdeatils
               $content=Cart::content();
               $details=array();
               foreach ($content as $row) {
                   $details['order_id']= $order_id;
                   $details['product_id']=$row->id;
                   $details['product_name']=$row->name;
                   $details['color']=$row->options->color;
                   $details['size']=$row->options->size;
                   $details['quantity']=$row->qty;
                   $details['single_price']=$row->price;
                   $details['total_price']=$row->qty * $row->price;
                   DB::table('order_details')->insert($details);
               }
               
               //stock management
               $stock=DB::table('order_details')->where('order_id',$order_id)->get();
               foreach ($stock as $row) {
                   DB::table('products')
                   ->where('id',$row->product_id)
                   ->update(['product_quantity' => DB::raw('product_quantity -'.$row->quantity)]);
               }

               Cart::destroy();
                if (Session::has('coupon')) {
                 Session::forget('coupon');
               }

              $notification=array(
                             'messege'=>'Successfully Payment Done',
                              'alert-type'=>'success'
                        );
                return Redirect()->to('/')->with($notification);
        }

        else{
            $notification=array(
                'messege'=>'Please select a payment type',
                 'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function paymentStripe(Request $request){

        $total=$request->total;

        \Stripe\Stripe::setApiKey('sk_test_51I3JD4AMqB34pHJ0ySwI4mD2DTylJ1QaPaTGZOsGRkJ2jpYg3PifGAVIarIflWicWqtQtJLUJyj4sAsKIE8K9EwH00PJEixnNS');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
            'amount' => $total*100,
            'currency' => 'usd',
            'description' => 'Customer Payment Details',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
            ]);

            //unique number generator
            $number = mt_rand(10,100000);
            $t=time();
            $random = $number.''.str_replace( '-', '', date('d-m-y')).$t;
        
            $data=array();
			$data['user_id']=Auth::id();
			$data['payment_id']=$charge->payment_method;
			$data['paying_amount']=$charge->amount/100;
			$data['blnc_transaction']=$charge->balance_transaction;
			$data['ptype_order_id']=$charge->metadata->order_id;
			$data['shipping']=$request->shipping;
			$data['vat']=$request->vat;
			$data['total']=$request->total;
            $data['payment_type']=$request->payment_type;
			 if (Session::has('coupon')) {
			 	 $data['subtotal']=Session::get('coupon')['balance'];
    	     }else{
    	  	      $data['subtotal']=str_replace( ',', '', Cart::subtotal()); 
    	    }
            $data['status']=0;
    	    $data['status_code']=$random;
    	    $data['return_order']=0;
    	    $data['date']=date('d-m-y');
    	    $data['month']=date('F');
    	    $data['year']=date('Y');
           // $data['status_code']=mt_rand(100000,999999); 
    	    $order_id=DB::table('orders')->insertGetId($data);

    	    // insert shipping details table

    	    	$shipping=array();
    	    	$shipping['order_id']=$order_id;
    	    	$shipping['ship_name']=$request->ship_name;
    	    	$shipping['ship_email']=$request->ship_email;
    	    	$shipping['ship_phone']=$request->ship_phone;
    	    	$shipping['ship_address']=$request->ship_address;
    	    	$shipping['ship_city']=$request->ship_city;
    	    	DB::table('shipping')->insert($shipping);

    	    	//insert data into orderdeatils
    	    	$content=Cart::content();
    	    	$details=array();
    	    	foreach ($content as $row) {
    	    		$details['order_id']= $order_id;
    	    		$details['product_id']=$row->id;
    	    		$details['product_name']=$row->name;
    	    		$details['color']=$row->options->color;
    	    		$details['size']=$row->options->size;
    	    		$details['quantity']=$row->qty;
    	    		$details['single_price']=$row->price;
    	    		$details['total_price']=$row->qty * $row->price;
    	    		DB::table('order_details')->insert($details);
                }
                
                //stock management
                $stock=DB::table('order_details')->where('order_id',$order_id)->get();
                foreach ($stock as $row) {
                    DB::table('products')
                    ->where('id',$row->product_id)
                    ->update(['product_quantity' => DB::raw('product_quantity -'.$row->quantity)]);
                }

    	    	Cart::destroy();
    	    	 if (Session::has('coupon')) {
			 	 Session::forget('coupon');
    	        }

    	       $notification=array(
                              'messege'=>'Successfully Payment Done',
                               'alert-type'=>'success'
                         );
                 return Redirect()->to('/')->with($notification);
    }

}
