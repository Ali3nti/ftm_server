<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftEndController extends Controller
{
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

        $row = DB::table('app_shift_data')
            ->select('id')
            ->orderBy('id', 'desc')
            ->where('state_id', $state)
            ->first();

        $update = DB::table('app_shift_data')
            ->where('id', $row->id)
            ->update([
                'end_shift_at' => $create_date,
                'nozzle_1' => $nozzle_1,
                'nozzle_2' => $nozzle_2,
                'nozzle_3' => $nozzle_3,
                'nozzle_4' => $nozzle_4,
                'nozzle_5' => $nozzle_5,
                'nozzle_6' => $nozzle_6,
                'nozzle_7' => $nozzle_7,
                'nozzle_8' => $nozzle_8,
                'result_1' => $result_1,
                'result_2' => $result_2,
                'result_3' => $result_3,
                'result_4' => $result_4,
                'result_5' => $result_5,
                'result_6' => $result_6,
                'result_7' => $result_7,
                'result_8' => $result_8,
                'total_shift_result' => $total_shift_result,
                'hand_cash' => $hand_cash,
                'card_cash' => $card_cash,
                'total_shift_cash' => $total_shift_cash,
                // 'contradiction' => $contradiction,
            ]);

        if ($update) {

            $updateStateStatus = DB::table('app_states')
                ->where('id', $state)
                ->update(['status' => 3]);

            $updateUserStatus = DB::table('app_users')
                ->where('id', $user)
                ->update(['status' => 2]);


            return $message = array(
                "status" => "1",
                "message" => "Data has been set on shift data table successfully.",
                "data" => [
                    "shift_id" => $row
                ]
            );
        } else {
            return $message = array(
                "status" => "0",
                "message" => "Error",
                "data" => []
            );
        }
    }
}
