<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Newspaper;


class NewspaperController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $newspapers = newspaper::orderBy('date', 'desc')->get();
        return view('newspaper.index',
            compact('generals','colors' , 'headers' ,'footers','newspapers'));

    }

 
}
