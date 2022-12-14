<?php

namespace App\Http\Controllers\Customer_API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\User;
use App\Models\Clinic_types;

class MAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcePatient = Messages::whereIn('receiver', ['all', 'patient'])->orderBy('id', 'desc')->get();

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        // echo (Messages::whereIn('receiver', ['all', 'patient'])->get());    
        return response()->json([
            'announceP'=>$announcePatient, 
            'customer'=>$customer,
            'user'=>$user
        ]);
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
