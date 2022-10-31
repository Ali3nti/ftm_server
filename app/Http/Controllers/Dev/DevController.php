<?php

namespace App\Http\Controllers\Api;

use app\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevController extends Controller
{
    public function ChangeDate()
    {
        $all = DB::table('app_shift_data')
            ->get();

        for ($i = 0; $i < count($all); $i++) {
            $req = DB::table('app_shift_data')
                ->where('id', $all[$i]->id)
                ->update([
                    'start_shift_at' => jdate($all[$i]->start_shift_at), // jdate($article->created_at)->format('Y-m-d H:i:s');
                    'end_shift_at' => jdate($all[$i]->end_shift_at)
                ]);
        }

        return 'ok';
    }

    public function SerializeOperators()
    {

        $all = DB::table('app_shift_data')
            ->get();


        for ($i = 0; $i < count($all); $i++) {

            $operator = $all[$i]->operators_id;
            $operators = array($operator, $operator);
            $opt = serialize($operators);

            $req = DB::table('app_shift_data')
                ->where('id', $all[$i]->id)
                ->update(['operators_id' => $opt]);
        }

        return 'ok';
    }
}
