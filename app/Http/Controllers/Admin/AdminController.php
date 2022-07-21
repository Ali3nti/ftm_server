<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Slider;
use App\Models\Panel_admin ;


class AdminController extends Controller
{

    public function validateWith($validator, Request $request = null)
    {
    }

    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [


            'website' => 'nullable|string',
            'maps' => 'nullable|string',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'keywords_fa' => 'nullable|string',
            'keywords_en' => 'nullable|string',
            'company' => 'nullable|string',
            'company_code' => 'nullable|string',
            'postal_code' => 'nullable|string|min:10|max:11',
            'telephone' => 'nullable|string|min:10|max:11',
            'country' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'village' => 'nullable|string',
            'address' => 'nullable|string',
            'address_two' => 'nullable|string',
            'last_name' => 'nullable|string|max:255|min:3',
            'first_name' => 'nullable|string|max:255|min:3',
            'mobile' => 'nullable|string|min:11',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $name = str_slug($request->img) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            $nameImg = $name;
            DB::table('generals')->update(['img'=>$nameImg]);

        }
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name =  str_slug($request->logo) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/logo');
            $image->move($destinationPath, $name);
            $nameLogo = $name;
            DB::table('generals')->update(['logo'=>$nameLogo]);
        }
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $name = str_slug($request->favicon) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/favicon');
            $image->move($destinationPath, $name);
            $nameFavicon = $name;
            DB::table('generals')->update(['favicon'=>$nameFavicon]);
        }
        DB::table('generals')->update([


            'website' => $request->website,
            'maps' => $request->maps,
            'title' => $request->title,
            'description' => $request->description,
            'keywords_fa' => $request->keywords_fa,
            'keywords_en' => $request->keywords_en,
            'company' => $request->company,
            'company_code' => $request->company_code,
            'postal_code' => $request->postal_code,
            'telephone' => $request->telephone,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'village' => $request->village,
            'address' => $request->address,
            'address_two' => $request->address_two,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'mobile' => $request->mobile,
            'email' => $request->email,

        ]);

        return redirect()->back()->with('general', 'IT WORKS!') ;
    }
     protected function slider_edit(Request $request)
    {
        $validator = Validator::make($request->all(), [

        'slider_img' => 'nullable|image|mimes:jpeg,png,jpg',
        'slider_img_one' => 'nullable|image|mimes:jpeg,png,jpg',
        'slider_img_two' => 'nullable|image|mimes:jpeg,png,jpg',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        if ($request->hasFile('slider_img')) {
        $image = $request->file('slider_img');
        $name = str_slug($request->slider_img) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/slider');
        $image->move($destinationPath, $name);
        $nameImg = $name;
        DB::table('sliders')->update([
            'slider_img'=>$nameImg ,
            'active' => '1',

        ]);

    }
        if ($request->hasFile('slider_img_one')) {
            $image = $request->file('slider_img_one');
            $name = str_slug($request->slider_img_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/slider');
            $image->move($destinationPath, $name);
            $nameImg2 = $name;
            DB::table('sliders')->update([
                'slider_img_one'=>$nameImg2 ,
                'active' => '1',

            ]);

        }
        if ($request->hasFile('slider_img_two')) {
            $image = $request->file('slider_img_two');
            $name = str_slug($request->slider_img_two) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/slider');
            $image->move($destinationPath, $name);
            $nameImg3 = $name;
            DB::table('sliders')->update([
                'slider_img_two'=>$nameImg3 ,
                'active' => '1',

            ]);

        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = str_slug($request->banner) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/banner');
            $image->move($destinationPath, $name);
            $banner = $name;
            DB::table('sliders')->update([
                'banner'=>$banner ,
                'active' => '1',

            ]);

        }

        return redirect()->back()->with('slider', 'IT WORKS!') ;
    }
     protected function footer_edit(Request $request)
    {
        $validator = Validator::make($request->all(), [


            'inst_gram' => 'nullable|string',
            'telegram' => 'nullable|string',
            'whats_app' => 'nullable|string',
            'android' => 'nullable|string',
            'ios' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',

        ]);


        DB::table('footers')->update([
            'inst_gram' => $request->inst_gram,
            'telegram' => $request->telegram,
            'whats_app' => $request->whats_app,
            'android' => $request->android,
            'ios' => $request->ios,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,


        ]);

        return redirect()->back()->with('footer', 'IT WORKS!') ;
    }

    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();
        $sliders = slider::all();
        $panel_admins = panel_admin::all();
        return view('admin.dashboard.dashboard' , compact('generals','colors' , 'headers' ,'footers','panel_admins','sliders'));
    }


}


