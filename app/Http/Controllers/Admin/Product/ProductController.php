<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        //all products show

        $products = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->select('products.*', 'categories.category_name','brands.brand_name')
        ->get();

        return view('admin.product.show', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        
        return view('admin.product.create', compact('category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $data = array();
        $data['product_title']= $request->product_title;
        $data['product_code']= $request->product_code;
        $data['product_quantity']= $request->product_quantity;
        $data['category_id']= $request->category_id;
        $data['subcategory_id']= $request->subcategory_id;
        $data['brand_id']= $request->brand_id;
        $data['product_size']= $request->product_size;
        $data['product_color']= $request->product_color;
        $data['selling_price']= $request->selling_price;
        $data['product_details']= $request->product_details;
        $data['video_link']= $request->video_link;
        $data['main_slider']= $request->main_slider;
        $data['hot_deal']= $request->hot_deal;
        $data['best_rated']= $request->best_rated;
        $data['trend']= $request->trend;
        $data['mid_slider']= $request->mid_slider;
        $data['hot_new']= $request->hot_new;
        $data['status']= 1;

        //intervention package use

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one && $image_two && $image_three){
            
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);

            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);

            $data['image_one']='public/media/product/'.$image_one_name;
            $data['image_two']='public/media/product/'.$image_two_name;
            $data['image_three']='public/media/product/'.$image_three_name;
            $product=DB::table('products')->insert($data);

            $notification=array(
                'messege'=>'Successfully product inserted!',
                'alert-type'=>'success'
                 );
    
            return redirect()->back()->with($notification);
        }else{
             
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);

            $data['image_one']='public/media/product/'.$image_one_name;
            $data['image_two']='public/media/product/'.$image_two_name;
            $product=DB::table('products')->insert($data);

            $notification=array(
                'messege'=>'Successfully product inserted!',
                'alert-type'=>'success'
                 );
    
            return redirect()->back()->with($notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //sub category ajax code 
    public function getSubcategory($id){
        $subcat = DB::table('subcategories')->where('category_id', $id)->get();
        return json_encode($subcat);
    }

    public function activeProduct($id){
        DB::table('products')->where('id', $id)->update(['status'=>1]);
        $notification=array(
            'messege'=>'Successfully active product!',
            'alert-type'=>'success'
             );

        return redirect()->back()->with($notification);
    }
    public function inactiveProduct($id){
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        $notification=array(
            'messege'=>'Successfully inactive product!',
            'alert-type'=>'success'
             );

        return redirect()->back()->with($notification);
    }

    public function deleteProduct($id){

        $product= DB::table('products')->where('id', $id)->first();

        $image1 =$product->image_one;
        $image2 =$product->image_two;
        $image3 =$product->image_three;

        if($image1 && $image2 && $image3){
            unlink($image1);
            unlink($image2);
            unlink($image3);

            DB::table('products')->where('id', $id)->delete();
            $notification=array(
            'messege'=>'Successfully delete product!',
            'alert-type'=>'success'
             );

            return redirect()->back()->with($notification);

        }else{
            unlink($image1);
            unlink($image2);

            DB::table('products')->where('id', $id)->delete();
            $notification=array(
            'messege'=>'Successfully delete product!',
            'alert-type'=>'success'
             );

            return redirect()->back()->with($notification);
        }     
    }

    public function viewProduct($id)
    {

        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
        ->select('products.*', 'categories.category_name','brands.brand_name','subcategories.subcategory_name')
        ->where('products.id',$id)
        ->first();

        return view('admin.product.view', compact('product'));
    }

    public function editProduct($id)
    {

        $product = DB::table('products')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();

        return view('admin.product.edit', compact('product','category', 'subcategory', 'brand'));
    }

    public function updateProductWithoutImage(Request $request,$id){
        $data = array();
        $data['product_title']= $request->product_title;
        $data['product_code']= $request->product_code;
        $data['product_quantity']= $request->product_quantity;
        $data['category_id']= $request->category_id;
        $data['subcategory_id']= $request->subcategory_id;
        $data['brand_id']= $request->brand_id;
        $data['product_size']= $request->product_size;
        $data['product_color']= $request->product_color;
        $data['selling_price']= $request->selling_price;
        $data['discount_price']= $request->discount_price;
        $data['product_details']= $request->product_details;
        $data['video_link']= $request->video_link;
        $data['main_slider']= $request->main_slider;
        $data['hot_deal']= $request->hot_deal;
        $data['best_rated']= $request->best_rated;
        $data['trend']= $request->trend;
        $data['mid_slider']= $request->mid_slider;
        $data['hot_new']= $request->hot_new;
        $data['status']= 1;

        $update = DB::table('products')->where('id', $id)->update($data);
            $notification=array(
            'messege'=>'Successfully update product without image!',
            'alert-type'=>'success'
             );

            return redirect()->route('all.product')->with($notification);
    }

    public function updateProductImage(Request $request, $id){
       
        $product= DB::table('products')->where('id', $id)->first();

        $image_one =$request->image_one;
        $image_two=$request->image_two;
        $image_three =$request->image_three;

        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $data= array();

        if($request->has('image_one') && $request->has('image_two') && $request->has('image_three')){
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
            
            $data['image_one']='public/media/product/'.$image_one_name;
            $data['image_two']='public/media/product/'.$image_two_name;
            $data['image_three']='public/media/product/'.$image_three_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully all image updated!',
                'alert-type'=>'success'
                 );
            return redirect()->route('all.product')->with($notification);

        }
        else if($request->has('image_one') && $request->has('image_two')){
            unlink($old_one);
            unlink($old_two);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);

            
            $data['image_one']='public/media/product/'.$image_one_name;
            $data['image_two']='public/media/product/'.$image_two_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image one and two updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }

        else if($request->has('image_one') && $request->has('image_three')){
            unlink($old_one);
            unlink($old_three);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);

            
            $data['image_one']='public/media/product/'.$image_one_name;
            $data['image_three']='public/media/product/'.$image_three_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image one and three updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }
        else if($request->has('image_two') && $request->has('image_three')){
            unlink($old_two);
            unlink($old_three);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);

            
            $data['image_two']='public/media/product/'.$image_two_name;
            $data['image_three']='public/media/product/'.$image_three_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image two and three updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }

        else if($request->has('image_one')){
            unlink($old_one);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image one updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }

        else if($request->has('image_two')){
            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image two updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }

        else if($request->has('image_three')){
            unlink($old_three);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name;

            $product=DB::table('products')->where('id', $id)->update($data);

            $notification=array(
                'messege'=>'Successfully image there updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Successfully nothing updated!',
                'alert-type'=>'success'
                 );
    
            return redirect()->route('all.product')->with($notification);
        }
    }

}
