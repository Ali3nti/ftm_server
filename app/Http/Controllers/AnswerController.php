<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;
use App\Models\Footer;
use App\Models\General;
use App\Models\Header;
use App\Models\Answer;
use Verta;



class AnswerController extends Controller
{
    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $answers = answer::all();
        return view('answer.index',
            compact('generals','colors' , 'headers' ,'footers' ,'answers'));

    }
    public function answer_msg()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $answers = answer::all();
        return view('answer.answer_msg',
            compact('generals','colors' , 'headers' ,'footers' ,'answers'));

    }
    public function validateWith($validator, Request $request = null)
    {
    }

    protected function send(Request $request)
    {
        $v = verta();
        $validator = Validator::make($request->all(), [
            'name_family' => 'required|string|min:3',
            'massage' => 'required|string|min:2',
            'mobile' => 'required|string|min:11|max:12',


        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $check = answer::where([['name_family', '=', $request['name_family']], ['massage', '=', $request['massage']]])->first();
        if(!empty($check) ){
            return redirect()->back()->with('check', 'IT WORKS!');
        } else{
            $code = mt_rand(100000, 999999) ;
            $code = 'user' . $code;
            $answer = new answer($request->all());
            $answer->name_family = $request['name_family'];
            $answer->code = $code ;
            $answer->massage = $request['massage'];
            $answer->mobile = $request['mobile'];
            $answer->date = $v->formatDate('Y/M/D') ;
            $answer->time = $v->formatTime() ;
            $answer->ip = $ip;
            $answer->save();
            return redirect()->back()->with('answer', 'IT WORKS!');
        }
    }
    protected function user_send(Request $request)
    {
        $v = verta();
        $validator = Validator::make($request->all(), [
            'massage' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $check = answer::where([['name_family', '=', $request['name_family']], ['massage', '=', $request['massage']]])->first();
        if(!empty($check) ){
            return redirect()->back()->with('check', 'IT WORKS!');
        } else{

            $answer = new answer($request->all());
            $answer->code = $request['code'];
            $answer->name_family = $request['name'];
            $answer->mobile = $request['mobile'];
            $answer->active ="1";
            $answer->massage = $request['massage'];
            $answer->date = $v->formatDate('Y/M/D') ;
            $answer->time = $v->formatTime() ;
            $answer->ip = $ip;
            $answer->save();
            return redirect()->back()->with('answer_user', 'IT WORKS!');
        }
    }
}
