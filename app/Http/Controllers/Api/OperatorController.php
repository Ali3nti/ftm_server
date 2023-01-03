<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
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
        $getTimeSheet = (array) DB::table('app_timesheet')
            ->where('user_id', $id)
            ->where('shift_id', $shift_id)
            ->first();

        if ($getTimeSheet) {

            $getTimeSheet["user"] = $this->getUser($getTimeSheet['user_id']);
            unset($getTimeSheet["user_id"]);
            return $getTimeSheet;
        } else {
            return [];
        }
    }

    public function OperatorReport(Request $request)
    {
        $station = $request->station_id;
        $user = $request->user_id;
        $date = $request->date;

        if ($date == "0") {

            $operatorReport = array();

            $timeSheet = DB::table('app_timesheet')
                ->orderByDesc('id')
                ->where('user_id', $user)
                ->first();

            $lastShift = DB::table('app_report')
                ->where('id', $timeSheet->shift_id)
                ->first();

            $myLastShift["0"]["id"] = $lastShift->id;
            $myLastShift["0"]["station_id"] =  $lastShift->station_id;

            $myLastShift["0"]["timesheet"]["creator"] = $this->getTimeSheet(
                $user,
                $lastShift->id
            );

            $myLastShift["0"]["start_at"] =  $lastShift->start_at;
            $myLastShift["0"]["end_at"] =  $lastShift->end_at;
            $myLastShift["0"]["dispensers"] = json_decode($lastShift->dispensers, true);
            $myLastShift["0"]["cash"] =  $lastShift->cash;
            $myLastShift["0"]["contradiction"] =  $lastShift->contradiction;
            $myLastShift["0"]["contradiction_flag"] =  $lastShift->contradiction_flag;
            $myLastShift["0"]["modified_flag"] =  $lastShift->modified_flag;
            $myLastShift["0"]["confirm"] =  $lastShift->confirm;

            $operatorReport["0"] = $myLastShift;

            return $message = array(
                "status" => "1",
                "message" => "Data returned successfully.",
                "data" => $operatorReport
            );
        }

        $date = str_replace('/', '-', $date);

        $operatorReport = array();

        $allShift = DB::table('app_report')
            ->where('station_id', $station)
            ->get();

        for ($i = 0; $i < count($allShift); $i++) {

            $shiftDate = $allShift[$i]->start_at;

            $users = json_decode($allShift[$i]->users, true);

            $shiftUserCreator = $users["creator"];
            $shiftUserAssistant = @$users['assistant'];
            $shiftUserFinisher = @$users['finisher'];

            if ($shiftUserCreator == $user | $shiftUserAssistant == $user | $shiftUserFinisher == $user) {

                if (str_contains($shiftDate, $date)) {  // if(str_starts_with($res1,$date)){

                    $day = substr($shiftDate, 8, 2);
                    $inDay = array();

                    for ($j = 0, $c = 1; $j < count($allShift); $j++) {

                        $res2 = $allShift[$j]->start_at;

                        $userss = json_decode($allShift[$j]->users, true);

                        $shiftUserCreatorr = $userss["creator"];
                        $shiftUserAssistantt = @$userss['assistant'];
                        $shiftUserFinisherr = @$userss['finisher'];

                        if (str_contains($res2, $date) & substr($allShift[$j]->start_at, 8, 2) == $day) {

                            if ($shiftUserCreatorr == $user | $shiftUserAssistantt == $user | $shiftUserFinisherr == $user) {

                                $inDay[$c]["id"] = $allShift[$j]->id;
                                $inDay[$c]["station_id"] = $allShift[$j]->station_id;
                                $mUser = json_decode($allShift[$j]->users, true);

                                // if ($shiftUserCreatorr == $shiftUserAssistantt) {
                                //     $inDay[$c]["timesheet"]["creator"] = getTimeSheet(
                                //         $mUser["creator"],
                                //         $allShift[$j]->id
                                //     );
                                // } else {
                                if ($shiftUserCreatorr == $user) {
                                    $inDay[$c]["timesheet"]["creator"] = $this->getTimeSheet(
                                        $mUser["creator"],
                                        $allShift[$j]->id
                                    );
                                } elseif ($shiftUserAssistantt == $user) {
                                    $inDay[$c]["timesheet"]["assistant"] = $this->getTimeSheet(
                                        $mUser["assistant"],
                                        $allShift[$j]->id
                                    );
                                } elseif ($shiftUserFinisherr == $user) {
                                    $inDay[$c]["timesheet"]["finisher"] = $this->getTimeSheet(
                                        $mUser["finisher"],
                                        $allShift[$j]->id
                                    );
                                }
                                // }

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

                    $operatorReport[$day] = $inDay;
                }
            }
        }

        return $message = array(
            "status" => "1",
            "message" => "Data returned successfully.",
            "data" => $operatorReport
        );
    }
}