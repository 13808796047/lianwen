<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    public function showLoginForm()
    {
        return view('pages.index');
    }
    public function username()
    {
        return 'phone';
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [], [
            $this->username() => '手机号',
        ]);
    }

//    protected function attemptLogin(Request $request)
    //    {
    //        return collect(['username', 'phone'])->contains(function($value) use ($request) {
    //            $account = $request->get($this->username());
    //            $password = $request->get('password');
    //            return $this->guard()->attempt([$value => $account, 'password' => $password], $request->filled('remember'));
    //        });
    //    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
