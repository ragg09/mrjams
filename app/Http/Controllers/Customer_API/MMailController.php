<?php

namespace App\Http\Controllers\Customer_API;

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
use App\Models\Clinic_types;
use App\Models\Packages;
use App\Models\Appointment_status;
use App\Models\Receipt_orders_has_clinic_services;


class MMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();
        
         $user_id = $customer->id;

            $all_receipts = Receipt_orders::where('user_as_customer_id', '=',  $user_id)
                ->orderBy('id', 'desc')
                ->get();

            $count = 0;
            foreach ($all_receipts as $key) {
                $all_appointments = Appointments::where('receipt_orders_id', '=',  $key->id)->first();

                if ($all_appointments->appointment_status_id != 7) {
                    $all_clinics = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)->first();
                    $stat_id =  $all_appointments->appointment_status_id;
                    $stat = Appointment_status::where('id', '=', $stat_id)->first();

                    // if($all_appointments){
                    $all[] = [
                        "created_at" =>  $all_appointments->created_at, //galing sa appointment table
                        "appointed_at" => $all_appointments->appointed_at,
                        "time" =>  $all_appointments->time,
                        "status" =>  $all_appointments->appointment_status_id,
                        "remark" => $stat->status,
                        "name" => $all_clinics->name, //galing sa clinic table
                        "id" =>  $all_appointments->id
                    ];
                    $count++;
                    // }

                }
            }
        if ($count > 0) {
            return response()->json(['all' => $all, 'customer' => $customer]);
        } else {
            return response()->json(['status' => 0, 'customer' => $customer]);
        }
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

        // if ($id == 0) {

        //     // List of Appointments (Mail)

           
        // } else if (strpos($id, "status")) {

        //     // Dropdown Filter for Appointment Status (Mail)

        //     $astatus = explode(" ", $id);
        //     $user = User::where('email', '=',  Auth::user()->email)->first();
        //     $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        //     $receipt = Receipt_orders::where('user_as_customer_id', '=', $customer->id)
        //         ->orderBy('id', 'desc')
        //         ->get();

        //     $count = 0;
        //     foreach ($receipt as $key) {


        //         $all_appointments = Appointments::where('receipt_orders_id', '=',  $key->id)->first();

        //         if ($all_appointments->appointment_status_id == $astatus[0]) {
        //             $all_clinics = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)->first();
        //             $stat_id =  $all_appointments->appointment_status_id;
        //             $stat = Appointment_status::where('id', '=', $stat_id)->first();

        //             $all[] = [
        //                 "created_at" =>  $all_appointments->created_at, //galing sa appointment table
        //                 "appointed_at" => $all_appointments->appointed_at,
        //                 "time" =>  $all_appointments->time,
        //                 "status" =>  $all_appointments->appointment_status_id,
        //                 "remark" => $stat->status ?? "",
        //                 "name" => $all_clinics->name, //galing sa clinic table
        //                 "id" =>  $all_appointments->id
        //             ];
        //             $count++;
        //         }


        //         // if($all_appointments){

        //         // }
        //     }

        //     // return response()->json(['all'=>$all]);

        //     if ($count > 0) {
        //         return response()->json(['all' => $all, 'customer' => $customer]);
        //     } else {
        //         return response()->json(['status' => 0, 'customer' => $customer]);
        //     }
        // } 
        // // else if (strpos($id, "clinic")){
        // //     echo("hello");

        // // }
        // else {

            // Details of Appointment

            $user = User::where('email', '=',  Auth::user()->email)->first();
            $customer = User_as_customer::where('users_id', '=', $user->id)->first();

            $appointment_data = Appointments::where('id', '=', $id)->first();
            $receipt_info = Receipt_orders::where('id', '=', $appointment_data->receipt_orders_id)->first();

            $splitName = explode(",",  $receipt_info->patient_details);

            $clinic_info = User_as_clinic::where('id', '=', $receipt_info->user_as_clinic_id)->first();
            $clinic_type = Clinic_types::where('id', '=', $clinic_info->clinic_types_id)->first();
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
                    return response()->json([
                        'services_all' => $servies_all, 
                        'customer' => $customer, 
                        'name' => $splitName, 
                        'appointment_data' => $appointment_data, 
                        'clinic_info' => $clinic_info, 
                        'clinic_type' =>  $clinic_type,
                        'clinic_address' => $clinic_address, 
                        'service' => $service, 
                        'package' => $package, 
                        'status' => $status]);
                } else {
                    if (isset($service)) {
                        return response()->json([
                            'services_all' => $servies_all, 
                            'customer' => $customer, 
                            'name' => $splitName, 
                            'appointment_data' => $appointment_data, 
                            'clinic_info' => $clinic_info, 
                            'clinic_type' =>  $clinic_type,
                            'clinic_address' => $clinic_address, 
                            'package' => [],
                            'service' => $service, 
                            'status' => $status]);
                    } else {
                        return response()->json([
                            'customer' => $customer, 
                            'name' => $splitName, 
                            'appointment_data' => $appointment_data, 
                            'clinic_info' => $clinic_info, 
                            'clinic_type' =>  $clinic_type,
                            'clinic_address' => $clinic_address, 
                            'package' => $package, 
                            'services_all' => [],
                            'status' => $status]);
                    }
                }
            }
        // }
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
