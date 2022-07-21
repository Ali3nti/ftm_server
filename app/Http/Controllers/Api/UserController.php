<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    public function user(Request $request){

        $req = DB::table('app_users')
        ->get();

        return $req;
    }        
    
    public function userInfo(Request $request){

        $id_personnel = $request->id_personnel;
        $user = DB::table('app_users')
        ->where('id_personnel', $id_personnel)
        ->first();

        if($user){

            $user->role = DB::table('app_roles')->where('id', $user->role)->first();

            $state = DB::table('app_states')->where('id', $user->state)->first();
            $state->supervisor = DB::table('app_users')->select('id','first_name','last_name')->where('id', $state->supervisor)->first();
            $user->state = $state;

            // $user->tbl_shift = DB::table('app_shifts')->where('id', $user->tbl_shift)->first();
            $user->city = DB::table('app_city')->where('id', $user->city)->first();
            $user->status = DB::table('app_status')->where('id', $user->status)->first();


            return $message = array('status' => '1','message' => $user);

            // $response = array('status' => '1','message' => $user);
            // return $message = response()->json($response,200,[],JSON_UNESCAPED_UNICODE);
        }
        else{
            return $message = array('status' => '0','message' =>'User Not Found');
        }

        
    }    
}