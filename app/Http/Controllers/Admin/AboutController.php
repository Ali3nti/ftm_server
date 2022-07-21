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
use App\Models\Footer;
use App\Models\About_us ;
use App\Models\Panel_admin ;
use App\Models\License ;
use App\Models\Newspaper ;

class AboutController extends Controller
{



    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $abouts = about_us::all();
        $licenses = license::all();
        $newspapers = newspaper::all();
        $panel_admins = panel_admin::all();
        return view('admin.about.index' , compact('generals','colors' , 'headers' ,'footers','panel_admins','abouts','licenses','newspapers'));
    }

//**************************************************************************************
    public function delete(Request $request)
    {
        DB::table('about_uses')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active(Request $request)
    {
        DB::table('about_uses')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('about_uses')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }
//    *************************************************************************************

    public function delete_paper(Request $request)
    {
        DB::table('newspapers')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active_paper(Request $request)
    {
        DB::table('newspapers')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive_paper(Request $request)
    {
        DB::table('newspapers')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

//*******************************************************************************edit*

    public function validateWith($validator, Request $request = null)
    {
    }

    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if ($request->hasFile('image_one')) {
            $image = $request->file('image_one');
            $name = str_slug($request->image_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/managers/');
            $image->move($destinationPath, $name);
            $image_one = $name;
            DB::table('about_uses')->where('id', '=', $request->id)->update(['image_one' => $image_one,]);
        }

        DB::table('about_uses')->where('id', '=', $request->id)->update([

            'title' => $request->title,
            'description_one' => $request->description_one,
            'description_two' => $request->description_two,

        ]);

        return redirect()->back()->with('edit', 'IT WORKS!') ;

    }
    //********************************************************************************edit_license


    protected function edit_license(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug($request->image) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/licenses/');
            $image->move($destinationPath, $name);
            $image_one = $name;
            DB::table('licenses')->where('id', '=', $request->id)->update(['image' => $image_one,]);
        }

        DB::table('licenses')->where('id', '=', $request->id)->update([

            'title' => $request->title,
            'description' => $request->description,


        ]);

        return redirect()->back()->with('edit', 'IT WORKS!') ;

    }
//    ***********************record
    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $about = new About_us($request->all());
        if ($request->hasFile('image_one')) {
            $image = $request->file('image_one');
            $name = str_slug($request->image_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/managers/');
            $image->move($destinationPath, $name);
            $image_one = $name;
            $about->image_one =  $image_one;
        }

        $about->group_about =  $request->group_about;
        $about->title =   $request->title;
        $about->description_one =    $request->description_one;
        $about->description_two =    $request->description_two;
        $about->date =    $request->datepicker4;
        $about->active =    "1";
        $about->save();

        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
    //    ***********************fiveRecord
    protected function fiveRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'subject' => 'required|string',
            'links' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $v = verta();
        $newspaper = new newspaper($request->all());
        $newspaper->title =   $request->title;
        $newspaper->links =   $request->links;
        $newspaper->subject =   $request->subject;
        $newspaper->date =  $v->formatDate('Y/M/D') ;
        $newspaper->active =    "1";
        $newspaper->save();

        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
    //    *********************************************editPaper
    protected function edit_paper(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'nullable|string',
            'subject' => 'nullable|string',
            'links' => 'nullable|string',


        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        DB::table('newspapers')->where('id', '=', $request->id)->update([

            'title' => $request->title,
            'subject' => $request->subject,
            'links' => $request->links,

        ]);

        return redirect()->back()->with('edit', 'IT WORKS!') ;

    }

    //    ***********************record_license
    protected function record_license(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $license = new license($request->all());
        if ($request->hasFile('image_one')) {
            $image = $request->file('image_one');
            $name = str_slug($request->image_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/licenses/');
            $image->move($destinationPath, $name);
            $image_one = $name;
            $license->image =  $image_one;
        }


        $license->title =   $request->title;
        $license->description =    $request->description;
        $license->active =    "1";
        $license->save();

        return redirect()->back()->with('record', 'IT WORKS!') ;
    }

    public function delete_license(Request $request)
    {
        DB::table('licenses')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }

    protected function active_license(Request $request)
    {
        DB::table('licenses')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive_license(Request $request)
    {
        DB::table('licenses')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }






}


