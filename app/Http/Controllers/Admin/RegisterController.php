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
use App\Models\Product;
use App\Models\Panel_admin ;

class RegisterController extends Controller
{
    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $users = user::all();
        $panel_admins = panel_admin::all();
        return view('admin.register.index' , compact('generals','colors' , 'headers' ,'users','panel_admins'));
    }

//   *****************************************************************************

    protected function delete(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!') ;
    }


    protected function active(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->update([
            'active' => '1',

        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }

    protected function inactive(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->update([
            'active' => '0',

        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }

//    *********************************************

    protected function edit(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->update([
            'role' => '1',
            'panel' => '/admin',

        ]);
        return redirect()->back()->with('edit', 'IT WORKS!') ;
    }

    protected function edit_two(Request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->update([
            'role' => '2',
            'panel' => '',

        ]);
        return redirect()->back()->with('editTwo', 'IT WORKS!') ;
    }

}


