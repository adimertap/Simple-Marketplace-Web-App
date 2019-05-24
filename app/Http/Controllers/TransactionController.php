<?php

namespace App\Http\Controllers;
use App\User;
use App\Admin;
use App\Notifications\AdminNotification;
use App\Transaction;
use App\Transaction_det;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web');

    }
    public function index()
    {
        $transaction = Transaction::select('transactions.id','address','total','courier','timeout','status')->join('couriers','transactions.courier_id','=','couriers.id')->where('user_id',Auth::id())->orderBy('transactions.created_at','desc')->get();
        return view('/frontEnd/transaction_list',compact("transaction"));
    }

    public function markRead(){
        $user = User::find(Auth::id());
        $user->unreadNotifications()->update(['read_at' => now()]);
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        $total_price = 0;
        // return($transaction);
        $data = Transaction_det::join('transactions','transaction_details.transaction_id','=','transactions.id')->join('products','transaction_details.product_id','=','products.id')->where('transaction_id',$transaction->id)->get();
        
        foreach ($data as $key) {
            $total_price+=$key->selling_price*$key->qty;
        }

        return view('/frontEnd/transaction_detail',compact("data","total_price"));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        
        if($request->hasfile('proof_of_payment'))
        {
                $image=$request->file('proof_of_payment');
                $name=$image->getClientOriginalName();
                $large_image_path=public_path('images/large/'.$name);
                $medium_image_path=public_path('images/medium/'.$name);
                $small_image_path=public_path('images/small/'.$name);
                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600,600)->save($medium_image_path);
                Image::make($image)->resize(300,300)->save($small_image_path);
                // $image->move(public_path().'/images/', $name);  
                $transaction->proof_of_payment=$name;    
        }
        $status = $transaction->status;
        if ($status == 'delivered') {
            $transaction->status='success';
            $transaction->save();
            $admin = Admin::first();
            $admin->notify(new AdminNotification("<a href='/admin/transactionAdmin/$transaction->id'>ada transaksi yang berubah status menjadi Success</a>"));
            return redirect()->back();
        }
        else{
            $transaction->status='unverified';   
            $transaction->save();
            $admin = Admin::first();
            $admin->notify(new AdminNotification("<a href='/admin/transactionAdmin/$transaction->id'>ada transaksi yang berubah status menjadi Unverified</a>"));
        }
        
        return redirect('/transaction');
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
            $transaction->status='success';
            $transaction->save();
            return response()->json($transaction);
        
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
