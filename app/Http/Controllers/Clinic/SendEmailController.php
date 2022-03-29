<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Logs;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'request' => $request->all()]);
        } else {

            //checking logs limit 5000
            $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            //creating logs
            $logs = new Logs();
            $logs->message = "You have sent an email to " . $request->name;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => $request->title,
                'body' => $request->message . ". Receipt order: " . $request->ro_id,
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            // Mail::to($request->email)->send(new EmailNotification($details));

            return response()->json([
                'tester' => $request->all(),
                'message' => "you have sent email to " . $request->name,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
