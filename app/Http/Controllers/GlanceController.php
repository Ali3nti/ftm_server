<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\About_us;


class GlanceController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $about_us = about_us::all();
        return view('glance.index',
            compact('generals','colors' , 'headers' ,'footers','about_us'));

    }


}
