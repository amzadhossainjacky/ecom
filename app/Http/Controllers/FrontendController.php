<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $featured = DB::table('products')->where('status', 1)->orderBy('id', 'desc')->limit(24)->get();
        $trend = DB::table('products')->where('status', 1)->where('trend',1)->orderBy('id', 'desc')->limit(24)->get();
        $best_rated = DB::table('products')->where('status', 1)->where('best_rated',1)->orderBy('id', 'desc')->limit(24)->get();
        $hot_deal = DB::table('products')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->select('products.*', 'brands.brand_name','categories.category_name')
                    ->where('products.status', 1)
                    ->where('products.hot_deal',1)->orderBy('id', 'desc')->limit(4)->get();
        $mid_slider = DB::table('products')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->select('products.*', 'brands.brand_name','categories.category_name')
                    ->where('products.status', 1)
                    ->where('products.mid_slider',1)->orderBy('id', 'desc')->limit(3)->get();

        return view('pages.index', compact('featured','trend','best_rated', 'hot_deal', 'mid_slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
