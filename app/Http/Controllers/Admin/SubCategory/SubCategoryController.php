<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;

class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subCategory(){

        $category = Category::all();
        $subcategory = DB::table('subcategories')
                        ->join('categories','subcategories.category_id', 'categories.id')
                        ->select('subcategories.*','categories.category_name')
                        ->get();
        return view('admin.subcategory.subcategory', compact('category', 'subcategory'));
    }

    public function storeSubCategory(Request $request){

        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $data= array();
        $data['category_id']= $request->category_id;
        $data['subcategory_name']= $request->subcategory_name;

        DB::table('subcategories')->insert($data);

        $notification=array(
            'messege'=>'Successfully Insert subcategory!',
            'alert-type'=>'success'
             );

           return Redirect()->route('sub.categories')->with($notification);

    }

    public function editSubCategory($id){
        $subcategory=DB::table('subcategories')->where('id', $id)->first();
        $category=Category::all();

        return view('admin.subcategory.editsubcategory', compact('category', 'subcategory'));
    }

    public function deleteSubCategory($id){
        
        DB::table('subcategories')->where('id', $id)->delete();
        $notification=array(
            'messege'=>'Successfully subcategory deleted!',
            'alert-type'=>'success'
             );

           return Redirect()->back()->with($notification);
    }

    public function updateSubCategory(Request $request, $id){
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id']= $request->category_id;
        $data['subcategory_name']=$request->subcategory_name;

        DB::table('subcategories')->where('id', $id)->update( $data);

        $notification=array(
            'messege'=>'Successfully subcategory updated!',
            'alert-type'=>'success'
             );

           return Redirect()->route('sub.categories')->with($notification);
    }
}
