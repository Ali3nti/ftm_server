<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Hekmatinasser\Verta\Verta;
use App\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Slider ;
use App\Models\About_us;
use App\Models\Rule;
use App\Models\Question;
use App\Models\Guide;
use App\Models\Ftm_new;
use App\Models\Video;


class UserController extends Controller
{
    public function validateWith($validator, Request $request = null)
    {
    }

    protected function send(Request $request)
    {
        $v = verta();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'mobile' => 'required|string|min:11|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $code = mt_rand(100000, 999999) ;
        $code = 'user' . $code;

        $user = new user($request->all());
        $user->name = $request['name'] ;
        $user->mobile = $request['mobile'] ;
        $user->code = $code ;
        $user->role = "2";
        $user->time= $v->formatTime() ;
        $user->date= $v->formatDate('Y/M/D') ;
        $user->ip= $ip ;
        $user->password = Hash::make($request['password']);
        $user->save();

        auth()->loginUsingId($user->id);

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $sliders = slider::all();
        $ftm_news = ftm_new::orderBy('date', 'desc')->take(1)->get();
        $fm_news = ftm_new::orderBy('date', 'desc')->take(12)->get();
        $videos = video::orderBy('date', 'desc')->take(1)->get();
        $clips = video::orderBy('date_news', 'asc')->take(2)->get();
        return view('welcome', compact('generals','colors' , 'headers' ,'footers' ,'sliders','ftm_news','fm_news','clips','videos'))
            ->with('register', 'IT WORKS!') ;


    }
}
