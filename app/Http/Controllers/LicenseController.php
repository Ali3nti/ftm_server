<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Verta;
use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\License;


class LicenseController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $licenses = license::all();
        return view('license.index',
            compact('generals','colors' , 'headers' ,'footers','licenses'));

    }
}
