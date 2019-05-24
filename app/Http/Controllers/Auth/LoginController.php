<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function login(Request $request)
    {
        // $this->validate($request,[
        //     'username' => 'required|string',
        //     'password' => 'required|min:8',
        // ]);

        $credential =[
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::guard('web')->attempt($credential,$request->member)){
            return redirect()->intended(route("home"));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
        
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

}
