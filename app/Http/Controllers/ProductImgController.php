<?php

namespace App\Http\Controllers;

use App\Product_img;
use Image;
use Illuminate\Http\Request;

class ProductImgController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/admin/product_img/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    //     $this->validate($request, [

    //         'filename' => 'required',
    //         'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

    // ]);
    
    // if($request->hasfile('filename'))
    //  {
    //     foreach($request->file('filename') as $image)
    //     {
    //         $name=$image->getClientOriginalName();
    //         $large_image_path=public_path('images/large/'.$filename);
    //         $medium_image_path=public_path('images/medium/'.$filename);
    //         $small_image_path=public_path('images/small/'.$filename);
    //                 //// Resize Images
    //         Image::make($image)->save($large_image_path);
    //         Image::make($image)->resize(600,600)->save($medium_image_path);
    //         Image::make($image)->resize(300,300)->save($small_image_path);
    //         // $image->move($large_image_path);  
    //         $form= new Product_img();   
    //         $form->product_id = "1";
    //         $form->image_name=json_encode($name);  
    //         $form->save()
    //         // $inputData['image']=$filename;
    //         // ImageGallery_model::create($inputData);
    //     }
    //  }

    // return back()->with('success', 'Your images has been successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_img  $product_img
     * @return \Illuminate\Http\Response
     */
    public function show(Product_img $product_img)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_img  $product_img
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_img $product_img)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_img  $product_img
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_img $product_img)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_img  $product_img
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_img $product_img)
    {
        // return ($product_img);

        $delete=Product_img::where('id',$product_img->id)->delete();
        // return ($delete);
        return redirect()->back();
    }


}
