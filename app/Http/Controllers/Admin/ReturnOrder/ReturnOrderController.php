<?php

namespace App\Http\Controllers\Admin\ReturnOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ReturnOrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function returnOrders(){

        $order = DB::table('orders')->where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('admin.returnorder.return_request', compact('order'));
    }

    public function approveReturn($id){

        DB::table('orders')->where('id', $id)->update(['return_order'=>2, 'status'=> 4]);

        $notification=array(
            'messege'=>'Successfully approve return order',
            'alert-type'=>'success'
             );

        return redirect()->back()->with($notification);
    }

    public function viewAllReturn(){
        $order = DB::table('orders')->where('return_order',1)->orWhere('return_order',2)->orderBy('id', 'DESC')->get();
        return view('admin.returnorder.viewAllReturn', compact('order'));
    }

    
}
