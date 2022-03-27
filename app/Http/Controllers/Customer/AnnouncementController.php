<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User;

use DateTime;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Admins Announcement to Patient and All

        $announcePatient = Messages::whereIn('receiver', ['all', 'patient'])->get();

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        // echo (Messages::whereIn('receiver', ['all', 'patient'])->get());    
        return view('customerViews.announcement', ['announceP'=>$announcePatient, 'customer'=>$customer]);
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
        // Message (Customer to Admin)

            $user = User::where('email', '=',  Auth::user()->email)->first();

            $message = new Messages();
            $message->message = $request->message;
            $message->receiver = "admin";
            $message->users_id = $user->id;
            $message->save();
            
            // echo($request->message);            
            // return view('customerViews.announcement');
             return response()->json(['data'=> $request->message]);
    
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
