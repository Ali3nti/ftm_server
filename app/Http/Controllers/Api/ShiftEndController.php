<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class ShiftEndController extends Controller
{
    public function End(Request $request)
    {
        function addTimesheet(int $user_id, $date)
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
            }
        }

        $user = $request->user_id;
        $id = $request->id;
        $cash = $request->cash;
        $dispenser_json = $request->dispenser_json;
        $create_date = jdate();
        $dispenser_json = json_encode($dispenser_json);

        $row = DB::table('app_report')
            ->where('id', $id)
            ->first();

        $users = json_decode($row->users);

        if ($row->confirm == '11000') {

            if ($users->creator == $user) {

                if ($users->creator != $users->assistant) {

                    $update = DB::table('app_report')
                        ->where('id', $id)
                        ->update([
                            'end_at' => $create_date,
                            'dispensers' => $dispenser_json,
                            'cash' => $cash,
                            'confirm' => "11100",
                            'update_at' => $create_date
                        ]);

                    if ($update) {

                        $updateStationStatus = DB::table('app_stations')
                            ->where('id', $row->station_id)
                            ->update(['status' => 4]);

                        $updateCreatorUserStatus = DB::table('app_users')
                            ->where('id', $user)
                            ->update(['status' => 5]);

                        $updateAssistantUserStatus = DB::table('app_users')
                            ->where('id', $users->assistant)
                            ->update(['status' => 4]);

                        addTimesheet($user, $create_date);


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
                            "message" => "Error1",
                            "data" => []
                        );
                    }
                } else {
                    $update = DB::table('app_report')
                        ->where('id', $id)
                        ->update([
                            'end_at' => $create_date,
                            'dispensers' => $dispenser_json,
                            'cash' => $cash,
                            'confirm' => "11110",
                            'update_at' => $create_date
                        ]);

                    if ($update) {
                        $updateStationStatus = DB::table('app_stations')
                            ->where('id', $row->station_id)
                            ->update(['status' => 1]);

                        $updateCreatorUserStatus = DB::table('app_users')
                            ->where('id', $user)
                            ->update(['status' => 1]);

                        addTimesheet($user, $create_date);


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
                            "message" => "Error2",
                            "data" => []
                        );
                    }
                }
            } else {
                $creator = $users->creator;
                $newUsers = json_encode([
                    'creator' => $creator,
                    'finisher' => $user
                    // 'assistant' => $user
                ]);

                $update = DB::table('app_report')
                    ->where('id', $id)
                    ->update([
                        'users' => $newUsers,
                        'end_at' => $create_date,
                        'dispensers' => $dispenser_json,
                        'cash' => $cash,
                        'confirm' => "11100",
                        'update_at' => $create_date
                    ]);

                if ($update) {
                    $updateStationStatus = DB::table('app_stations')
                        ->where('id', $row->station_id)
                        ->update(['status' => 4]);

                    $updateFinisherUserStatus = DB::table('app_users')
                        ->where('id', $user)
                        ->update(['status' => 5]);

                    $updateCreatorUserStatus = DB::table('app_users')
                        ->where('id', $creator)
                        ->update(['status' => 4]);

                    addTimesheet($user, $create_date);


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
                        "message" => "Error3",
                        "data" => []
                    );
                }
            }
        } elseif ($row->confirm == "11100") {

            $update = DB::table('app_report')
                ->where('id', $id)
                ->update([
                    'end_at' => $create_date,
                    'confirm' => "11110",
                    'update_at' => $create_date
                ]);
            if ($update) {
                $updateStationStatus = DB::table('app_stations')
                    ->where('id', $row->station_id)
                    ->update(['status' => 1]);

                $updateUserStatus = DB::table('app_users')
                    ->where('id', $user)
                    ->update(['status' => 1]);

                $updateFinisherUserStatus = DB::table('app_users')
                    ->where('station', $row->station_id)
                    ->update(['status' => 1]);

                addTimesheet($user, $create_date);

                return $message = array(
                    "status" => "1",
                    "message" => "Data has been confirm on shift data table successfully.",
                    "data" => [
                        "shift_id" => $row
                    ]
                );
            } else {
                return $message = array(
                    "status" => "0",
                    "message" => "Error4",
                    "data" => []
                );
            }
        }
    }    
    
    public function FailureShift(Request $request)
    {
        function addToTimesheet(int $user_id, $date)
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
            }
        }

        $user = $request->user_id;
        $id = $request->id;
        $create_date = jdate();

        $row = DB::table('app_report')
        ->where('id', $id)
        ->first();

        $dispenser_json = json_decode($row->dispensers, true);

        for ($j = 1; $j <= count($dispenser_json); $j++) {

                $dispenser_json[$j]["end_1"] = $dispenser_json[$j]["start_1"];
                $dispenser_json[$j]["end_2"] = $dispenser_json[$j]["start_2"];

        }

        $failureDispenser = json_encode($dispenser_json);
        
        $users = json_decode($row->users);

        if ($row->confirm == '11000') {

            if ($users->creator == $user) {

                if ($users->creator != $users->assistant) {

                    $update = DB::table('app_report')
                        ->where('id', $id)
                        ->update([
                            'end_at' => $create_date,
                            'dispensers' => $failureDispenser,
                            'cash' => 0,
                            'confirm' => "11100",
                            'update_at' => $create_date
                        ]);

                    if ($update) {

                        $updateStationStatus = DB::table('app_stations')
                            ->where('id', $row->station_id)
                            ->update(['status' => 4]);

                        $updateCreatorUserStatus = DB::table('app_users')
                            ->where('id', $user)
                            ->update(['status' => 5]);

                        $updateAssistantUserStatus = DB::table('app_users')
                            ->where('id', $users->assistant)
                            ->update(['status' => 4]);

                            addToTimesheet($user, $create_date);


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
                            "message" => "Error1",
                            "data" => []
                        );
                    }
                } else {
                    $update = DB::table('app_report')
                        ->where('id', $id)
                        ->update([
                            'end_at' => $create_date,
                            'dispensers' => $failureDispenser,
                            'cash' => 0,
                            'confirm' => "11110",
                            'update_at' => $create_date
                        ]);

                    if ($update) {
                        $updateStationStatus = DB::table('app_stations')
                            ->where('id', $row->station_id)
                            ->update(['status' => 1]);

                        $updateCreatorUserStatus = DB::table('app_users')
                            ->where('id', $user)
                            ->update(['status' => 1]);

                            addToTimesheet($user, $create_date);


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
                            "message" => "Error2",
                            "data" => []
                        );
                    }
                }
            } else {
                $creator = $users->creator;
                $users = json_encode([
                    'creator' => $users->creator,
                    // 'finisher' => $user
                    'assistant' => $user
                ]);

                $update = DB::table('app_report')
                    ->where('id', $id)
                    ->update([
                        'users' => $users,
                        'end_at' => $create_date,
                        'dispensers' => $failureDispenser,
                        'cash' => 0,
                        'confirm' => "11100",
                        'update_at' => $create_date
                    ]);

                if ($update) {
                    $updateStationStatus = DB::table('app_stations')
                        ->where('id', $row->station_id)
                        ->update(['status' => 4]);

                    $updateFinisherUserStatus = DB::table('app_users')
                        ->where('id', $user)
                        ->update(['status' => 5]);

                    $updateCreatorUserStatus = DB::table('app_users')
                        ->where('id', $creator)
                        ->update(['status' => 4]);

                        addToTimesheet($user, $create_date);


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
                        "message" => "Error3",
                        "data" => []
                    );
                }
            }
        } else{
            return $message = array(
                "status" => "0",
                "message" => "Error4",
                "data" => []
            );
        }
    }
}
