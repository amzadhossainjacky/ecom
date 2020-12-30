<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class WishlistController extends Controller
{
    //

    public function addWishlist($id){

        $user_id = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $user_id)->where('product_id', $id)->first();

        $data = array(
            'user_id'=>$user_id,
            'product_id'=>$id

        );
        
        if (Auth::check()) {
            if ($check) {
                /* $notification=array(
                    'messege'=>'Product has already added to the wishlist!',
                    'alert-type'=>'warning'
                     );
                   return redirect()->back()->with($notification); */
                   
                   return response()->json(['error' => 'Product has already added to the wishlist!']);


                   
            }else{
                DB::table('wishlists')->insert($data);
                //return response::json(['data' => 'Product has been added to the wishlist!']);
                /* $notification=array(
                    'messege'=>'Product has been added to the wishlist!',
                    'alert-type'=>'success'
                     );
                return redirect()->back()->with($notification); */
                return response()->json(['success' => 'Product has been added to the wishlist!']);
            }
            
        }else{
            /* $notification=array(
                'messege'=>'Please, login your account first!',
                'alert-type'=>'error'
                 );
               return redirect()->back()->with($notification); */
              return response()->json(['error' => 'Please, login your account first!']);
        }

    }
}
