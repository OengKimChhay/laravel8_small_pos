<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; //have to add this line
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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if(Auth()->user()->role == 1){
            return route('admin.dashboard');
        }else if(Auth()->user()->role == 2){
            return route('user.home');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $req){
        $this->validate($req,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $input = $req->all();
        $remember = $req->has('remember') ? true : false;
        if(auth()->attempt(array('email'=>$input['email'],'password'=>$input['password']),$remember)){
            if(auth()->user()->role == 1){
                return redirect()->route('admin.dashboard');
            }else if(auth()->user()->role == 2){
                return redirect()->route('user.home');
            }else{
                return redirect()->route('login')->with('error','You can not login at this moment!');   
            }
        }else{
            return redirect()->route('login')->with('error','Wrong Email or Password');
        }
    }
}
