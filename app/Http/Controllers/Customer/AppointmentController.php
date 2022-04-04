<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Packages;
use App\Models\Clinic_services;
use App\Models\Receipt_orders;
use App\Models\Appointments;
use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\Ratings;
use App\Models\Clinic_time_availability;
use App\Models\Logs;
use App\Models\Clinic_specialists;


class AppointmentController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Adding Appointment (Myself & Relative)

        $appointMyself = $request->appointment;

        // Rating (Customer to Clinic)
        if ($request->rating) {

            $clinic_id = User_as_clinic::where('id', '=', $request->ratee_id)->first();
            $ratee = User::where('id', '=', $clinic_id->users_id)->first();

            $rating = new Ratings();
            $rating->rating = $request->rating;
            $rating->comment = null;
            $rating->users_id_ratee = $ratee->id;
            $rating->users_id_rater = $request->rater_id;
            $rating->save();

            return response()->json(['data' => $request->rating]);
        }

        if ($appointMyself == "myself") {
            $fname = $request->fname;
            $mname = $request->mname;
            $lname = $request->lname;
            $gender = $request->gender;
            $age = $request->age;
            $phone = $request->phone;
            $addline1 = $request->addline1;
            $addline2 = $request->addline2;

            $patient_details = $fname . " " . $mname . " " . $lname . ',' . $gender . ',' . $age . ',' . $phone;
            $patient_address = $addline1 . ',' . $addline2;

            $receipt = new Receipt_orders;
            $receipt->packages_id = $request->package;
            $receipt->user_as_clinic_id = $request->clinic_id;
            $receipt->user_as_customer_id = $request->user_as_customer_id;
            $receipt->patient_details =  $patient_details;
            $receipt->patient_address =  $patient_address;
            // $receipt->clinic_services_id = $request->service;
            $receipt->save();

            if ($request->service_ids) {

                $service_ids = request('service_ids'); //Gettinng string of ids
                $service_ids_array = explode(',', $service_ids); //splitting string into sepratae string using the comma
                foreach ($service_ids_array as $key) {

                    $receiptService = new Receipt_orders_has_clinic_services;
                    $receiptService->receipt_orders_id = $receipt->id;
                    $receiptService->clinic_services_id = $key;
                    $receiptService->save();
                }
            }

            $appoint = new Appointments;
            $appoint->created_at = $request->date;

            $dates = $request->datetime;
            $date = date("Y-m-d", strtotime($dates));
            $appoint->appointed_at = $date;

            $times = $request->datetime;
            $time = date("H:i", strtotime($times));
            $appoint->time = $time;

            $appoint->receipt_orders_id = $receipt->id;
            $appoint->appointment_status_id = 2;
            $appoint->save();

            //checking logs limit 5000
            $logs_count = Logs::where('user_as_clinic_id', '=',  $request->clinic_id)->count();
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $request->clinic_id)->first()->delete();
            }


            $user = User::where('email', '=',  Auth::user()->email)->first();
            $customer = User_as_customer::where('users_id', '=', $user->id)->first();

            //creating logs
            $logs = new Logs();
            $logs->message = $customer->fname . ' ' . $customer->lname . " requested an appointment.";
            $logs->remark = "notif";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $request->clinic_id;
            $logs->save();
        } else {


            $validator = Validator::make($request->all(), [
                'fname' => 'required|min:2',
                'lname' => 'required|min:2',
                'gender' => 'required|min:4',
                'phone' => 'required|numeric|min:11',
                'age' => 'required|numeric|min:1',
                'addline1' => 'required|min:2'

            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {

                $fname = $request->fname;
                $mname = $request->mname;
                $lname = $request->lname;
                $gender = $request->gender;
                $age = $request->age;
                $phone = $request->phone;
                $addline1 = $request->addline1;
                $addline2 = $request->addline2;

                $patient_details = $fname . " " . $mname . " " . $lname . ',' . $gender . ',' . $age . ',' . $phone;
                $patient_address = $addline1 . ',' . $addline2;

                $receipt = new Receipt_orders;
                $receipt->packages_id = $request->package;
                $receipt->user_as_clinic_id = $request->clinic_id;
                $receipt->user_as_customer_id = $request->user_as_customer_id;
                $receipt->patient_details = $patient_details;
                $receipt->patient_address = $patient_address;
                // $receipt->clinic_services_id =  $request->service;
                $receipt->save();


                if ($request->service_ids) {

                    $service_ids = request('service_ids'); //Gettinng string of ids
                    $service_ids_array = explode(',', $service_ids); //splitting string into sepratae string using the comma
                    foreach ($service_ids_array as $key) {

                        $receiptService = new Receipt_orders_has_clinic_services;
                        $receiptService->receipt_orders_id = $receipt->id;
                        $receiptService->clinic_services_id = $key;
                        $receiptService->save();
                    }
                }

                $appoint = new Appointments;
                $appoint->created_at = $request->date;

                $dates = $request->datetime;
                $date = date("Y-m-d", strtotime($dates));
                $appoint->appointed_at = $date;

                $times = $request->datetime;
                $time = date("H:i", strtotime($times));
                $appoint->time = $time;

                $appoint->receipt_orders_id = $receipt->id;
                $appoint->appointment_status_id = 2;
                $appoint->save();

                //checking logs limit 5000
                $logs_count = Logs::where('user_as_clinic_id', '=',  $request->clinic_id)->count();
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $request->clinic_id)->first()->delete();
                }

                $user = User::where('email', '=',  Auth::user()->email)->first();
                $customer = User_as_customer::where('users_id', '=', $user->id)->first();

                //creating logs
                $logs = new Logs();
                $logs->message = $customer->fname . ' ' . $customer->lname . " requested an appointment.";
                $logs->remark = "notif";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $request->clinic_id;
                $logs->save();
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Clinic Information (before making Appointment)

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $clinic_data = User_as_clinic::where('id', '=', $id)->first();
        $clinic_type = Clinic_types::where('id', '=', $clinic_data->clinic_types_id)->first();
        $clinic_address = User_address::where('id', '=', $id)->first();
        $services = Clinic_services::where('user_as_clinic_id', '=', $id)->get();
        $packages = Packages::where('user_as_clinic_id', '=', $id)->get();

        $rootClinic = User::where('id', '=', $clinic_data->users_id)->first();

        $rate = Ratings::where('users_id_ratee', '=', $rootClinic->id)->pluck('rating')->avg();

        $availability_data = Clinic_time_availability::where('user_as_clinic_id', '=', $clinic_data->id)->first();

        $split_data = explode("&", $availability_data->summary);
        $count = 0;
        foreach ($split_data as $key) {
            $this_data = explode("*", $key);
            $count++;

            $availability[] = (object) array(
                "day" => $this_data[0],
                "min" => $this_data[1],
                "max" =>  $this_data[2],
                "status" =>  $this_data[3],
            );
        }

        $doctor = Clinic_specialists::where('user_as_clinic_id', '=', $clinic_data->id)->get();

        //  echo json_encode($doctor);
        // echo($doctor);
        return view('customerViews.appointment.appointment', ['doctor'=> $doctor, 'avail' => $availability, 'customer' => $customer, 'rate' => $rate, 'clinic_data' => $clinic_data, 'clinic_type' => $clinic_type, 'clinic_address' => $clinic_address, 'services' => $services, 'packages' => $packages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Making Appointment (Myself) 

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $clinic_id = $id;
        $clinic_data = User_as_clinic::where('id', '=', $clinic_id)->first();

        $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
        $service = Clinic_services::where('user_as_clinic_id', '=', $id)->get();
        $package = Packages::where('user_as_clinic_id', '=', $id)->get();
        // echo($package);

        $availability_data = Clinic_time_availability::where('user_as_clinic_id', '=', $clinic_id)->first();

        $split_data = explode("&", $availability_data->summary);
        $count = 0;
        foreach ($split_data as $key) {
            $this_data = explode("*", $key);
            $count++;
            $availability[] = (object) array(
                "day" => $this_data[0],
                "min" => $this_data[1],
                "max" =>  $this_data[2],
                "status" =>  $this_data[3],
            );
        }

        // echo json_encode($availability);
        return view('customerViews.appointment.setAppointment', ['clinic_data' => $clinic_data,'avail' => $availability, 'customer' => $customer, 'customer_add' => $customer_add, 'package' => $package, 'service' => $service, 'clinic_id' => $clinic_id]);
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
        // $clinic_id = $id;
        // $availability_data = Clinic_time_availability::where('user_as_clinic_id', '=', $clinic_id)->first();

        // $split_data = explode("&", $availability_data->summary);
        // $count = 0;
        // foreach ($split_data as $key) {
        //     $this_data = explode("*", $key);
        //     $count++;
        //     $availability[] = (object) array(
        //         "day" => $this_data[0],
        //         "min" => $this_data[1],
        //         "max" =>  $this_data[2],
        //         "status" =>  $this_data[3],
        //     );
        // }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Negotiating Appointment (Mail: Appointment Status Accepted)  
        $appointment = Appointments::find($id);
        $appointment->appointment_status_id = 4;
        $appointment->save();

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $receipt = Receipt_orders::where('id', '=', $appointment->receipt_orders_id)->first();


        //checking logs limit 5000
        $logs_count = Logs::where('user_as_clinic_id', '=', $receipt->user_as_clinic_id)->count();
        if ($logs_count == 5000) {
            Logs::where('user_as_clinic_id', '=', $receipt->user_as_clinic_id)->first()->delete();
        }
        //creating logs
        $logs = new Logs();
        $logs->message = $customer->fname . ' ' . $customer->lname . " agreed to the suggested appointment day and time.";
        $logs->remark = "notif";
        $logs->date =  date("Y/m/d");
        $logs->time = date("h:i:sa");
        $logs->user_as_clinic_id =  $receipt->user_as_clinic_id;
        $logs->save();


        return response()->json(['all' => $appointment, 'status' => 'OK']);
    }
}
