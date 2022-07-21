<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $sliders = slider::all();
        $ftm_news = ftm_new::orderBy('date', 'desc')->take(1)->get();
        $fm_news = ftm_new::orderBy('date', 'desc')->take(12)->get();
        $clips = video::orderBy('date_news', 'asc')->take(2)->get();
        return view('welcome',
            compact('generals','colors' , 'headers' ,'footers' ,'sliders','ftm_news','fm_news','clips','videos'));
    }
}
