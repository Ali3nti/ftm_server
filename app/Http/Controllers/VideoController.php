<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Video;


class VideoController extends Controller
{

    public function index(Request $request)
    {
        $videos = video::where('id', '=', $request->id)->first();
        $visit = $videos->visit ;
        $visit = $visit + 1 ;
        DB::table('videos')->where('id', '=', $request->id)->update([
            'visit' => $visit ,

        ]);
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $videos = video::orderBy('date', 'desc')->get();
        return view('video.index',
            compact('generals','colors' , 'headers' ,'footers','videos'));

    }
    public function all_video()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $videos = video::orderBy('date', 'desc')->get();
        return view('video.ftmVideos',
            compact('generals','colors' , 'headers' ,'footers','videos'));

    }

}
