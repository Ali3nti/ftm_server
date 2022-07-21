<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Product;
use App\Models\Panel_admin ;

class ProductController extends Controller
{
    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $products = product::all();
        $panel_admins = panel_admin::all();
        return view('admin.product.index' , compact('generals','colors' , 'headers' ,'products','panel_admins'));
    }

    public function editProducts()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $products = product::all();
        $panel_admins = panel_admin::all();
        return view('admin.product.editProducts' , compact('generals','colors' , 'headers' ,'products','panel_admins'));
    }

    public function validateWith($validator, Request $request = null)
    {
    }
    protected function record(Request $request)
    {
        $validator = Validator::make($request->all(), [
         
            'title' => 'required|string',
            'description' => 'required|string',
            'image_one' => 'required|image|mimes:jpeg,png,jpg',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg',
            'image_three' => 'nullable|image|mimes:jpeg,png,jpg',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if ($request->hasFile('image_one')) {
            $image = $request->file('image_one');
            $name = str_slug($request->image_one) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/products/');
            $image->move($destinationPath, $name);
            $image_one = $name;
        }
        if ($request->hasFile('image_two')) {
            $image = $request->file('image_two');
            $name = str_slug($request->image_two) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/products/');
            $image->move($destinationPath, $name);
            $image_two = $name;
        }
        if ($request->hasFile('image_three')) {
            $image = $request->file('image_three');
            $name = str_slug($request->image_three) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/products/');
            $image->move($destinationPath, $name);
            $image_three = $name;
        }
        $v = verta();
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $code = mt_rand(100000, 999999) ;
        $code = 'pro' . $code;
        $products = new product($request->all());
        $products->code = $code;
        $products->title = $request->title;
        $products->description = $request->description;
        $products->image_three = $image_three;
        $products->image_one = $image_one;
        $products->image_two = $image_two;
        $products->ip = $ip;
        $products->active = "1";
        $products->date = $v->formatDate('Y/M/D') ;
        $products->time = $v->formatTime();
        $products->save();
        return redirect()->back()->with('record', 'IT WORKS!') ;
    }
    protected function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        DB::table('products')->where('id', '=', $request->id)->update([

            'description' => $request->description,
            'title' => $request->title,
        ]);
        return redirect()->back()->with('edit', 'IT WORKS!') ;
    }

    protected function delete(Request $request)
    {
        DB::table('products')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!') ;
    }


    protected function active(Request $request)
    {
        DB::table('products')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('products')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

}


