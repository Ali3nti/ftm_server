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



class SiteController extends Controller
{
    public function home()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $sliders = slider::all();
        $ftm_news = ftm_new::orderBy('date', 'desc')->take(1)->get();
        $fm_news = ftm_new::orderBy('date', 'desc')->take(12)->get();
        $videos = video::orderBy('date', 'desc')->take(1)->get();
        $clips = video::orderBy('date_news', 'asc')->take(2)->get();
        return view('welcome',
            compact('generals','colors' , 'headers' ,'footers' ,'sliders','ftm_news','fm_news','clips','videos'));

    }

    public function rule()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $rules = rule::all();
        return view('rule',
            compact('generals','colors' , 'headers' ,'footers','rules'));
    }
    public function guide()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $guides = guide::all();
        return view('guide',
            compact('generals','colors' , 'headers' ,'footers','guides'));
    }
    public function questions()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $questions = question::all();
        return view('questions',
            compact('generals','colors' , 'headers' ,'footers','questions'));
    }
        public function license()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        return view('license.index',
            compact('generals','colors' , 'headers' ,'footers'));
    }

    public function img_view(Request $request)
    {

        return view('license.imgView');
    }

}
