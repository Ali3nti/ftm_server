<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;

class OperatorController extends Controller
{

    public function OperatorReport(Request $request)
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
        $user = $request->user_id;
        $date = $request->date;

        $date = str_replace('/', '-', $date);

        $supervisorReport = array();

        $allShift = DB::table('app_report')
            ->where('station_id', $station)
            ->get();



        for ($i = 0; $i < count($allShift); $i++) {

            $shiftDate = $allShift[$i]->start_at;


            $users = json_decode($allShift[$i]->users);
            $shiftUserCreator = $users->creator;
            $shiftUserAssistant = $users->assistant;

            if ($shiftUserCreator == $user | $shiftUserAssistant == $user) {


            if (str_contains($shiftDate, $date)) {  // if(str_starts_with($res1,$date)){



                    $day = substr($shiftDate, 8, 2);
                    $inDay = array();

                    for ($j = 0, $c = 1; $j < count($allShift); $j++) {

                        $res2 = $allShift[$j]->start_at;

                        $userss = json_decode($allShift[$j]->users);
                        $shiftUserCreatorr = $userss->creator;
                        $shiftUserAssistantt = $userss->assistant;

                        if (str_contains($res2, $date) & substr($allShift[$j]->start_at, 8, 2) == $day) {

                            if ($shiftUserCreatorr == $user | $shiftUserAssistantt == $user) {

                                $inDay[$c]["id"] = $allShift[$j]->id;
                                $inDay[$c]["station_id"] = $allShift[$j]->station_id;
                                $mUser = json_decode($allShift[$j]->users, true);

                                if ($shiftUserCreatorr == $shiftUserAssistantt) {
                                    $inDay[$c]["timesheet"]["creator"] = getTimeSheet(
                                        $mUser["creator"],
                                        $allShift[$j]->id
                                    );
                                } else {
                                    if ($shiftUserCreatorr == $user) {
                                        $inDay[$c]["timesheet"]["creator"] = getTimeSheet(
                                            $mUser["creator"],
                                            $allShift[$j]->id
                                        );
                                    }elseif($shiftUserAssistantt == $user){
                                        $inDay[$c]["timesheet"]["assistant"] = getTimeSheet(
                                            $mUser["assistant"],
                                            $allShift[$j]->id
                                        );
                                    }
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
                    }

                    $supervisorReport[$day] = $inDay;
                }
            }
        }

        return $message = array(
            "status" => "1",
            "message" => "Data returned successfully.",
            "data" => $supervisorReport
        );
    }

    public function operatorShiftData(Request $request)
    {
        $station = $request->station_id;
        $user = $request->user_id;

        $row = DB::table('app_shift_data')
            ->orderBy('id', 'desc')
            ->join('app_stations', 'app_stations.id', '=', 'app_shift_data.station_id')
            ->select('app_shift_data.*', 'app_stations.name as station_name')
            ->where('station_id', $station)
            ->where('user_id', $user)
            ->get();

        if ($row) {

            foreach ($row as $edit) {

                $name = DB::table('app_users')->select('first_name', 'last_name')->where('id', $edit->user_id)->first();
                $edit->user_name = $name->first_name . ' ' . $name->last_name;
                $operators = unserialize($edit->operators_id);
                $edit->operators_id = $operators[1];

                $user = DB::table('app_users')
                    ->where('id', $operators[1])
                    ->first();

                if ($user) {

                    $user->role = DB::table('app_roles')->where('id', $user->role)->first();

                    $station = DB::table('app_stations')->where('id', $user->station)->first();
                    $station->supervisor = DB::table('app_users')->select('id', 'first_name', 'last_name')->where('id', $station->supervisor)->first();
                    $user->station = $station;

                    // $user->tbl_shift = DB::table('app_shifts')->where('id', $user->tbl_shift)->first();
                    $user->city = DB::table('app_city')->where('id', $user->city)->first();
                    $user->status = DB::table('app_status')->where('id', $user->status)->first();

                    $edit->operators = $user;
                } else {

                    return $message = array(
                        'status' => '0',
                        'message' => 'User is blocked.',
                        'data' => 'null'
                    );
                }
            }

            return $message = array(
                "status" => "1",
                "message" => "Data returned successfully.",
                "data" => $row

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
