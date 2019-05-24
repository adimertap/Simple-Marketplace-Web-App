@extends('frontEnd.layouts.master')
@section('title','Detail Page')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('frontEnd.layouts.category_menu')
            </div>
            <div class="col-sm-9 padding-right">
                @if(Session::has('message'))
                    <div class="alert alert-success text-center" role="alert">
                        {{Session::get('message')}}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{Session::get('success')}} <b><a href="/viewcart">View cart</a></b>
                    </div>
                @endif
        <div class="product-details"><!--product-details-->

            <div class="col-sm-5">
                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a href="{{url('images/large',$detail_product->image_name)}}">
                        <img src="{{url('images/small',$detail_product->image_name)}}" alt="" id="dynamicImage"/>
                    </a>
                </div>

                <ul class="thumbnails" style="margin-left: -10px;">
                    <li><table>
                        @foreach($imagesGalleries as $imagesGallery)
                            <td><a href="{{url('images/large',$imagesGallery->image_name)}}" data-standard="{{url('images/small',$imagesGallery->image_name)}}">
                                <img src="{{url('images/small',$imagesGallery->image_name)}}" alt="" width="75" style="padding: 8px;">
                            </a></td>
                        @endforeach
                    </li></table>
                </ul>
            </div>
            <div class="col-sm-7">
                <form action="{{route('addToCart')}}" method="post" role="form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$detail_product->id}}">
                    <input type="hidden" name="product_name" value="{{$detail_product->product_name}}">
                    <input type="hidden" name="price" value="{{$detail_product->price}}" id="dynamicPriceInput">
                    <input type="hidden" name="stock" value="{{$detail_product->stock}}">

                    <div class="product-information"><!--/product-information-->
                        <img src="{{asset('frontEnd/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                        <h2>{{$detail_product->product_name}}</h2>
                            
                        {{-- <p>Code ID: {{$detail_product->p_code}}</p> --}}
                        {{-- <span>
                            <select name="size" id="idSize" class="form-control">
                        	<option value="">Select Size</option>
                            @foreach($detail_product->attributes as $attrs)
                                <option value="{{$detail_product->id}}-{{$attrs->size}}">{{$attrs->size}}</option>
                            @endforeach
                        </select>
                        </span><br> --}}
                        
                        <span>
                            <span id="dynamic_price">Rp {{number_format($detail_product->price)}}</span>
                            <label>Quantity:</label>
                            <input type="text" name="quantity" id="inputStock"/>
                        </br>

                            @if($detail_product->stock >0)
                            <button type="submit" class="btn btn-info cart" id="buttonAddToCart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                            @endif
                        </span>
                        
                        <p><b>Availability:</b>
                            @if($detail_product->stock >0)
                                <span id="availableStock">In Stock</span>
                            @else
                                <span id="availableStock">Out of Stock</span>
                            @endif
                        </p>
                        <p><b>Condition:</b> New</p>

                        <p><b>Discount:</b>@if(empty($dis)) None @else {{$dis->percentage}}% untill {{date('d M Y', strtotime($dis->end))}} @endif</p>
                        <p>
                            @php
                                $a = 5;
                            @endphp
                            @for($i=0 ; $i< $detail_product->product_rate; $i++)
                                @php
                                    $a = $a-1;
                                @endphp
                                <span style="color: gold;" class="fa fa-star checked"></span>
                            @endfor
                            @for($i=0 ; $i< $a; $i++)
                                <span style="color: grey;" class="fa fa-star"></span>
                            @endfor
                        </p>
                        {{-- <a href=""><img src="{{asset('frontEnd/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a> --}}
                    </div><!--/product-information-->
                </form>

            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
                    {{-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li> --}}
                </ul>
            </div>
            <div class="tab-content" id="reviews">
                <div class="tab-pane fade active in"  >
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9">
                        @foreach($review as $review)
                            <p><b>{{$review->name}}</b></p>
                            @php
                                $a = 5;
                            @endphp
                            @for($i=0 ; $i< $review->rate; $i++)
                                @php
                                    $a = $a-1;
                                @endphp
                                <span style="color: gold;" class="fa fa-star checked"></span>
                            @endfor
                            @for($i=0 ; $i< $a; $i++)
                                <span style="color: grey;" class="fa fa-star"></span>
                            @endfor
                            <input style="background-color: white;" type="text" readonly="" class="form-control" value="{{$review->content}}">
                            <hr>

                        @endforeach
                        </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="companyprofile" >
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('frontEnd/images/home/gallery1.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('frontEnd/images/home/gallery3.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('frontEnd/images/home/gallery2.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('frontEnd/images/home/gallery4.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
                                        <span>
                                            <input type="text" placeholder="Your Name"/>
                                            <input type="email" placeholder="Email Address"/>
                                        </span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="{{asset('frontEnd/images/product-details/rating.png')}}" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    </div>
</div>
</div>

              
@endsection