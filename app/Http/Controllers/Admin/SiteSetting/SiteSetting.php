<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SiteSetting extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting(){

        $setting = DB::table('sitesetting')->first();

        return view('admin.sitesetting.site_setting',compact('setting'));
    }

    public function updateSetting(Request $request){

        $id = $request->id;
        $data = array();
        $data['phone_one']= $request->phone_one;
        $data['phone_two']= $request->phone_two;
        $data['email']= $request->email;
        $data['company_name']= $request->company_name;
        $data['company_address']= $request->company_address;
        $data['facebook']= $request->facebook;
        $data['instagram']= $request->instagram;
        $data['twitter']= $request->twitter;
        $data['youtube']= $request->youtube;

        DB::table('sitesetting')->where('id', $id)->update($data);

        $notification=array(
            'messege'=>'Successfully Update Site Setting',
             'alert-type'=>'success'
       );

       return redirect()->back()->with($notification);
    }

}
