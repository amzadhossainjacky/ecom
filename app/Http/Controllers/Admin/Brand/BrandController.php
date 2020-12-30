<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use DB;

class BrandController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function brand(){

        $brand = Brand::all();

        return view('admin.brand.brand', compact('brand', $brand));
    }

    public function storebrand(Request $request){

        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);
    
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        //print_r($image);

        if($image){

            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->insert( $data);

            $notification=array(
                'messege'=>'Successfully Brand Inserted!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->back()->with($notification);

        }else{

            $brand = DB::table('brands')->insert( $data);

            $notification=array(
                'messege'=>'Successfully Brand inserted without image',
                'alert-type'=>'success'
                 );
    
               return Redirect()->back()->with($notification);
        }
    }

    
    public function deletebrand($id){

        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        unlink($image);

        DB::table('brands')->where('id', $id)->delete();

            $notification=array(
            'messege'=>'Successfully Brand Deleted!',
            'alert-type'=>'success'
             );

           return Redirect()->back()->with($notification);

    }

    public function editbrand($id){

        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.brand.edit_brand', compact('brand', $brand));

    }

    public function updatebrand(Request $request, $id){
        
        $old_logo = $request->old_logo;
        $brand = DB::table('brands')->where('id', $id)->first();

        $validatedData = $request->validate([
            'brand_name' => 'required|max:55',
        ]);
    
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        //print_r($image);
        
        if($image){

            unlink($old_logo);
            $image_name = date('dmy_h_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully Brand Updated!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->route('brands')->with($notification);

        }else{

            $brand = DB::table('brands')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully Brand Updated without image',
                'alert-type'=>'success'
                 );
    
                 return Redirect()->route('brands')->with($notification);
        }


        

    }


}
