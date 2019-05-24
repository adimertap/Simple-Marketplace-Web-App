<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $products=Product::select('products.id', 'product_name','price','image_name','product_category_details.category_id')
            ->join('product_images','products.id','=','product_images.product_id')
            ->join('product_category_details','products.id','=','product_category_details.product_id')
            ->groupBy('products.id')
            ->orderBy('products.created_at','desc')
            ->get();
        return view('frontEnd.index',compact("products"));
    }
}
