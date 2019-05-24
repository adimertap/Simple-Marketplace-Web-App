@extends('frontEnd.layouts.master')
@section('title','List Products')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('frontEnd.layouts.category_menu')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php
                            if($byCate!=""){
                                $products=$list_product;
                                echo '<h2 class="title text-center">Category '.$byCate->category_name.'</h2>';
                            }else{
                                echo '<h2 class="title text-center">List Products</h2>';
                            }
                    ?>
                    @foreach($products as $product)
                        
                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product-detail',$product->id)}}"><img src="{{asset('images/small/'.$product['image_name']) }}" alt="" /></a>
                                        <h2>Rp {{number_format($product->price)}}</h2>
                                        <p>{{$product->product_name}}</p>
                                        <a href="{{url('/product-detail',$product->id)}}" class="btn btn-warning add-to-cart">View Product</a>
                                    </div>
                                </div>
                                {{-- <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        
                    @endforeach
                    {{--<ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>--}}
                </div><!--features_items-->
            </div>
        </div>
    </div>
@endsection