<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use App\User;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Panel_admin ;
use App\Models\Complaint ;
use App\Models\Contact_us ;

class CommentController extends Controller
{
    public function index()
    {
        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $panel_admins = panel_admin::all();
        $complaints = complaint::all();
        $contact_us = contact_us::all();
        return view('admin.comment.index' , compact('generals','colors' , 'headers' ,'panel_admins','complaints','contact_us'));

    }

    public function delete_complaint(Request $request)
    {
        DB::table('complaints')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }
    public function delete_contact(Request $request)
    {
        DB::table('contact_uses')->where('id', '=', $request->id)->delete();
        return redirect()->back()->with('delete', 'IT WORKS!')->with(["ids" => $request->ids]) ;
    }


    public function complaint_message(){
        $generals = general::all();
        $colors = color::all();
        $complaints = complaint::all();
        return view('admin.comment.complaint_message' , compact('generals','colors' , 'complaints'));
    }
    public function contact_message(){
        $generals = general::all();
        $colors = color::all();
        $contact_us = contact_us::all();
        return view('admin.comment.contact_message' , compact('generals','colors' , 'contact_us'));
    }

    public function complaint_answer(Request $request){
        $v = verta();
        $idm = $request->idm;
        DB::table('complaints')->where('id', '=', $idm)->update([
            'visit' => '1' ,
            'answer'=> $request->answer ,
            'time_answer'=> $v->formatTime() ,
            'date_answer'=> $v->formatDate('Y/M/D')
        ]);
        return redirect()->back()->with('save', 'IT WORKS!')->with(["ids" => $request->ids]) ;

    }
    public function contact_answer(Request $request){
        $v = verta();
        $idm = $request->idm;
        DB::table('contact_uses')->where('id', '=', $idm)->update([
            'visit' => '1' ,
            'answer'=> $request->answer ,
            'time_answer'=> $v->formatTime() ,
            'date_answer'=> $v->formatDate('Y/M/D')
        ]);
        return redirect()->back()->with('save', 'IT WORKS!')->with(["ids" => $request->ids]) ;

    }

}
