<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftStartController extends Controller
{
    public function ShiftData(Request $request)
    {
        $station_id = $request->station_id;
        $user = $request->user_id;

        $data = array();

        $getOperators = DB::table('app_users')
            ->where('station', $station_id)
            ->where('role', 4)
            ->get();


        if ($getOperators) {
            $users = array();
            foreach ($getOperators as $row) {
                $row->role = DB::table('app_roles')->where('id', $row->role)->first();

                $station = DB::table('app_stations')->where('id', $row->station)->first();
                $station->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')
                    ->where('id', $station->supervisor)->first();
                $row->station = $station;

                $row->city = DB::table('app_city')->where('id', $row->city)->first();

                $row->status = DB::table('app_status')->where('id', $row->status)->first();

                $users[] = $row;
            }


            $data['operators'] = $users;
            // $data['operators'] = $getOperators;

            $checkStationStatus = DB::table('app_stations')
                ->select('status')
                ->where('id', $station_id)
                ->first();

            $checkUserStatus = DB::table('app_users')
                ->select('status')
                ->where('id', $user)
                ->first();


            if ($checkStationStatus->status == 3) {

                if ($checkUserStatus->status == 3) {

                    $result = DB::table('app_shift_data')
                        ->orderBy('id', 'desc')
                        ->where('station_id', $station_id)
                        ->first();

                    if ($result) {

                        $operators = array();
                        $operators = unserialize($result->operators_id);

                        $isExist = false;

                        foreach ($operators as $operator) {
                            if ($operator == $user) {
                                $isExist = true;
                            } else {
                                $isExist = false;
                            }
                        }
                        if ($isExist) {
                            $result->operators_id = $operators[1];
                            $data['shift'] = $result;

                            return $message = array(
                                'status' => '1',
                                'message' => 'User shift already',
                                'data' => $data
                            );
                        } else {
                            return $message = array(
                                'status' => '2',
                                'message' => 'This Wrong 0.5.',
                                'data' => []
                            );
                        }
                    } else {
                        return $message = array(
                            'status' => '2',
                            'message' => 'This Wrong0.',
                            'data' => []
                        );
                    }
                } else {

                    $result = DB::table('app_shift_data')
                        ->orderBy('id', 'desc')
                        ->where('station_id', $station_id)
                        // ->where('user_id', $user)
                        ->first();

                    $result->operators_id = unserialize($result->operators_id);

                    if ($result) {
                        $data['shift'] = $result;
                        return $message = array(
                            'status' => '2',
                            'message' => 'This shift does not defined for this user.',
                            'data' => $data
                        );
                    } else {
                        return $message = array(
                            'status' => '2',
                            'message' => 'This Wrong1.',
                            'data' => []
                        );
                    }
                }
            } else if ($checkStationStatus->status == 1) {

                if ($checkUserStatus->status == 1) {

                    $checkContradiction = DB::table('app_shift_data')
                        ->orderBy('id', 'desc')
                        ->where('station_id', $station_id)
                        ->where('user_id', $user)
                        ->first();


                    if ($checkContradiction->modified_flag == 1) {

                        $result = DB::table('app_contradiction')
                            ->orderBy('id', 'desc')
                            ->where('station_id', $station_id)
                            ->where('user_id', $user)
                            ->first();

                        if ($result) {
                            $data['shift'] = $result;
                            return $message = array(
                                'status' => '2',
                                'message' => 'User shift has cantradiction',
                                'data' => $data
                            );
                        } else {
                            return $message = array(
                                'status' => '2',
                                'message' => 'This Wrong2.',
                                'data' => []
                            );
                        }
                    } else {

                        $result = DB::table('app_shift_data')
                            ->orderBy('id', 'desc')
                            ->where('station_id', $station_id)
                            ->limit(1)
                            ->offset(1)
                            ->first();
                        // ->where('user_id', "!=", $user)

                        if ($result) {
                            $data['shift'] = $result;
                            return $message = array(
                                'status' => '1',
                                'message' => 'User shift already',
                                'data' => $data
                            );
                        } else {
                            return $message = array(
                                'status' => '2',
                                'message' => 'This Wrong3.',
                                'data' => []
                            );
                        }
                    }
                } else {
                    $result = DB::table('app_shift_data')
                        ->orderBy('id', 'desc')
                        ->where('station_id', $station_id)
                        ->where('user_id', $user)
                        ->first();

                    if ($result) {
                        $data['shift'] = $result;
                        return $message = array(
                            'status' => '2',
                            'message' => 'This shift does not defined for this user.',
                            'data' => $data
                        );
                    } else {

                        $result = DB::table('app_shift_data')
                            ->orderBy('id', 'desc')
                            ->where('station_id', $station_id)
                            ->first();

                        $data['shift'] = $result;
                        return $message = array(
                            'status' => '2',
                            'message' => 'This wrong4.',
                            'data' => $data
                        );
                    }
                }
            } else {
                return $message = array(
                    'status' => '404',
                    'message' => 'Else Items',
                    'data' => []
                );
            }
        } else {
            return $message = array(
                'status' => '2',
                'message' => 'Return operators has error',
                'data' => []
            );
        }
    }

    public function Start(Request $request)
    {

        $station = $request->station_id;
        $user = $request->user_id;
        $second_user = $request->second_user_id;
        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        // $changeStationStatus = DB::table('app_shift_data')
        //     ->orderBy('id', 'desc')
        //     ->where('station_id', $station)
        //     ->limit(1)
        //     ->update(['confirm' => "11000"]);

        // $operators = "{".$user.",".$second_user."}";

        $operators = array($user, $second_user);
        $operators = serialize($operators);

        $shift_id = DB::table('app_shift_data')
            ->insertGetId([
                'station_id' => $station,
                'user_id' => $user,
                'operators_id' => $operators,
                'start_shift_at' => $create_date,
            ]);

        $changeStationStatus = DB::table('app_stations')
            ->where('id', $station)
            ->update(['status' => 1]);

        $changeUserStatus = DB::table('app_users')
            ->where('id', $user)
            ->update(['status' => 1]);

        // $changeOtherUsersStatus = DB::table('app_users')
        //     ->where('station', $station)
        //     ->update(['status' => 3]);

        return $message = array(
            "status" => "1",
            "message" => "shift has been create successfully.",
            "data" => [
                "shift_id" => $shift_id
            ]
        );
    }

    public function Contradiction(Request $request)
    {
        $station    = $request->station_id;
        $user     = $request->user_id;
        $second_user = $request->second_user_id;
        $nozzle_1 = $request->nozzle_1;
        $nozzle_2 = $request->nozzle_2;
        $nozzle_3 = $request->nozzle_3;
        $nozzle_4 = $request->nozzle_4;
        $nozzle_5 = $request->nozzle_5;
        $nozzle_6 = $request->nozzle_6;
        $nozzle_7 = $request->nozzle_7;
        $nozzle_8 = $request->nozzle_8;

        $create_date = new DateTime('now', new DateTimeZone('Asia/Tehran'));

        $contradictory = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->where('station_id', $station)
            ->first();

        $newResult = 0;
        $newResult += $contradictory->nozzle_1 - $nozzle_1;
        $newResult += $contradictory->nozzle_2 - $nozzle_2;
        $newResult += $contradictory->nozzle_3 - $nozzle_3;
        $newResult += $contradictory->nozzle_4 - $nozzle_4;
        $newResult += $contradictory->nozzle_5 - $nozzle_5;
        $newResult += $contradictory->nozzle_6 - $nozzle_6;
        $newResult += $contradictory->nozzle_7 - $nozzle_7;
        $newResult += $contradictory->nozzle_8 - $nozzle_8;

        $newResult = $newResult * 6568;


        $checkStation = DB::table('app_shift_data')
            ->where('id', $contradictory->id)
            ->update(['contradiction_flag' => 1, 'contradiction' => $newResult]);


        $operators = array($user, $second_user);
        $operators = serialize($operators);

        $shift_id = DB::table('app_shift_data')
            ->insertGetId([
                'station_id' => $station,
                'user_id' => $user,
                'operators_id' => $operators,
                'start_shift_at' => $create_date,
                'modified_flag' => 1
            ]);


        $contradiction_id = DB::table('app_contradiction')
            ->insertGetId([
                'station_id' => $station,
                'user_id' => $user,
                'create_at' => $create_date,
                'contradictory_id' => $contradictory->id,
                'modified_id' => $shift_id,
                'nozzle_1' => $nozzle_1,
                'nozzle_2' => $nozzle_2,
                'nozzle_3' => $nozzle_3,
                'nozzle_4' => $nozzle_4,
                'nozzle_5' => $nozzle_5,
                'nozzle_6' => $nozzle_6,
                'nozzle_7' => $nozzle_7,
                'nozzle_8' => $nozzle_8
            ]);

        $changeStationStatus = DB::table('app_stations')
            ->where('id', $station)
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
}
