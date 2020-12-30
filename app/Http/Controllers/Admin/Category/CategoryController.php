<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category(){

        $category = Category::all();

        return view('admin.category.category', compact('category', $category));
    }

    public function storecategory(Request $request){

        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);
    
        $data = array();
        $data['category_name'] = $request->category_name;
        DB::table('categories')->insert($data);

            $notification=array(
            'messege'=>'Successfully Insert!',
            'alert-type'=>'success'
             );

           return Redirect()->back()->with($notification);


        //return view('admin.category.category', compact('category', $category));
    }

    public function deletecategory($id){

        DB::table('categories')->where('id', $id)->delete();

            $notification=array(
            'messege'=>'Successfully Deleted!',
            'alert-type'=>'success'
             );

           return Redirect()->back()->with($notification);


        //return view('admin.category.category', compact('category', $category));
    }

    public function editcategory($id){

        $category=DB::table('categories')->where('id', $id)->first();
        return view('admin.category.editCategory', compact('category', $category));
    }

    public function updatecategory(Request $request, $id){

        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);
    
        $data = array();
        $data['category_name'] = $request->category_name;
        $done =DB::table('categories')->where('id', $id)->update($data);

        if($done){
            $notification=array(
                'messege'=>'Successfully update!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->route('categories')->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Nothing to update!',
                'alert-type'=>'success'
                 );
    
               return Redirect()->route('categories')->with($notification);
        }
    }
}
