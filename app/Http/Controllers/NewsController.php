<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Ftm_new;


class NewsController extends Controller
{

    public function ftm_news()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $ftm_news = ftm_new::orderBy('date', 'desc')->get();
        return view('ftmNews.ftmNews',
            compact('generals','colors' , 'headers' ,'footers','ftm_news'));

    }

    public function ftm_new()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $ftm_news = ftm_new::orderBy('date', 'desc')->get();
        return view('ftmNews.new',
            compact('generals','colors' , 'headers' ,'footers','ftm_news'));

    }
}
