<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Transaction;
use App\Transaction_det;
use App\User;
use App\Courier;
use App\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        // return($data);
        $total=$data["total_price"] + $data["service"];

        $cart_datas=Cart::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
            ->join('products','carts.product_id','=','products.id')
            ->leftjoin('discounts','products.id','=','discounts.id_product')
            ->where('user_id',Auth::id())
            ->where('status','notyet')
            ->groupBy('carts.id')
            ->get();
        
        // return($cart_datas);
        foreach ($cart_datas as $cart_data){
            $diskon = Discount::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
            if (!empty($diskon)) {
                $cart_data->price = ((100-$diskon->percentage)*$cart_data->price/100);
                $cart_data->percentage = $diskon->percentage;
            }
            else{
                $cart_data->percentage = "-";
            }
        }
        return view('checkout.review_order',compact('data','total','cart_datas'));
    }

    // public function order(Request $request){
    //     $input_data=$request->all();
    //     // $total_price = $request["data"][1];
    //     // $provinsi = $request["data"][2];
    //     // $kota = $request["data"][3];
    //     // $alamat = $request["data"][4];
    //     // $nama = $request["data"][5];
    //     // $telpon = $request["data"][6];
    //     // $service = $request["data"][7];
    //     return redirect('/cod',compact('input_data'));
    // }

    public function cod(Request $request){
        $data = $request->all();
        $datatransaksi = $data["data"];
        $subtotal = $datatransaksi[1];
        $province = $datatransaksi[2];
        $courier_id = Courier::select('id')->where('courier',$datatransaksi[3])->get()->first(); 
        $regency = $datatransaksi[4];
        $address = $datatransaksi[5];
        $shipping_cost = $datatransaksi[8];
        $user_id = User::select('id')->where('id',Auth::id())->get()->first();        
        $total = $datatransaksi[1]+$datatransaksi[8];

        $transaction = new Transaction;
        $transaction->timeout= Carbon::now()->add(1,'day');
        $transaction->address = $address;
        $transaction->regency = $regency;
        $transaction->province = $province;
        $transaction->total = $total;
        $transaction->shipping_cost = $shipping_cost;
        $transaction->sub_total = $subtotal;
        $transaction->user_id = $user_id->id;
        $transaction->courier_id = $courier_id->id;
        
        $transaction->save();
        
        $cart_datas=Cart::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
            ->join('products','carts.product_id','=','products.id')
            ->leftjoin('discounts','products.id','=','discounts.id_product')
            ->where('user_id',Auth::id())
            ->where('status','notyet')
            ->groupBy('carts.id')
            ->get();
          
            // return($cart_datas);
        
        foreach ($cart_datas as $cart_data){
            $diskon = Discount::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
            $harga = $cart_data->price;
            if (!empty($diskon)) {
              $harga = ((100-$diskon->percentage)*$cart_data->price/100);      
            }
            $transaction_det = new Transaction_det;
            $transaction_det->transaction_id = $transaction->id;
            $transaction_det->product_id = $cart_data->product_id;
            $transaction_det->qty = $cart_data->qty;
            $transaction_det->discount = $cart_data->percentage;
            $transaction_det->selling_price = $harga;
            $transaction_det->save();
        }

        foreach ($cart_datas as $cart_data){
            $cart_data->status = "checkedout";
            $cart_data->save();
        }

        $transaction = Transaction::select('transactions.id','address','total','courier','timeout','status')->join('couriers','transactions.courier_id','=','couriers.id')->where('user_id',Auth::id())->orderBy('transactions.created_at','desc')->orderBy('transactions.created_at','desc')->get();
        return view('/frontEnd/transaction_list',compact("transaction"));
    }
    public function paypal(Request $request){
        $who_buying=Orders_model::where('users_id',Auth::id())->first();
        return view('payment.paypal',compact('who_buying'));
    }
}
