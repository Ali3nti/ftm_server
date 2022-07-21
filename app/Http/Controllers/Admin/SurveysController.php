<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Survey;
use App\Models\Answer;
use App\Models\Panel_admin ;


class SurveysController extends Controller
{

    public function validateWith($validator, Request $request = null)
    {
    }

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $answers = answer::all();
        $panel_admins = panel_admin::all();
        $surveys = survey::orderBy('date', 'desc')->get();
        return view('admin.surveys.index',
            compact('generals','colors' , 'headers' ,'footers','surveys','panel_admins','answers'));

    }

    //    ***********************record
    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer_one' => 'required|string',
            'answer_two' => 'required|string',
            'answer_three' => 'required|string',
            'answer_four' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $survey = new survey($request->all());
        $survey->question =  $request->question;
        $survey->answer_one =   $request->answer_one;
        $survey->answer_two =    $request->description_one;
        $survey->answer_three =    $request->answer_three;
        $survey->answer_four =    $request->answer_four;
        $survey->active =    "1";
        $survey->save();

        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
    public function delete(Request $request)
    {
        DB::table('surveys')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active(Request $request)
    {
        DB::table('surveys')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('surveys')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

    public function delete_answer(Request $request)
    {
        DB::table('answers')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active_answer(Request $request)
    {
        DB::table('answers')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive_answer(Request $request)
    {
        DB::table('answers')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }


//    ****************************************************edit
    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'question' => 'required|string',
            'answer_one' => 'required|string',
            'answer_two' => 'required|string',
            'answer_three' => 'required|string',
            'answer_four' => 'required|string',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        DB::table('surveys')->where('id', '=', $request->id)->update([

            'question' => $request->question,
            'answer_one' => $request->answer_one,
            'answer_two' => $request->answer_two,
            'answer_three' => $request->answer_three,
            'answer_four' => $request->answer_four,


        ]);

        return redirect()->back()->with('edit', 'IT WORKS!') ;




    }


}
