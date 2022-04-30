<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Messages;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\Logs;
use App\Models\Customer_logs;
use App\Models\Appointments;
use App\Mail\AdminMail;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminMessage = Messages::where('receiver', '=', 'admin')->orderBy('id', 'desc')->get();
        foreach ($adminMessage as $key) {
            $sender = User::where('id', '=', $key->users_id)->first();

            $formatted_data_message[] = array(
                'id' => $key->id,
                'message' => $key->message,
                'sender' => $sender->email,
            );
        }

        // $messageSender = User::where('id' , '=', $adminMessage->users_id)->get();
        // echo($adminMessage);
        // return view('adminViews.message', ['adminMessage'=>$adminMessage,'messageSender'=>$messageSender ]);
        return view('adminViews.message', ['adminMessage' => $adminMessage, 'formatted_data_message' => $formatted_data_message ?? []]);


        //sang function 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminViews.layouts.message.messageCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adminMessage = Messages::where('receiver', '=', 'admin')->orderBy('id', 'desc')->get();

        $messages = new Messages();
        $messages->message = request('messageBody');
        $messages->receiver = request('messageSelect');
        $messages->users_id = 1;
        $messages->save();

        if (request('messageSelect') == 'clinic') {
            $getClinic = User_as_clinic::all();

            foreach ($getClinic as $key) {
                $notice = new Logs();
                $notice->message = "Announcement Notice";
                $notice->remark = "notif";
                $notice->date = date("Y/m/d");
                $notice->time = date("h:i:sa");
                $notice->user_as_clinic_id = $key->id;
                $notice->save();
            }
        }
        if (request('messageSelect') == 'patient') {
            $getPatient = User_as_customer::all();

            foreach ($getPatient as $key) {
                $notice = new Customer_logs();
                $notice->message = "Announcement Notice";
                $notice->remark = "notif";
                $notice->date = date("Y/m/d");
                $notice->time = date("h:i:sa");
                $notice->user_as_customer_id = $key->id;
                $notice->save();
            }
        }
        if (request('messageSelect') == 'all') {
            $getClinic = User_as_clinic::all();
            foreach ($getClinic as $key) {
                $notice = new Logs();
                $notice->message = "Announcement Notice";
                $notice->remark = "notif";
                $notice->date = date("Y/m/d");
                $notice->time = date("h:i:sa");
                $notice->user_as_clinic_id = $key->id;
                $notice->save();
            }

            $getPatient = User_as_customer::all();
            foreach ($getPatient as $key) {
                $notice = new Customer_logs();
                $notice->message = "Announcement Notice";
                $notice->remark = "notif";
                $notice->date = date("Y/m/d");
                $notice->time = date("h:i:sa");
                $notice->user_as_customer_id = $key->id;
                $notice->save();
            }
        }
        return view('adminViews.message', ['adminMessage' => $adminMessage]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminSent = Messages::where('users_id', '=', 1)->orderBy('id', 'desc')->get();
        // echo($adminSent);
        return view('adminViews.layouts.message.messageSent', ['adminSent' => $adminSent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $message = Messages::findOrFail($id);
        $senderID = $message->users_id;
        $userID = User::where('id', '=', $senderID)->first();
        // echo($userID);
        // echo($userID->id);
        $sender = User::where('id', '=', $userID->id)->first();

        // echo($message->message);
        return view('adminViews.layouts.message.messageReply', ['message' => $message, 'sender' => $sender]);
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
        // echo json_encode($request->all());
        $details = [
            'title' => 'MR.JAMS',
            'body' => request('messageReply'),
        ];

        // Mail::to($request->sender)->send(new AdminMail($details));
        Mail::to($request->sender)->send(new AdminMail($details));
        return "email sent";
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
