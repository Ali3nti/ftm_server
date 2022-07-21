<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\General;
use App\Models\Header ;
use App\Models\Footer;
use App\Models\Product;


class ProductController extends Controller
{

    public function index()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $products =product::orderBy('date', 'desc')->get();
        return view('product.index',
            compact('generals','colors' , 'headers' ,'footers','products'));

    }
    public function view()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $products =product::all();
        return view('product.product',
            compact('generals','colors' , 'headers' ,'footers','products'));

    }


}
