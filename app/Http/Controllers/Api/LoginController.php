<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $user_phone = $request->user_phone;
        // $device_id = $request->device_id;
        $login_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        $checkUser = DB::table('app_users')
            ->where('phone', $user_phone)
            ->where('is_verified', 1)
            ->first();


        if ($checkUser) {

            $chars = "0123456789";
            $otpval = "";

            for ($i = 0; $i < 6; $i++) {
                $otpval .= $chars[mt_rand(0, strlen($chars) - 1)];
            }

            $update = DB::table('app_users')
                ->where('phone', $user_phone)
                ->update(['otp_value' => $otpval, 'last_login_at' => $login_date, "update_at" => $login_date]);

            $user = DB::table('app_users')
                ->where('phone', $user_phone)
                ->where('block', 0)
                ->first();

            if ($user) {

                $user->role = DB::table('app_roles')->where('id', $user->role)->first();

                $state = DB::table('app_states')->where('id', $user->state)->first();
                $state->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')->where('id', $state->supervisor)->first();
                $user->state = $state;
    
                // $user->tbl_shift = DB::table('app_shifts')->where('id', $user->tbl_shift)->first();
                $user->city = DB::table('app_city')->where('id', $user->city)->first();
                $user->status = DB::table('app_status')->where('id', $user->status)->first();
    
    
                return $message = array(
                    'status' => '1', 
                    'message' => 'User is already logged in.',
                    'data' => $user
                );
            }else{

                return $message = array(
                    'status' => '0',
                    'message' => 'User is blocked.',
                    'data' => 'null'
                );
            }

        } else {

            return $message = array(
                'status' => '0',
                'message' => 'User is not exist.',
                'data' => 'null'
            );
        }
    }

}
