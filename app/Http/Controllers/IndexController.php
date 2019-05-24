<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Product_cat;
use App\Product_img;
use App\Discount;
use App\Review;
use Illuminate\Support\Carbon;
class IndexController extends Controller
{
    public function index(){
        
        $products=Product::select('products.id', 'product_name','price','image_name','product_category_details.category_id')
        	->join('product_images','products.id','=','product_images.product_id')
        	->join('product_category_details','products.id','=','product_category_details.product_id')
        	->groupBy('products.id')
            ->orderBy('products.created_at','desc')
        	->get();
        return view('frontEnd.index',compact('products'));
    } 

    public function listByCat($id){
        $list_product=Product::select('products.id', 'product_name','price','image_name','product_category_details.category_id')
        	->join('product_images','products.id','=','product_images.product_id')
        	->join('product_category_details','products.id','=','product_category_details.product_id')
            ->where('category_id',$id)
        	->groupBy('products.id')
            ->orderBy('products.created_at','desc')
        	->get();
        return($list_product);
        $byCate=Product_cat::select('category_name')->where('id',$id)->first();
        return view('frontEnd.products',compact('list_product','byCate'));
    }

    public function shop(){
        $products=Product::select('products.id', 'product_name','price','image_name','product_category_details.category_id')
            ->join('product_images','products.id','=','product_images.product_id')
            ->join('product_category_details','products.id','=','product_category_details.product_id')
            ->groupBy('products.id')
            ->orderBy('products.created_at','desc')
            ->get();
        $byCate="";
        return view('frontEnd.products',compact('products','byCate'));
    }

    public function detialpro($id){

        $detail_product=Product::select('products.id', 'product_name','product_rate','description','stock','price','image_name','product_category_details.category_id')
        	->join('product_images','products.id','=','product_images.product_id')
        	->join('product_category_details','products.id','=','product_category_details.product_id')
        	->groupBy('products.id')->where('products.id',$id)
        	->get()->first();
        $imagesGalleries=Product_img::where('product_id',$id)->get();
        $dis = Discount::where('id_product',$id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
        $review = Review::join('users','product_reviews.user_id','=','users.id')->where('product_id',$id)->orderBy('product_reviews.created_at','desc')->get();
        
        
        // $relateProducts=Products_model::where([['id','!=',$id],['categories_id',$detail_product->categories_id]])->get();
        return view('frontEnd.product_details',compact('detail_product','imagesGalleries','dis','review'));
    }
    
}
