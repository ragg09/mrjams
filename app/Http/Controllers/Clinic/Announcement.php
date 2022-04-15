<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use App\Models\Messages;
use App\Models\User;
use App\Models\User_as_clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Announcement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();

        $announcemnet = Messages::where("receiver", "!=", "customer")
            ->where("receiver", "!=", "admin")
            ->get();

        // foreach ($announcemnet as $key) {
        //     echo $key;
        //     echo "<br>";
        // }
        // echo json_encode($announcemnet);

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('clinicViews.announcement.index', ["logs" => $logs,  "announcemnet" =>  $announcemnet]);
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
        //
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
