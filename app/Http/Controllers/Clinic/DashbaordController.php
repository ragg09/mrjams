<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Clinic_specialists;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\DB;

class DashbaordController extends Controller
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


        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $count = 0;
        $count_app = 0;
        foreach ($receipts as $key) {

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  4) //for accecpted appointments
                ->first();

            $appointments_nego = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  5) //for accecpted but negotin
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

            //checking validity of appointment || expiration date
            if (isset($appointments->appointed_at) && date("Y-m-d") > $appointments->appointed_at) {
                $up_app = Appointments::find($appointments->id);
                $up_app->appointment_status_id =  6; //6 is the id for expired
                $up_app->save();

                //checking logs limit 5000
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                $logs->remark = "danger";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }


            //checking validity of appointment || expiration date
            if (isset($appointments_nego) && date("Y-m-d") > $appointments_nego->appointed_at) {
                $up_app = Appointments::find($appointments_nego->id);
                $up_app->appointment_status_id =  6; //6 is the id for expired
                $up_app->save();

                //checking logs limit 5000
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = "An Appointment has been expired with Receipt Order No: " . $appointments_nego->id;
                $logs->remark = "danger";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }

            if ($appointments) {
                $specialist = Clinic_specialists::where("id", $receipts[$count]->specialist_id)->first();

                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email,
                    "user_avatar" => $customer_root_data->avatar,

                    "app_id" =>  $appointments->id ?? "", //galing sa appointmnent table
                    "app_created_at" =>  $appointments->created_at ?? "", //galing sa appointmnent table
                    "time" =>  $appointments->time ?? "", //galing sa appointmnent table
                    "app_appointed_at" =>  $appointments->appointed_at ?? "", //galing sa appointmnent table
                    "app_status" =>  $appointments->appointment_status_id ?? "", //galing sa appointmnent tabl

                    "ro_id" =>  $receipts[$count]->id ?? "", //galing sareceipts table
                    "ro_package_name" =>  $package->name ?? "", //galing sareceipts table
                    "ro_services_name" => $services_summary ?? "",
                    "specialist" => $specialist->fullname ?? "Not mentioned",
                    "ro_customer_id" =>  $receipts[$count]->user_as_customer_id ?? "", //galing sareceipts table
                    "ro_patient_details" =>  $receipts[$count]->patient_details ?? "", //galing sareceipts table
                    "ro_patient_address" =>  $receipts[$count]->patient_address ?? "", //galing sareceipts table
                );
            }

            $count++;
        }

        return response()->json([
            'status' => 1,
            "data" => $complete_appointment_data ?? "",
        ]);
        //echo $complete_appointment_data;

        // if (count($appointments) > 0) {
        //     return response()->json(['status' => 1, "data" => $complete_appointment_data]);
        // } else {
        //     return response()->json(['status' => 0]);
        // }

        // if (count($appointments) > 0) {
        //     return response()->json(['data' => $data]);
        // } else {
        //     return response()->json(['status' => 0]);
        // }
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
