<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'DESC')->limit(10)->get();
        return view('home', compact('orders'));
    }

    public function changePassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();  
                      $notification=array(
                        'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('login')->with($notification); 
                 }else{
                     $notification=array(
                        'messege'=>'New password and Confirm Password not matched!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }     
      }else{
        $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }

    }

    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->to('/')->with($notification);
       

    }

    public function viewOrder($id){
       $order=DB::table('orders')->join('users','orders.user_id','users.id')->select('users.name','users.phone','orders.*')->where('orders.id',$id)->first();

        $shipping=DB::table('shipping')->where('order_id',$id)->first();

        $details=DB::table('order_details')->join('products','order_details.product_id','products.id')->select('products.product_code','products.image_one','order_details.*')->where('order_details.order_id',$id)->get();

         return view('pages.user_order',compact('order','shipping','details'));
    }
}
