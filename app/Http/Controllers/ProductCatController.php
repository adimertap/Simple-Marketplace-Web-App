<?php

namespace App\Http\Controllers;

use Validator;
use App\Product_cat;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Product_cat::where('parent_id',0)->get();
        return view("/admin/product_cat/index",compact("index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index = Product_cat::where('parent_id',0)->get();
        return view("/admin/product_cat/create",compact("index"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_kategori' => ['required','string','min:4'],
        ]);

        if ($validator->fails()) {
            return redirect('/admin/product_cat/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        if ($request->parent_id == "1") {
            $request->parent_id = $request->parent_id1;
        }
        $product_cat = new Product_cat;
        $product_cat->category_name= $request->nama_kategori;
        $product_cat->parent_id = $request->parent_id;
        $product_cat->save();
        return redirect("admin/product_cat");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_cat  $product_cat
     * @return \Illuminate\Http\Response
     */
    public function show(Product_cat $product_cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_cat  $product_cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_cat $product_cat)
    {
        // return ($product_cat);
        $test = Product_cat::where('id',$product_cat->id)->first();
        return view("/admin/product_cat/edit",compact("test"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_cat  $product_cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_cat $product_cat)
    {
        $product_cat->category_name = $request->nama_kategori;
        $product_cat->save();
        return redirect("/admin/product_cat");    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_cat  $product_cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_cat $product_cat)
    {
        Product_cat::where('id','=',$product_cat->id)->delete();
        $index = Product_cat::get();
        return redirect('/admin/product_cat/');  
    }
}
