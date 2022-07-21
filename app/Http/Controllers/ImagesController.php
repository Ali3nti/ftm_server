<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Image;



class ImagesController extends Controller
{

    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $images = image::distinct()->where('active', '=', '1')->get(['group_img']);
        return view('image.index',
            compact('generals','colors' , 'headers' ,'footers','images'));

    }
    public function view()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $images =image::all();
        return view('image.image',
            compact('generals','colors' , 'headers' ,'footers','images'));

    }
    public function gallery()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $images =image::all();
        return view('image.gallery',
            compact('generals','colors' , 'headers' ,'footers','images'));

    }


}
