<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newOrder(){

        $orders = DB::table('orders')->where('status',0)->get();

        return view('admin.order.pending_order',compact('orders'));
    }

    public function viewOrder($id){

        $order=DB::table('orders')->join('users','orders.user_id','users.id')->select('users.name','users.phone','orders.*')->where('orders.id',$id)->first();

        $shipping=DB::table('shipping')->where('order_id',$id)->first();

        $details=DB::table('order_details')->join('products','order_details.product_id','products.id')->select('products.product_code','products.image_one','order_details.*')->where('order_details.order_id',$id)->get();


         return view('admin.order.view_order',compact('order','shipping','details'));
    }

    public function acceptOrder($id){
        DB::table('orders')->where('id',$id)->update(['status'=>1]);
        $notification=array(
                 'messege'=>'Accept Done',
                 'alert-type'=>'success'
                       );
        return redirect()->route('new.pending.orders')->with($notification);
    }

    public function cancelOrder($id){
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        $notification=array(
                 'messege'=>'Order Cancel',
                 'alert-type'=>'success'
                       );
        return redirect()->route('new.pending.orders')->with($notification);
    }

    public function acceptAllOrder()
    {
         $orders=DB::table('orders')->where('status',1)->get();
         return view('admin.order.pending_order',compact('orders'));
    }

    public function cancelAllOrder()
    {
        $orders=DB::table('orders')->where('status',4)->get();
         return view('admin.order.pending_order',compact('orders'));
    }

    public function progressAllOrder()
    {
         $orders=DB::table('orders')->where('status',2)->get();
         return view('admin.order.pending_order',compact('orders'));
    }

    public function successAllOrder()
    {
         $orders=DB::table('orders')->where('status',3)->get();
         return view('admin.order.pending_order',compact('orders'));
    }

    public function deliveryProgress($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>2]);
        $notification=array(
                 'messege'=>'Send To delivery',
                 'alert-type'=>'success'
                       );
        return Redirect()->route('admin.accept.all.orders')->with($notification);
    }

    public function successOrder($id){

        DB::table('orders')->where('id',$id)->update(['status'=>3]);
        $notification=array(
                 'messege'=>'Order Done Successfully',
                 'alert-type'=>'success'
                       );
        return Redirect()->route('new.pending.orders')->with($notification);
    }

}
