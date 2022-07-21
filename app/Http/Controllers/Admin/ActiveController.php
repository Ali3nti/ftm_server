<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Verta;
use App\User ;
use App\Models\Answer;

class ActiveController extends Controller
{

    protected function active_msg(Request $request)
    {
        DB::table('answers')->where('id', '=', $request->id)->update([
            'active' => '1',
        ]);
        return redirect()->back()->with('active', 'IT WORKS!') ;
    }
    protected function inactive_msg(Request $request)
    {
        DB::table('answers')->where('id', '=', $request->id)->update([
            'active' => '0',
        ]);
        return redirect()->back()->with('inactive', 'IT WORKS!') ;
    }
    protected function answer_msg(Request $request)
    {
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $v = verta();
        $users = user::where('code', '=', $request->code)->first() ;
        if(!empty($users)){
         $name =   $users->name ;
         $mobile =   $users->mobile ;
         $email =   $users->email ;
        }
        $answer = new answer($request->all());
        $answer->code = $request->code;
        $answer->mobile = $mobile;
        $answer->email = $email;
        $answer->name_family = $name;
        $answer->massage = $request->massage;
        $answer->answer = $request->name_ans;
        $answer->ip = $ip ;
        $answer->time = $v->formatTime();
        $answer->date = $v->formatDate('Y/M/D')  ;
        $answer->save();
        return redirect()->back()->with('answer_msg', 'IT WORKS!') ;
    }
}
