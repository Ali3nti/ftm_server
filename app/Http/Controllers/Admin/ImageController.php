<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Image;
use App\Models\Panel_admin ;

class ImageController extends Controller
{
    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $images = image::all();
        $panel_admins = panel_admin::all();
        return view('admin.image.index' , compact('generals','colors' , 'headers' ,'images','panel_admins'));
    }

    public function editImages()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $images = image::all();
        $panel_admins = panel_admin::all();
        return view('admin.image.editImages' , compact('generals','colors' , 'headers' ,'images','panel_admins'));
    }

    public function validateWith($validator, Request $request = null)
    {
    }
    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|string',
            'group_img' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug($request->image) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            $image_ftm = $name;
        }

        $v = verta();
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $code = mt_rand(100000, 999999) ;
        $code = 'img' . $code;
        $images = new image($request->all());
        $images->code = $code;
        $images->title = $request->title;
        $images->description = $request->description;
        $images->image = $image_ftm;
        $images->group_img =  $request->group_img;
        $images->ip = $ip;
        $images->active = "1";
        $images->date = $v->formatDate('Y/M/D') ;
        $images->time = $v->formatTime();
        $images->save();
        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'group_img' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        DB::table('images')->where('id', '=', $request->id)->update([

            'description' => $request->description,
            'group_img' => $request->group_img,
            'title' => $request->title,
        ]);
        return redirect()->back()->with('edit', 'IT WORKS!') ;
    }

    protected function delete(Request $request)
    {
        DB::table('images')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!') ;
    }


    protected function active(Request $request)
    {
        DB::table('images')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('images')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

}


