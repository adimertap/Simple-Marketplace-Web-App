@extends('frontEnd.layouts.master')
@section('title','Review Order Page')
@section('slider')
@endsection
@section('content')
	<style type="text/css">
		.container{
			color: black;
		}
	</style>
    <div class="container">
        <h3 class="text-center">YOUR ORDER HAS BEEN PLACED</h3>
        <p class="text-center">Thanks for your Order that use Options on Cash On Delivery</p>
        {{-- <p class="text-center">We will contact you by Your Email (<b>{{$user_order->email}}</b>) --}}
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection