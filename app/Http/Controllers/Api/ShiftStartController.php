<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftStartController extends Controller
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
                        ->limit(1)
                        ->offset(1)
                        ->first();
                        // ->where('user_id', "!=", $user)

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
        }else{
            return $message = array(
                'status' => '404',
                'message' => 'Else Items',
                'data' => []
            );
        }
    }

    public function Contradiction(Request $request)
    {
        $state = $request->state_id;
        $user = $request->user_id;
        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));
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



    public function Start(Request $request)
    {

        $state = $request->state_id;
        $user = $request->user_id;
        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        $changeStateStatus = DB::table('app_shift_data')
        ->orderBy('id', 'desc')
        ->where('state_id', $state)
        ->limit(1)
        ->update(['confirm' => "11000"]);

        $shift_id = DB::table('app_shift_data')
            ->insertGetId([
                'state_id' => $state,
                'user_id' => $user,
                'start_shift_at' => $create_date,
                'operators_id' => $user
            ]);

        $changeStateStatus = DB::table('app_states')
            ->where('id', $state)
            ->update(['status' => 1]);

        $changeUserStatus = DB::table('app_users')
            ->where('id', $user)
            ->update(['status' => 1]);

        return $message = array(
            "status" => "1",
            "message" => "shift has been create successfully.",
            "data" => [
                "shift_id" => $shift_id
            ]
        );
    }
}
