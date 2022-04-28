<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use App\Models\Receipt_orders;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\User_address;
use App\Models\Clinic_services;
use App\Models\Packages;
use App\Models\Appointment_status;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\Customer_logs;

class CPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $title = "Printing Title";
        return view('customerViews.mail.printAppointment');
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
 
         // Details of Appointment

         $user = User::where('email', '=',  Auth::user()->email)->first();
         $customer = User_as_customer::where('users_id', '=', $user->id)->first();
        
         $appointment_data = Appointments::where('id', '=', $id)->first();
         $receipt_info = Receipt_orders::where('id', '=', $appointment_data->receipt_orders_id)->first();


        // echo($receipt_info);
         $splitName = explode(",",  $receipt_info->patient_details);

         $clinic_info = User_as_clinic::where('id', '=', $receipt_info->user_as_clinic_id)->first();
         $clinic_address = User_address::where('id', '=', $clinic_info->user_address_id)->first();

         $receiptService = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $receipt_info->id)->get();

         $servies_all = [];
         foreach ($receiptService as $serviceR) {
             $service = Clinic_services::where('id', '=', $serviceR->clinic_services_id)->first();

             array_push($servies_all,  $service);
         }

         $package = Packages::where('id', '=', $receipt_info->packages_id)->first();
         $status = Appointment_status::where('id', '=', $appointment_data->appointment_status_id)->first();

         if (isset($service) || isset($package)) {
             if (isset($service) && isset($package)) {
                 return view('customerViews.mail.printAppointment', ['services_all' => $servies_all, 'customer' => $customer, 'name' => $splitName, 'appointment_data' => $appointment_data, 'clinic_info' => $clinic_info, 'clinic_address' => $clinic_address, 'service' => $service, 'package' => $package, 'status' => $status]);
             } else {
                 if (isset($service)) {
                     return view('customerViews.mail.printAppointment', ['services_all' => $servies_all, 'customer' => $customer, 'name' => $splitName, 'appointment_data' => $appointment_data, 'clinic_info' => $clinic_info, 'clinic_address' => $clinic_address, 'service' => $service, 'status' => $status]);
                 } else {
                     return view('customerViews.mail.printAppointment', ['customer' => $customer, 'name' => $splitName, 'appointment_data' => $appointment_data, 'clinic_info' => $clinic_info, 'clinic_address' => $clinic_address, 'package' => $package, 'status' => $status]);
                 }
             }
         }
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
