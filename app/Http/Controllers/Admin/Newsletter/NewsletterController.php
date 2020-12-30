<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsletterController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newsletter(){
        $newsletter = DB::table('newsletters')->get();

        return view('admin.newsletter.newsletter', compact('newsletter', $newsletter));
    }

    public function deleteNewsletter($id){

        DB::table('newsletters')->where('id', $id)->delete();

        $notification=array(
            'messege'=>'Successfully delete Newsletter!',
            'alert-type'=>'success'
             );

        return redirect()->back()->with($notification);
    }
}
