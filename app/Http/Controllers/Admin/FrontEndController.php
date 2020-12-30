<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class FrontEndController extends Controller
{
    //

    public function storeNewsletter(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|unique:newsletters|max:55',
        ]);

        $data = array();
        $data['email'] = $request->email;

        $done =DB::table('newsletters')->insert($data);

        if($done){
            $notification=array(
                'messege'=>'Thank You for Subscribing us!',
                'alert-type'=>'success'
                 );
    
            return redirect()->back()->with($notification);
        }
        else {
            $notification=array(
                'messege'=>'Email is already subscribe',
                'alert-type'=>'danger'
                 );
    
               return redirect()->back()->with($notification);
        }
       
    }
}
