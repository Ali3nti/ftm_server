<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Question;
use App\Models\Panel_admin ;

class QuestionController extends Controller
{
       public function validateWith($validator, Request $request = null)
    {
    }

    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'description_one' => 'nullable|string',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        DB::table('questions')->where('id', '=', $request->id)->update([

            'title' => $request->title,
            'description_one' => $request->description_one,

        ]);

        return redirect()->back()->with('question', 'IT WORKS!') ;




    }
    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $questions = question::all();
        $panel_admins = panel_admin::all();
        return view('admin.questions.index' , compact('generals','colors' , 'headers' ,'panel_admins','questions'));
    }




    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'description_one' => 'nullable|string',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $question = new question($request->all());
        $question->title =   $request->title;
        $question->description_one =    $request->description_one;
        $question->active = "1";
        $question->save();

        return redirect()->back()->with('record', 'IT WORKS!') ;



    }


    public function delete(Request $request)
    {
        DB::table('questions')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active(Request $request)
    {
        DB::table('questions')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('questions')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }
}
