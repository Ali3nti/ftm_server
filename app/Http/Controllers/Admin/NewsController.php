<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Hekmatinasser\Verta\Verta;
use App\Models\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Panel_admin ;
use App\Models\Ftm_new ;

class NewsController extends Controller
{


    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $ftm_news = ftm_new::all();
        $panel_admins = panel_admin::all();
        return view('admin.news.index' , compact('generals','colors' , 'headers' ,'ftm_news','panel_admins'));
    }

    public function editNews()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $ftm_news = ftm_new::all();
        $panel_admins = panel_admin::all();
        return view('admin.news.editNews' , compact('generals','colors' , 'headers' ,'ftm_news','panel_admins'));
    }

    protected function delete(Request $request)
    {
        DB::table('ftm_news')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!') ;
    }


    protected function active(Request $request)
    {
        DB::table('ftm_news')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('ftm_news')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

    protected function archives(Request $request)
    {
        DB::table('ftm_news')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('archives', 'IT WORKS!') ;
    }

    protected function nonArchive(Request $request)
    {
        DB::table('ftm_news')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('nonArchive', 'IT WORKS!') ;
    }
//    ***************************************************************************

    public function validateWith($validator, Request $request = null)
    {
    }

    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|string',
            'datepicker4' => 'required|string',
            'description_one' => 'required|string',
            'description_two' => 'nullable|string',
            'img_one' => 'required|image|mimes:jpeg,png,jpg',
            'img_two' => 'nullable|image|mimes:jpeg,png,jpg',
            'img_three' => 'nullable|image|mimes:jpeg,png,jpg',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('img_one')) {
            $image = $request->file('img_one');
            $name = str_slug($request->img_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_one = $name;
        }
        if ($request->hasFile('img_two')) {
            $image = $request->file('img_two');
            $name =  str_slug($request->img_two) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_two = $name;

        }
        if ($request->hasFile('img_three')) {
            $image = $request->file('img_three');
            $name = str_slug($request->img_three) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_three = $name;
        }
        $v = verta();
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $code = mt_rand(100000, 999999) ;
        $code = 'news' . $code;
        $ftm_new = new ftm_new($request->all());
        $ftm_new->code = $code;
        $ftm_new->title = $request->title;
        $ftm_new->description_one = $request->description_one;
        $ftm_new->description_two = $request->description_two;
        $ftm_new->img_one = $img_one;
        $ftm_new->img_two = $img_two;
        $ftm_new->img_three = $img_three;
        $ftm_new->ip = $ip;
        $ftm_new->date_news = $request->datepicker4;
        $ftm_new->active = "1";
        $ftm_new->date = $v->formatDate('Y/M/D') ;
        $ftm_new->time = $v->formatTime();
        $ftm_new->save();


        return redirect()->back()->with('record', 'IT WORKS!') ;
    }


//******************************************************edit
    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'date_news' => 'nullable|string',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
            'img_one' => 'nullable|image|mimes:jpeg,png,jpg',
            'img_two' => 'nullable|image|mimes:jpeg,png,jpg',
            'img_three' => 'nullable|image|mimes:jpeg,png,jpg',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('img_one')) {
            $image = $request->file('img_one');
            $name = str_slug($request->img_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_one = $name;
            DB::table('ftm_news')->where('id', '=', $request->id)->update([

                'img_one' => $img_one,
            ]);
        }
        if ($request->hasFile('img_two')) {
            $image = $request->file('img_two');
            $name =  str_slug($request->img_two) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_two = $name;
            DB::table('ftm_news')->where('id', '=', $request->id)->update([

                'img_two' => $img_two,
            ]);

        }
        if ($request->hasFile('img_three')) {
            $image = $request->file('img_three');
            $name = str_slug($request->img_three) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/news');
            $image->move($destinationPath, $name);
            $img_three = $name;
            DB::table('ftm_news')->where('id', '=', $request->id)->update([

                'img_three' => $img_three,
            ]);
        }

        DB::table('ftm_news')->where('id', '=', $request->id)->update([

            'description_one' => $request->description_one,
            'date_news' => $request->date_news,
            'title' => $request->title,
            'description_two' => $request->description_two,

        ]);

        return redirect()->back()->with('edit', 'IT WORKS!') ;
    }







}


