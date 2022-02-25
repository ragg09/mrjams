<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\Packages;
use App\Models\Clinic_services;
use App\Models\Receipt_orders;
use App\Models\Appointments;


class RelativeAppointment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customerViews.appointment.appointment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where('email', '=',  Auth::user()->email)->first();
        // $customer = User_as_customer::where('users_id', '=', $user->id)->get();
       
        // $customer_add = User_address::where('id', '=', $customer[0]->user_address_id)->get();
        // $service = Clinic_services::all();
        // $package = Packages::all();
       
        //  return view('customerViews.appointment.relativeAppointment',['customer'=>$customer, 'customer_add'=>$customer_add,'package'=>$package, 'service'=>$service]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $fname = $request->fname;
        // $mname = $request->mname;
        // $lname = $request->lname;
        // $gender = $request->gender;
        // $age = $request->age;
        // $phone = $request->phone;
        // $addline1 = $request->addline1;
        // $addline2 = $request->addline2;

        // $patient_details = $fname.$mname.$lname.','.$gender.','.$age.','.$phone;
        // $patient_address = $addline1.','.$addline2;

        // $receipt = new Receipt_orders;
        // $receipt->packages_id = $request->package;
        // $receipt->user_as_clinic_id = $request->clinic_id;
        // $receipt->user_as_customer_id = $request->user_as_customer_id;
        // $receipt->patient_details = $patient_details;
        // $receipt->patient_address = $patient_address;
        // $receipt->clinic_services_id =  $request->service;
        // $receipt->save();

        // $appoint = new Appointments;
        // $appoint->created_at = $request->date;
        // $appoint->appointed_at = $request->appointdate;
        // $appoint->time = $request->time;
        // $appoint->receipt_orders_id = $receipt->id;
        // $appoint->appointment_status_id = 2;
        // $appoint->save();
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->get();
        $clinic_id = $id;
        $customer_add = User_address::where('id', '=', $customer[0]->user_address_id)->get();
        $service = Clinic_services::where('user_as_clinic_id', '=', $id)->get();
        $package = Packages::where('user_as_clinic_id', '=', $id)->get();
    //    echo($clinic_id);
        return view('customerViews.appointment.relativeAppointment',['customer'=>$customer, 'customer_add'=>$customer_add,'package'=>$package, 'service'=>$service, 'clinic_id'=>$clinic_id]);
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
