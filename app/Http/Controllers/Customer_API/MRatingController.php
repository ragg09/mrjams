<?php

namespace App\Http\Controllers\Customer_API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\Appointments;
use App\Models\Receipt_orders;
use App\Models\Appointment_status;

class MRatingController extends Controller
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
        $getAdmin = User::where("role", "=", "admin")->first();
        $adminID = $getAdmin->id;

        $rating = new Ratings();
        $rating->rating = $request->rating;
        $rating->comment =  "FEEDBACK ~~ " . $request->area . ' ~@~' . $request->message;
        $rating->users_id_ratee = $adminID;
        $rating->users_id_rater = $user->id;
        $rating->save();
        
        return response()->json(['data'=> $request->rating]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();
        $clinic_id = $id;
        $clinic_data = User_as_clinic::where('id', '=', $clinic_id)->first();
        $rootClinic = User::where('id', '=', $clinic_data->users_id)->first();
        $rate = Ratings::where('users_id_ratee', '=', $rootClinic->id)->pluck('rating')->avg();

        return response()->json(['clinic_rate'=>$rate]);
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
