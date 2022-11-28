<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SupervisorController extends Controller
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

        // $timesheet = array();
        if ($getTimeSheet) {

            $obj = (array) $getTimeSheet;
            $obj["user"] = $this->getUser($getTimeSheet->user_id);
            unset($obj["user_id"]);
            // $timesheet["id"] = $getTimeSheet->id;
            // $timesheet["user"] = $this->getUser($getTimeSheet->user_id);
            // $timesheet["start"] = $getTimeSheet->start;
            // $timesheet["end"] = $getTimeSheet->end;
            // $timesheet["status"] = $getTimeSheet->status;
            // return $timesheet;
            return $obj;
            // return $this->test();
            // return (array) $getTimeSheet;

        } else {
            return [];
        }
    }

    public function SupervisorReport(Request $request)
    {
        $station = $request->station_id;
        $date = $request->date;

        $date = str_replace('/', '-', $date);

        $supervisorReport = array();

        $allShift = DB::table('app_report')
            ->orderByDesc('start_at')
            ->where('id', 157)
            ->where('station_id', $station)
            ->get();


        for ($i = 0; $i < count($allShift); $i++) {

            $res1 = $allShift[$i]->start_at;

            if (str_contains($res1, $date)) {  // if(str_starts_with($res1,$date)){

                $inDay = array();
                $day = substr($res1, 8, 2);

                if ($allShift[$i]->confirm == '11111') {

                    $acceptedReports = DB::table('app_financial')
                        ->where('station_id', $station)
                        ->get();

                    for ($t = 0; $t < count($acceptedReports); $t++) {
                        $rowsID = unserialize($acceptedReports[$t]->report_id);
                        foreach ($rowsID as $row) {
                            if ($row == $allShift[$i]->id) {
                                $inDay['accepted'] = $acceptedReports[$t];
                            }
                        }
                    }
                }
                for ($j = 0, $c = 1; $j < count($allShift); $j++) {
                    $res2 = $allShift[$j]->start_at;
                    if (str_contains($res2, $date) & substr($allShift[$j]->start_at, 8, 2) == $day) {

                        $inDay[$c]["id"] = $allShift[$j]->id;
                        $inDay[$c]["station_id"] = $allShift[$j]->station_id;
                        $mUser = json_decode($allShift[$j]->users, true);

                        $shiftUserCreator = $mUser["creator"];
                        $shiftUserAssistant = @$mUser['assistant'];
                        $shiftUserFinisher = @$mUser['finisher'];

                        $inDay[$c]["timesheet"]["creator"] = $this->getTimeSheet(
                            $shiftUserCreator,
                            $allShift[$j]->id
                        );

                        if ($shiftUserCreator != $shiftUserAssistant) {

                            $inDay[$c]["timesheet"]["creator"] = $this->getTimeSheet(
                                $shiftUserCreator,
                                $allShift[$j]->id
                            );

                            if ($shiftUserFinisher) {

                                $inDay[$c]["timesheet"]["finisher"] = $this->getTimeSheet(
                                    $shiftUserFinisher,
                                    $allShift[$j]->id
                                );
                            } elseif ($shiftUserAssistant) {
                                $inDay[$c]["timesheet"]["assistant"] = $this->getTimeSheet(
                                    $shiftUserAssistant,
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
                        $inDay[$c]["update_at"] = $allShift[$j]->update_at;

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

    public function UnacceptedReport(Request $request)
    {
        $station = $request->station_id;

        $unacceptedReport = array();

        $allShift = DB::table('app_report')
            ->where('station_id', $station)
            ->where('confirm', 11110)
            ->get();

        if ($allShift) {

            for ($i = 0; $i < count($allShift); $i++) {

                $date1 = $allShift[$i]->start_at;
                $date1 = substr($date1, 0, 10);
                $inDay = array();

                for ($j = 0, $c = 1; $j < count($allShift); $j++) {

                    $date2 = $allShift[$j]->start_at;

                    if (str_contains($date2, $date1)) {

                        $inDay[$c]["id"] = $allShift[$j]->id;
                        $inDay[$c]["station_id"] = $allShift[$j]->station_id;
                        $mUser = json_decode($allShift[$j]->users, true);

                        $shiftUserCreator = $mUser["creator"];

                        isset($mUser['assistant'])
                            ? $shiftUserAssistant = $mUser['assistant']
                            : $shiftUserAssistant = null;

                        isset($mUser['finisher'])
                            ? $shiftUserFinisher = $mUser['finisher']
                            : $shiftUserFinisher = null;

                        if ($shiftUserCreator == $shiftUserAssistant) {

                            $inDay[$c]["timesheet"]["creator"] = $this->getTimeSheet(
                                $shiftUserCreator,
                                $allShift[$j]->id
                            );
                        } else {
                            $inDay[$c]["timesheet"]["creator"] = $this->getTimeSheet(
                                $shiftUserCreator,
                                $allShift[$j]->id
                            );

                            if ($shiftUserFinisher) {

                                $inDay[$c]["timesheet"]["finisher"] = $this->getTimeSheet(
                                    $shiftUserFinisher,
                                    $allShift[$j]->id
                                );
                            } elseif ($shiftUserAssistant) {
                                $inDay[$c]["timesheet"]["assistant"] = $this->getTimeSheet(
                                    $shiftUserAssistant,
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
                        $inDay[$c]["update_at"] = $allShift[$j]->update_at;

                        $c++;
                    }
                }

                $unacceptedReport[$date1] = $inDay;
            }

            return $message = array(
                "status" => "1",
                "message" => "Data returned successfully.",
                "data" => $unacceptedReport
            );
        } else {
            return $message = array(
                "status" => "2",
                "message" => "Not existing unaccepted Report for show"
            );
        }
    }

    public function AcceptedReport(Request $request)
    {

        $user_id = $request->user_id;
        $date = $request->date;
        $receipt_number = $request->receipt_number;
        $amount = $request->amount;
        $id_list = $request->id_list;

        function get_numerics($str)
        {
            preg_match_all('/\d+/', $str, $matches);
            return $matches[0];
        }

        $id_list = get_numerics($id_list);

        $station_id = DB::table("app_users")
            ->where('id', $user_id)
            ->value('station');

        $create_date = jdate();


        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);

        $filePath = "";

        $path = 'images/report/' . $station_id . '/' . $year . '/' . $month . '/';
        $name = $year . $month . $day . '-receipt.jpg';

        if ($request->receipt_image) {

            $image = $request->receipt_image;
            $image->move(
                $path,
                $name
            );
            $filePath = $path . $name;
        } else {
            $filePath = 'N/A';
        }

        if ($filePath != 'N/A') {

            $insertInAppFinancial = DB::table('app_financial')
                ->insertGetId([
                    'user_id' => $user_id,
                    'station_id' => $station_id,
                    'report_id' => serialize($id_list), // serialized
                    'date' => $date,
                    'receipt_number' => $receipt_number,
                    'receipt_image' => $filePath,
                    'amount' => $amount,
                    'create_at' => $create_date,
                ]);

            if ($insertInAppFinancial) {

                foreach ($id_list as $id) {
                    $update = DB::table('app_report')
                        ->where('id', $id)
                        ->update(['confirm' => '11111']);
                }


                return $message = array(
                    'status' => '1',
                    'message' => 'insert seccesfully',
                    'data' => $insertInAppFinancial
                );
            } else {
                return $message = array(
                    'status' => '0',
                    'message' => 'insert has error',
                    'data' => []
                );
            }
        } else {
            return $message = array(
                'status' => '0',
                'message' => 'image error',
                'data' => []
            );
        }
    }
}
