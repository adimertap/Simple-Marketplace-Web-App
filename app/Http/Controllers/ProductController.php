<?php

namespace App\Http\Controllers;
use DB;
use Intervention\Image\Facades\Image as Image;
use App\Quotation;
use App\Product;
use App\Product_img;
use App\Product_cat;
use App\Product_cat_det;
use App\Discount;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
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
        $index = Product::select('products.id','products.product_name','products.price','description','product_rate','stock','product_images.image_name','product_categories.category_name')
        ->join('product_category_details','products.id','=','product_category_details.product_id')
        ->join('product_images','products.id','=','product_images.product_id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->groupBy('products.id')
        ->get();
        return view("/admin/product/index",compact("index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Product_cat::where('parent_id','!=',0)->get();
        return view("/admin/product/create",compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->product_name= $request->nama_produk;
        $product->price= $request->harga;
        $product->description= $request->deskripsi;
        $product->product_rate= $request->rating;
        $product->stock= $request->stok;
        $product->save();
        
        if(!empty($request->dis)){
            $dis = new Discount;
            $dis->id_product = $product->id;
            $dis->percentage = $request->persentase;
            $dis->start = $request->tanggal_mulai;
            $dis->end=$request->tanggal_akhir;
            $dis->save();
        }

        if(is_array($request->kategori)){
            foreach($request->kategori as $kat){
                $parent = Product_cat::select('parent_id')->where('id',$kat)->get()->first();
                $cek = Product_cat_det::where('category_id',$parent->parent_id)->where('product_id',$product->id)->get();
                if (!empty($cek)) {
                    $cat = new Product_cat_det;
                    $cat->product_id = $product->id;
                    $cat->category_id = $parent->parent_id;
                    $cat->save();
                }
                $cat = new Product_cat_det;
                $cat->product_id = $product->id;
                $cat->category_id = $kat;
                $cat->save();
            }
        }
        
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);      

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {                
                $name=$image->getClientOriginalName();
                $large_image_path=public_path('images/large/'.$name);
                $medium_image_path=public_path('images/medium/'.$name);
                $small_image_path=public_path('images/small/'.$name);
                        //// Resize Images
                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600,600)->save($medium_image_path);
                Image::make($image)->resize(300,300)->save($small_image_path);
                // $image->move(public_path().'/images/', $name);  
                $form= new Product_img();   
                $form->product_id = $product->id;
                $form->image_name=$name;  
                $form->save();       
            }
        }
        

        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $test = Product::find($product)->first();
        $cat = Product_cat_det::select('category_id')->where('product_id',$product->id)->get();
        $diskon = Discount::where('id_product',$product->id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
        // return($diskon);
        $category = Product_cat::where('parent_id','!=',0)->get();
        $img = Product_img::select('id','image_name')->where('product_id','=',$product->id)->get();
        return view("/admin/product/edit",compact("test","cat","img","category","diskon"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // return($product);

        $product->product_name= $request->nama_produk;
        $product->price= $request->harga;
        $product->description= $request->deskripsi;
        $product->stock= $request->stok;
        $product->save();

        Product_cat_det::where('product_id',$product->id)->delete();
        if(is_array($request->kategori)){
            foreach($request->kategori as $kat){
                $parent = Product_cat::select('parent_id')->where('id',$kat)->get()->first();
                $cek = Product_cat_det::where('category_id',$parent->parent_id)->where('product_id',$product->id)->get();
                if (!empty($cek)) {
                    $cat = new Product_cat_det;
                    $cat->product_id = $product->id;
                    $cat->category_id = $parent->parent_id;
                    $cat->save();
                }
                $cat = new Product_cat_det;
                $cat->product_id = $product->id;
                $cat->category_id = $kat;
                $cat->save();
            }
        }

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {                
                $name=$image->getClientOriginalName();
                $large_image_path=public_path('images/large/'.$name);
                $medium_image_path=public_path('images/medium/'.$name);
                $small_image_path=public_path('images/small/'.$name);
                        //// Resize Images
                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600,600)->save($medium_image_path);
                Image::make($image)->resize(300,300)->save($small_image_path);
                // $image->move(public_path().'/images/', $name);  
                $form= new Product_img();   
                $form->product_id = $product->id;
                $form->image_name=$name;  
                $form->save();       
            }
        }

        if(!empty($request->dis)){
            Discount::where('id_product',$product->id)->delete();
            $dis = new Discount;
            $dis->id_product = $product->id;
            $dis->percentage = $request->persentase;
            $dis->start = $request->tanggal_mulai;
            $dis->end=$request->tanggal_akhir;
            $dis->save();
        }

        
        
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        Product::where('id','=',$product->id)->delete();
        return redirect('/admin/product/')->with('message','Data Berhasil Dihapus');           
    }
}
