<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftEndController extends Controller
{
    public function LastShift(Request $request)
    {

        $state = $request->state_id;
        $user = $request->user_id;

        // $result = (object) array();

        $checkStateStatus = DB::table('app_states')
            ->select('status')
            ->where('id', $state)
            ->first();

        $checkUserStatus = DB::table('app_users')
            ->select('status')
            ->where('id', $user)
            ->first();

        if ($checkUserStatus->status == 3) {

            if ($checkStateStatus->status == 3) {
                $result = DB::table('app_shift_data')
                    ->orderBy('id', 'desc')
                    ->where('state_id', $state)
                    ->first();

                if ($result) {
                    return $message = array(
                        'status' => '1',
                        'message' => 'User shift already',
                        'data' => $result
                    );
                }
            } else {
                return $message = array(
                    'status' => '0',
                    'message' => 'This shift does not defined for this user.',
                    'data' => []
                );
            }
        } else if ($checkStateStatus->status == 1) {

            if ($checkUserStatus->status == 1) {

                $checkContradiction = DB::table('app_shift_data')
                    ->orderBy('id', 'desc')
                    ->where('state_id', $state)
                    ->where('user_id', "=", $user)
                    ->where('modified_flag', 1)
                    ->exists();

                if ($checkContradiction) {

                    $result = DB::table('app_contradiction')
                        ->orderBy('id', 'desc')
                        ->where('state_id', $state)
                        ->where('user_id', $user)
                        ->first();

                    if ($result) {
                        return $message = array(
                            'status' => '2',
                            'message' => 'User shift has cantradiction',
                            'data' => $result
                        );
                    }
                } else {

                    $result = DB::table('app_shift_data')
                        ->orderBy('id', 'desc')
                        ->where('state_id', $state)
                        ->where('user_id', "!=", $user)
                        ->first();

                    if ($result) {
                        return $message = array(
                            'status' => '1',
                            'message' => 'User shift already',
                            'data' => $result
                        );
                    }
                }
            } else {
                return $message = array(
                    'status' => '0',
                    'message' => 'This shift does not defined for this user.',
                    'data' => []
                );
            }
        } else {
            return $message = array(
                'status' => '404',
                'message' => 'Else Items',
                'data' => []
            );
        }
    }

    public function End(Request $request)
    {
        $user = $request->user_id;
        $state = $request->state_id;
        $nozzle_1 = $request->nozzle_1;
        $nozzle_2 = $request->nozzle_2;
        $nozzle_3 = $request->nozzle_3;
        $nozzle_4 = $request->nozzle_4;
        $nozzle_5 = $request->nozzle_5;
        $nozzle_6 = $request->nozzle_6;
        $nozzle_7 = $request->nozzle_7;
        $nozzle_8 = $request->nozzle_8;
        $result_1 = $request->result_1;
        $result_2 = $request->result_2;
        $result_3 = $request->result_3;
        $result_4 = $request->result_4;
        $result_5 = $request->result_5;
        $result_6 = $request->result_6;
        $result_7 = $request->result_7;
        $result_8 = $request->result_8;
        $hand_cash = $request->hand_cash;
        $card_cash = $request->card_cash;
        $total_shift_cash = $request->total_shift_cash;
        $total_shift_result = $request->total_shift_result;
        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        //////////DO IT\\\\\\\\\\\\\\\\\\\

        $data = (object) $request->data;

        $contradictory_id = DB::table('app_shift_data')
            ->select('id')
            ->orderBy('id', 'desc')
            ->where('state_id', $state)
            ->first();

        $checkState = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->where('state_id', $state)
            ->update(['contradiction_flag' => 1]);

        $contradiction_id = DB::table('app_contradiction')
            ->insertGetId([
                'state_id' => $state,
                'user_id' => $user,
                'create_at' => $create_date,
                'contradictory_id' => $contradictory_id->id,
                'modified_id' => 1,
                'nozzle_1' => $data->nozzle1,
                'nozzle_2' => $data->nozzle2,
                'nozzle_3' => $data->nozzle3,
                'nozzle_4' => $data->nozzle4,
                'nozzle_5' => $data->nozzle5,
                'nozzle_6' => $data->nozzle6,
                'nozzle_7' => $data->nozzle7,
                'nozzle_8' => $data->nozzle8
            ]);

        $shift_id = DB::table('app_shift_data')
            ->insertGetId([
                'state_id' => $state,
                'user_id' => $user,
                'start_shift_at' => $create_date,
                'operators_id' => $user,
                'modified_flag' => 1
            ]);

        $changeStateStatus = DB::table('app_states')
            ->where('id', $state)
            ->update(['status' => 1]);

        $changeUserStatus = DB::table('app_users')
            ->where('id', $user)
            ->update(['status' => 1]);



        return $message = array(
            "status" => "1",
            "message" => "Contradiction has been set successfully.",
            "data" => [
                "contradiction_id" => $contradiction_id,
                "shift_id" => $shift_id
            ]
        );
    }



    public function Starts(Request $request)
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
            } else {

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
