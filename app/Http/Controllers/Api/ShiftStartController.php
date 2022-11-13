<?php


namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftStartController extends Controller
{

    public function Start(Request $request)
    {

        function addTimesheet(int $user_id, int $station_id, int $shift_id, $date)
        {

            $checkLastTime = DB::table('app_timesheet')
                ->orderByDesc('id')
                ->where('user_id', $user_id)
                ->first();

            if ($checkLastTime != null && $checkLastTime->end == 0) {

                $updateTimeSheet = DB::table('app_timesheet')
                    ->where('id', $checkLastTime->id)
                    ->update([
                        'end' => $date,
                        'status' => 2,
                    ]);

                return 1;
            } else {
                $addTimeSheet = DB::table('app_timesheet')
                    ->insertGetId([
                        'user_id' => $user_id,
                        'station_id' => $station_id,
                        'shift_id' => $shift_id,
                        'start' => $date,
                        'status' => 1,
                    ]);

                return 2;
            }
        }

        $station_id = $request->station_id;
        $user_creator_id = $request->user_creator_id;
        $user_assistant_id = $request->user_assistant_id;
        $dispenser_json = $request->dispenser_json;
        $contradiction = $request->contradiction;

        $create_date = jdate();

        if ($user_creator_id != $user_assistant_id) {
            $users = json_encode([
                'creator' => $user_creator_id,
                'assistant' => $user_assistant_id
            ]);
        } else {
            $users = json_encode([
                'creator' => $user_creator_id,
                'assistant' => $user_assistant_id
            ]);
        }

        $lastShift = DB::table('app_report')
            ->orderByDesc('id')
            ->where('station_id', $station_id)
            ->first();

        if ($contradiction) {

            $conflict = 0;
            $lastDispenser = json_decode($lastShift->dispensers, true);
            for ($i = 1; $i <= count($lastDispenser); $i++) {
                $conflict +=  $lastDispenser[$i]["end_1"] - $dispenser_json[$i]["start_1"];
                $conflict +=  $lastDispenser[$i]["end_2"] - $dispenser_json[$i]["start_2"];
            }

            $conflict = $conflict * 6568;
            $checkStation = DB::table('app_report')
                ->where('id', $lastShift->id)
                ->update([
                    'contradiction_flag' => 1,
                    'contradiction' => $conflict
                ]);
        }

        $dispenser_json = json_encode($dispenser_json);

        if ($lastShift) {

            if ($lastShift->confirm == 10000) { // The shift exists and needs to be accepted.

                $confirm = DB::table('app_report')
                    ->where('id', $lastShift->id)
                    ->update(['confirm' => '11000']);

                $changeUserAssistantStatus = DB::table('app_users')
                    ->where('id', $user_assistant_id)
                    ->update(['status' => 3]);

                $changeStationStatus = DB::table('app_stations')
                    ->where('id', $station_id)
                    ->update(['status' => 3]);

                addTimesheet($user_assistant_id, $station_id, $lastShift->id, $create_date);

                return $message = array(
                    "status" => "1",
                    "message" => "The shift confirmed successfully.",
                    "data" => []
                );
            } else {

                if ($user_creator_id == $user_assistant_id) { // One User

                    $shift_id = DB::table('app_report')
                        ->insertGetId([
                            'station_id' => $station_id,
                            'users' => $users,
                            'start_at' => $create_date,
                            'dispensers' => $dispenser_json,
                            'modified_flag' => $contradiction,
                            'confirm' => "11000",
                        ]);
                    $changeStationStatus = DB::table('app_stations')
                        ->where('id', $station_id)
                        ->update(['status' => 3]);

                    $changeUserCreatorStatus = DB::table('app_users')
                        ->where('id', $user_creator_id)
                        ->update(['status' => 3]);

                    addTimesheet($user_creator_id, $station_id, $shift_id, $create_date);
                } else { // Two User

                    $shift_id = DB::table('app_report')
                        ->insertGetId([
                            'station_id' => $station_id,
                            'users' => $users,
                            'start_at' => $create_date,
                            'dispensers' => $dispenser_json,
                            'modified_flag' => $contradiction,
                            'confirm' => "10000",
                        ]);
                    $changeStationStatus = DB::table('app_stations')
                        ->where('id', $station_id)
                        ->update(['status' => 2]);

                    $changeUserCreatorStatus = DB::table('app_users')
                        ->where('id', $user_creator_id)
                        ->update(['status' => 3]);

                    $changeUserAssistantStatus = DB::table('app_users')
                        ->where('id', $user_assistant_id)
                        ->update(['status' => 2]);

                    addTimesheet($user_creator_id, $station_id, $shift_id, $create_date);
                }

                return $message = array(
                    "status" => "1",
                    "message" => "The shift has been created successfully.",
                    "data" => [
                        "shift_id" => $shift_id
                    ]
                );
            }
        } else {
            // if ($user_creator_id == $user_assistant_id) { // One User

            //     $shift_id = DB::table('app_report')
            //         ->insertGetId([
            //             'station_id' => $station_id,
            //             'users' => $users,
            //             'start_at' => $create_date,
            //             'dispensers' => $dispenser_json,
            //             'confirm' => "11000",
            //         ]);
            //     $changeStationStatus = DB::table('app_stations')
            //         ->where('id', $station_id)
            //         ->update(['status' => 3]);

            //     $changeUserCreatorStatus = DB::table('app_users')
            //         ->where('id', $user_creator_id)
            //         ->update(['status' => 3]);
            // } else { // Two User

            //     $shift_id = DB::table('app_report')
            //         ->insertGetId([
            //             'station_id' => $station_id,
            //             'users' => $users,
            //             'start_at' => $create_date,
            //             'dispensers' => $dispenser_json,
            //             'confirm' => "10000",
            //         ]);
            //     $changeStationStatus = DB::table('app_stations')
            //         ->where('id', $station_id)
            //         ->update(['status' => 2]);

            //     $changeUserCreatorStatus = DB::table('app_users')
            //         ->where('id', $user_creator_id)
            //         ->update(['status' => 3]);

            //     $changeUserAssistantStatus = DB::table('app_users')
            //         ->where('id', $user_assistant_id)
            //         ->update(['status' => 2]);
            // }
            // return $message = array(
            //     "status" => "1",
            //     "message" => "The shift has been created successfully.",
            //     "data" => [
            //         "shift_id" => $shift_id
            //     ]
            // );
            return $message = "Start shift have error: 100001";
        }
    }

    public function ShiftData(Request $request)
    {
        function getUser(int $id)
        {
            $user = DB::table('app_users')
                ->where('id', $id)
                ->first();

            $user->role = DB::table('app_roles')->where('id', $user->role)->first();
            $station = DB::table('app_stations')->where('id', $user->station)->first();
            $station->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')
                ->where('id', $station->supervisor)->first();
            $user->station = $station;
            $user->city = DB::table('app_city')->where('id', $user->city)->first();
            $user->status = DB::table('app_status')->where('id', $user->status)->first();

            return $user;
        }

        $station_id = $request->station_id;
        $user_id = $request->user_id;

        $user = 0;
        $data = array();

        ////////////////////////////////////////[' Operators ']\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        $getOperators = DB::table('app_users')
            ->where('station', $station_id)
            ->whereNot('id', $user_id)
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
        } else {
            return "Error in getOperators";
        }

        //////////////////////////////////////////[' Shift ']\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        $checkUserStatus = DB::table('app_users')
            ->select('status')
            ->where('id', $user_id)
            ->value('status');

        $checkStationStatus = DB::table('app_stations')
            ->select('status')
            ->where('id', $station_id)
            ->value('status');

        $lastShift = DB::table('app_report')
            ->orderByDesc('id')
            ->where('station_id', $station_id)
            ->first();

        if ($checkUserStatus == 1) {
            /*1
            |--------------------------------------------------------------------------
            | The User status is Ready to Start Shift(1).
            | The Station status is Ready to Start Shift(1).
            |--------------------------------------------------------------------------
            */

            if ($checkStationStatus == 1) {
                /*2
                |--------------------------------------------------------------------------
                | Station status is Ready to Start Shift.
                |--------------------------------------------------------------------------
                */
                if ($lastShift) {
                    /*3
                    |--------------------------------------------------------------------------
                    | User and station status Ready
                    | Last Shift is exist.
                    |--------------------------------------------------------------------------
                    */
                    $lastShift->users = json_decode($lastShift->users);
                    $lastShift->users->creator = getUser($lastShift->users->creator);
                    $lastShift->users->assistant = getUser($lastShift->users->assistant);
                    $lastShift->dispensers = json_decode($lastShift->dispensers);
                    $data['shift'] = $lastShift;
                    return $message = array(
                        'status' => '1',
                        'message' => 'User can create shift',
                        'data' => $data
                    );
                } else {
                    /*4
                    |--------------------------------------------------------------------------
                    | User and station status Ready
                    | Last Shift is not exist.
                    |--------------------------------------------------------------------------
                    */
                    $disNum = DB::table('app_stations')
                        ->where('id', $station_id)
                        ->value('dispenser');

                    $dispenser_json = array();

                    for ($i = 1; $i <= $disNum; $i++) {
                        $dispenser = [
                            "start_1" => 0,
                            "start_2" => 0,
                            "end_1" => 0,
                            "end_2" => 0,
                        ];
                        $dispenser_json[$i] = $dispenser;
                    }

                    $dispenser_json = json_encode($dispenser_json);

                    $users = json_encode([
                        'creator' => $user_id,
                        'assistant' => $user_id
                    ]);

                    $baseShift = DB::table('app_report')
                        ->insertGetId([
                            'station_id' => $station_id,
                            'users' => $users,
                            'start_at' => jdate(),
                            'end_at' => jdate(),
                            'dispensers' => $dispenser_json,
                            'confirm' => "11111",
                        ]);

                    $baseShift = DB::table('app_report')
                        ->where('id', $baseShift)
                        ->first();

                    $baseShift->users = json_decode($baseShift->users);
                    $baseShift->dispensers = json_decode($baseShift->dispensers);

                    $data['shift'] = $baseShift;
                    return $message = array(
                        'status' => '1',
                        'message' => 'This station has no shifts',
                        'data' => $data
                    );
                }
            } else {
                /*5
                        |--------------------------------------------------------------------------
                        | Shift is started and not defined for this user.
                        |--------------------------------------------------------------------------
                        */
                // $userLastShift = DB::table('app_report')
                // ->orderByDesc('id')
                // ->where('station_id', $station_id)
                // ->where('station_id', $station_id)
                // ->first();
                $lastShift->users = json_decode($lastShift->users);
                $lastShift->users->creator = getUser($lastShift->users->creator);
                $lastShift->users->assistant = getUser($lastShift->users->assistant);
                $lastShift->dispensers = json_decode($lastShift->dispensers);

                $data['shift'] = $lastShift;
                return $message = array(
                    'status' => '5',
                    'message' => 'This shift does not defined for this user.',
                    'data' => $data
                );
            }
        } elseif ($checkUserStatus == 2) {
            /*6
                |--------------------------------------------------------------------------
                | The User status is inShiftReady(2)
                | The station status is inShift(2)
                | User view data and accept. 
                | Station status is inShift to the assistant user accepting Shift.
                |--------------------------------------------------------------------------
                */
            if ($lastShift) {

                $lastShift->users = json_decode($lastShift->users);
                $lastShift->users->creator = getUser($lastShift->users->creator);
                $lastShift->users->assistant = getUser($lastShift->users->assistant);
                $lastShift->dispensers = json_decode($lastShift->dispensers);
                $data['shift'] = $lastShift;

                return $message = array(
                    'status' => '2',
                    'message' => 'User can start shift',
                    'data' => $data
                );
            } else {
                return $message = array(
                    'status' => '404',
                    'message' => 'Error0001',
                    'data' => $data
                );
            }
        } elseif ($checkUserStatus == 3) {
            /*7
            |--------------------------------------------------------------------------
            | The User status is inShift.
            |--------------------------------------------------------------------------
            */

            if ($checkStationStatus == 3) {
                /*8
                |--------------------------------------------------------------------------
                | User can finish this shift.
                |--------------------------------------------------------------------------
                */
                if ($lastShift) {

                    $lastShift->users = json_decode($lastShift->users);
                    $lastShift->users->creator = getUser($lastShift->users->creator);
                    $lastShift->users->assistant = getUser($lastShift->users->assistant);
                    $lastShift->dispensers = json_decode($lastShift->dispensers);
                    $data['shift'] = $lastShift;

                    return $message = array(
                        'status' => '3',
                        'message' => 'User can finish the shift.',
                        'data' => $data
                    );
                } else {

                    return $message = array(
                        'status' => '404',
                        'message' => 'This Wrong0002',
                        'data' => $data
                    );
                }
            } elseif ($checkStationStatus == 2) {
                /*9
                |--------------------------------------------------------------------------
                | The shift doesn't accebt by assistant User and shift is break.
                |--------------------------------------------------------------------------
                */

                $lastShift->users = json_decode($lastShift->users);
                $lastShift->users->creator = getUser($lastShift->users->creator);
                $lastShift->users->assistant = getUser($lastShift->users->assistant);
                $lastShift->dispensers = json_decode($lastShift->dispensers);
                $data['shift'] = $lastShift;

                return $message = array(
                    'status' => '6',
                    'message' => "User can't finish the shift, wait to accept assistant user",
                    'data' => $data
                );
            } else {
                return $message = array(
                    'status' => '404',
                    'message' => 'This Wrong0003',
                    'data' => $data
                );
            }
        } elseif ($checkUserStatus == 4) {
            /*6-1
                |--------------------------------------------------------------------------
                | The User can view and accept endshift.
                | The User status is endShift(4)
                |--------------------------------------------------------------------------
                */
            if ($lastShift) {

                $lastShift->users = json_decode($lastShift->users);
                $lastShift->users->creator = getUser($lastShift->users->creator);
                $lastShift->users->assistant = getUser($lastShift->users->assistant);
                $lastShift->dispensers = json_decode($lastShift->dispensers);

                $data['shift'] = $lastShift;
                return $message = array(
                    'status' => '4',
                    'message' => 'User can just see and accept end shift.',
                    'data' => $data
                );
            } else {
                return $message = array(
                    'status' => '404',
                    'message' => 'This Wrong0004.',
                    'data' => $data
                );
            }
        } elseif ($checkUserStatus == 5) {
            /*5
                        |--------------------------------------------------------------------------
                        | Shift is not finished.
                        |--------------------------------------------------------------------------
                        */
            $lastShift->users = json_decode($lastShift->users);
            $lastShift->users->creator = getUser($lastShift->users->creator);
            $lastShift->users->assistant = getUser($lastShift->users->assistant);
            $lastShift->dispensers = json_decode($lastShift->dispensers);

            $data['shift'] = $lastShift;
            return $message = array(
                'status' => '5',
                'message' => 'This shift for this user was ended but the station wait for other user.',
                'data' => $data
            );
        } else {
            return $message = array(
                'status' => '404',
                'message' => 'This Wrong0005.',
                'data' => $data
            );
            return $message = array(
                'status' => '6',
                'message' => 'User access is blocked.',
                'data' => $data
            );
        }
    }
}
