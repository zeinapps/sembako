<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;
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
    protected $redirectTo = '/akun';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function showLoginForm(Request $request)
    {
        $callback = $request->callback ? $request->callback : '';
        return view('eshop.auth.login',['callback' => $callback]);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hp' => 'required|numeric',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
        
        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
        
        
        $login = $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );

        if (!$login) {
            return redirect(url()->previous())
                        ->withErrors(['Hp dan Password tidak sesuai','Jika Anda butuh bantuan hubungi customer service'])
                        ->withInput();
        }
        
        $redirect = $request->callback ? $request->callback : '/akun';
        
        if(Auth::user()->isadmin){
            $redirect = 'home';
        }
        
        return redirect($redirect);
    }
    
    public function username()
    {
        return 'hp';
    }
}
