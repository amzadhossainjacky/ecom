<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon(){

        //$coupon = Coupon::all();
        $coupon = DB::table('coupons')->get();

        return view('admin.coupon.coupon', compact('coupon', $coupon));
    }

    public function storeCoupon(Request $request){

        $validatedData = $request->validate([
            'coupon_code' => 'required|unique:coupons|max:55',
            'discount' => 'required|numeric',
        ]);

        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['discount'] = $request->discount;

        DB::table('coupons')->insert($data);

        $notification=array(
            'messege'=>'Successfully Insert Coupon!',
            'alert-type'=>'success'
             );

           return Redirect()->route('coupons')->with($notification);

    }

    public function deleteCoupon($id){

        DB::table('coupons')->where('id', $id)->delete();

        $notification=array(
            'messege'=>'Successfully delete Coupon!',
            'alert-type'=>'success'
             );

           return Redirect()->back()->with($notification);

    }

    public function editCoupon($id){

        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.editCoupon', compact('coupon', $coupon));
    }

    public function updateCoupon(Request $request, $id){

        $validatedData = $request->validate([
            'coupon_code' => 'required|max:55',
            'discount' => 'required|numeric',
        ]);
    
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['discount'] = $request->discount;

        $done=DB::table('coupons')->where('id', $id)->update($data);

        if($done){
            $notification=array(
                'messege'=>'Successfully update!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->route('coupons')->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Nothing to update!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->route('coupons')->with($notification);
        }
    }

    



    
}
