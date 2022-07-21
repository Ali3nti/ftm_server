<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Verta;
use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Survey;
use App\Models\Answer;


class SurveyController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $surveys = survey::orderBy('date', 'desc')->get();
        return view('survey.index',
            compact('generals','colors' , 'headers' ,'footers','surveys'));

    }
    public function validateWith($validator, Request $request = null)
    {
    }

    protected function send(Request $request)
    {
        $v = verta();
        $validator = Validator::make($request->all(), [
            'name_family' => 'nullable|string|min:3',
            'mobile' => 'nullable|string|min:11|max:12',


        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

            $code = mt_rand(100000, 999999) ;
            $code = 'sur' . $code;
            $answer = new answer($request->all());
            $answer->name_family = $request['name_family'];
            $answer->code = $code ;
            $answer->mobile = $request['mobile'];
            $answer->date = $v->formatDate('Y/M/D') ;
            $answer->time = $v->formatTime() ;
            $answer->ip = $ip;
            $answer->question_one =$request['question1'];
            $answer->question_two =$request['question2'];
            $answer->question_three =$request['question3'];
            $answer->question_four =$request['question4'];
            $answer->question_five =$request['question5'];
            $answer->question_six =$request['question6'];
            $answer->question_seven =$request['question7'];
            $answer->question_eight =$request['question8'];
            $answer->question_nine =$request['question9'];
            $answer->question_ten =$request['question10'];
            $answer->answer_one =$request['answer1'];
            $answer->answer_two =$request['answer2'];
            $answer->answer_three =$request['answer3'];
            $answer->answer_four =$request['answer4'];
            $answer->answer_five =$request['answer5'];
            $answer->answer_six =$request['answer6'];
            $answer->answer_seven =$request['answer7'];
            $answer->answer_eight =$request['answer8'];
            $answer->answer_nine =$request['answer9'];
            $answer->answer_ten =$request['answer10'];
            $answer->save();
            return redirect()->back()->with('answer', 'IT WORKS!');
        }


}
