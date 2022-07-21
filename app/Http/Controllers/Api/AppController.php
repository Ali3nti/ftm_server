<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller{
    
    public function appInfo(Request $request){

        $id_personal = $request->id_personal;
        $user = DB::table('app_users')
        ->where('id_personal', $id_personal)
        ->get();

        return $message = array('status' => '1','message' => $user);
    }    
}