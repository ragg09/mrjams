<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Messages;
use App\Models\User_as_customer;
use App\Models\User;
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
        // $messageSender = User::where('id' , '=', $adminMessage->users_id)->get();
        // echo($adminMessage);
        // return view('adminViews.message', ['adminMessage'=>$adminMessage,'messageSender'=>$messageSender ]);
        return view('adminViews.message', ['adminMessage' => $adminMessage]);


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
        $adminSent = Messages::where('users_id', '=', 1)->get();
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
