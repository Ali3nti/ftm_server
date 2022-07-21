<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;
use App\Models\General;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Complaint ;

class ComplaintController extends Controller
{
    public function complaint()
    {

        $generals = general::all();
        $colors = color::all();
        $headers = header::all();
        $footers = footer::all();


        return view('complaint',
            compact('generals','colors' , 'headers' ,'footers'));
    }

    public function validateWith($validator, Request $request = null)
    {
    }

    protected function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_family' => 'required|string|min:3',
            'subject' => 'required|string|min:2',
            'massage' => 'required|string|min:2',
            'mobile' => 'nullable|string|min:11|max:12',
            'email' => 'nullable|string|email|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $check = complaint::where([['name_family', '=', $request['name_family']], ['massage', '=', $request['massage']]])->first();
        if(!empty($check) ){
            return redirect()->back()->with('check', 'IT WORKS!');
        } else{
            $contact = new complaint($request->all());
            $contact->name_family = $request['name_family'];
            $contact->subject = $request['subject'];
            $contact->massage = $request['massage'];
            $contact->mobile = $request['mobile'];
            $contact->email = $request['email'];
            $contact->date = $request['date'];
            $contact->time = $request['time'];
            $contact->ip = $ip;
            $contact->save();
            return redirect()->back()->with('answer', 'IT WORKS!');
        }
    }
}
