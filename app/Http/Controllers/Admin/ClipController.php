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
use App\Models\Video;
use App\Models\Panel_admin ;

class ClipController extends Controller
{


    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $videos = video::all();
        $panel_admins = panel_admin::all();
        return view('admin.clips.index' , compact('generals','colors' , 'headers' ,'videos','panel_admins'));
    }
    public function editClips()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $videos = video::all();
        $panel_admins = panel_admin::all();
        return view('admin.clips.editClips' , compact('generals','colors' , 'headers' ,'videos','panel_admins'));
    }

    public function validateWith($validator, Request $request = null)
    {
    }
    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'datepicker4' => 'required|string',
            'description' => 'required|string',
            'img_video' => 'required|image|mimes:jpeg,png,jpg',
            'video' => 'required|mimes:mp4,mov,ogg' ,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('img_video')) {
            $image = $request->file('img_video');
            $name = str_slug($request->img_video) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/videos/img_video/');
            $image->move($destinationPath, $name);
            $img_video = $name;
        }
        if ($request->hasFile('video')) {
            $image = $request->file('video');
            $name =  str_slug($request->video) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/videos/');
            $image->move($destinationPath, $name);
            $videoN = $name;
        }
        $v = verta();
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $code = mt_rand(100000, 999999) ;
        $code = 'clip' . $code;
        $video = new video($request->all());
        $video->code = $code;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->img_video = $img_video;
        $video->video = $videoN;
        $video->ip = $ip;
        $video->date_news = $request->datepicker4;
        $video->active = "1";
        $video->date = $v->formatDate('Y/M/D') ;
        $video->time = $v->formatTime();
        $video->save();
        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
//    ******************************************************edit-img_video
    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'date_news' => 'nullable|string',
            'description' => 'nullable|string',
            'img_video' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('img_video')) {
            $image = $request->file('img_video');
            $name = str_slug($request->img_video) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/videos/img_video/');
            $image->move($destinationPath, $name);
            $img_video = $name;
            DB::table('videos')->where('id', '=', $request->id)->update([
                'img_video' => $img_video,
            ]);
        }
        DB::table('videos')->where('id', '=', $request->id)->update([

            'description' => $request->description,
            'date_news' => $request->date_news,
            'title' => $request->title,
        ]);
        return redirect()->back()->with('edit', 'IT WORKS!') ;
    }
//*************************************************************************************************
    protected function delete(Request $request)
    {
        DB::table('videos')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!') ;
    }


    protected function active(Request $request)
    {
        DB::table('videos')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('videos')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }
}


