<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Service;


class ServiceController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $services = service::orderBy('date', 'desc')->get();
        return view('service.index',
            compact('generals','colors' , 'headers' ,'footers','services'));

    }
    public function view()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $services =service::all();
        return view('service.service',
            compact('generals','colors' , 'headers' ,'footers','services'));

    }

}
