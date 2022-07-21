<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Footer;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'mobile';
    }

    public function authenticated($request, $user)
    {

        switch ($user->role){
            case 1:
                return redirect(route('admin'));

        }
    }

    public function showLoginForm()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        return view('auth.login', compact('generals','colors' , 'headers' ,'footers'));
    }
}
