<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function EmployeeReport(Request $request)
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

        function getTimeSheet(int $id, int $shift_id)
        {
            $getTimeSheet = DB::table('app_timesheet')
                ->where('user_id', $id)
                ->where('shift_id', $shift_id)
                ->first();

            $timesheet = array();

            if ($getTimeSheet) {
                $timesheet["user"] = getUser($getTimeSheet->user_id);
                $timesheet["start"] = $getTimeSheet->start;
                $timesheet["end"] = $getTimeSheet->end;
                $timesheet["status"] = $getTimeSheet->status;
                return $timesheet;
            } else {
                return [];
            }
        }

        $station = $request->station_id;
        $date = $request->date;

        $date = str_replace('/', '-', $date);

        $supervisorReport = array();

        $allShift = DB::table('app_report')
            ->where('station_id', $station)
            ->get();

        for ($i = 0; $i < count($allShift); $i++) {

            $res1 = $allShift[$i]->start_at;

            if (str_contains($res1, $date)) {  // if(str_starts_with($res1,$date)){

                $day = substr($res1, 8, 2);
                $inDay = array();

                for ($j = 0, $c = 1; $j < count($allShift); $j++) {
                    $res2 = $allShift[$j]->start_at;
                    if (str_contains($res2, $date) & substr($allShift[$j]->start_at, 8, 2) == $day) {

                        $inDay[$c]["id"] = $allShift[$j]->id;
                        $inDay[$c]["station_id"] = $allShift[$j]->station_id;
                        $mUser = json_decode($allShift[$j]->users, true);
                        // $inDay[$c]["users"]["creator"] = getUser($mUser["creator"]);

                        // if ($mUser["creator"] != $mUser["assistant"]) {
                        // $inDay[$c]["users"]["assistant"] = getUser($mUser["assistant"]);
                        // }

                        $inDay[$c]["timesheet"]["creator"] = getTimeSheet(
                            $mUser["creator"],
                            $allShift[$j]->id
                        );

                        if ($mUser["creator"] != $mUser["assistant"]) {
                            $inDay[$c]["timesheet"]["assistant"] = getTimeSheet(
                                $mUser["assistant"],
                                $allShift[$j]->id
                            );
                        }

                        $inDay[$c]["start_at"] = $allShift[$j]->start_at;
                        $inDay[$c]["end_at"] = $allShift[$j]->end_at;
                        $inDay[$c]["dispensers"] = json_decode($allShift[$j]->dispensers, true);
                        $inDay[$c]["cash"] = $allShift[$j]->cash;
                        $inDay[$c]["contradiction"] = $allShift[$j]->contradiction;
                        $inDay[$c]["contradiction_flag"] = $allShift[$j]->contradiction_flag;
                        $inDay[$c]["modified_flag"] = $allShift[$j]->modified_flag;
                        $inDay[$c]["confirm"] = $allShift[$j]->confirm;
                        // $inDay[$c]["update_at"] = $allShift[$j]->update_at;

                        $c++;
                    }
                }

                $supervisorReport[$day] = $inDay;
            }
        }

        return $message = array(
            "status" => "1",
            "message" => "Data returned successfully.",
            "data" => $supervisorReport
        );
    }

    public function EmployeeStatus(Request $request)
    {
        $user = $request->user_id;

        $status = DB::table('app_timesheet')
            ->orderBy('id', 'desc')
            ->where('user_id', $user)
            ->value('status');



        if ($status) {

            if ($status == 1) {

                return $message = array(
                    "status" => "1",
                    "message" => "is started."

                );
            } elseif ($status == 2) {
                return $message = array(
                    "status" => "2",
                    "message" => "can started."

                );
            }
        } else {
            return $message = array(
                "status" => "0",
                "message" => "Error"
            );
        }
    }
}
