<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Courier::get();
        return view("/admin/courier/index",compact("index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/admin/courier/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $courier = new Courier;
        $courier->courier= $request->courier;
        $courier->save();
        return redirect('/admin/courier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(courier $courier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Courier $courier)
    {
        $test = Courier::find($courier)->first();
        return view("/admin/courier/edit",compact("test"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courier $courier)
    {
        $courier->courier= $request->courier;
        $courier->save();
        return redirect('/admin/courier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(courier $courier)
    {
        Courier::where('id','=',$courier->id)->delete();
        $index = Courier::get();
        return redirect('/admin/courier/');        
    }
}
