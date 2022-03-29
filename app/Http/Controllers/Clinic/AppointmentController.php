<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Clinic_services;
use App\Models\Clinic_specialists;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function PHPSTORM_META\type;

class AppointmentController extends Controller
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


        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        foreach ($receipts as $key) {

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $key->id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $k) {
                $services_summary = $services_summary . ", " . $k->name;
            }


            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

            if ($appointments->appointment_status_id == 4) { //accepted appointments only
                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email ?? "",
                    "user_avatar" => $customer_root_data->avatar ?? "",

                    "app_id" =>  $appointments->id ?? "",
                    "app_created_at" =>  $appointments->created_at ?? "",
                    "time" =>  date("g:i a", strtotime($appointments->time)) ?? "",
                    "app_appointed_at" =>  $appointments->appointed_at ?? "",
                    "app_status" =>  $appointments->appointment_status_id ?? "",

                    "ro_id" =>  $key->id ?? "",
                    "ro_package_name" =>  $package->name ?? "",
                    "ro_services_name" => $services_summary ?? "",
                    "ro_customer_id" =>  $key->user_as_customer_id ?? "",
                    "ro_patient_details" =>  $key->patient_details ?? "",
                    "ro_patient_address" =>  $key->patient_address ?? "",
                );
            }

            if ($appointments->appointment_status_id == 5) { //accepted appointments only
                $complete_appointment_negotiations[] = (object) array(
                    "user_email" => $customer_root_data->email ?? "",
                    "user_avatar" => $customer_root_data->avatar ?? "",

                    "app_id" =>  $appointments->id ?? "",
                    "app_created_at" =>  $appointments->created_at ?? "",
                    "time" =>  date("g:i a", strtotime($appointments->time)) ?? "",
                    "app_appointed_at" =>  $appointments->appointed_at ?? "",
                    "app_status" =>  $appointments->appointment_status_id ?? "",

                    "ro_id" =>  $key->id ?? "",
                    "ro_package_name" =>  $package->name ?? "",
                    "ro_services_name" => $services_summary ?? "",
                    "ro_customer_id" =>  $key->user_as_customer_id ?? "",
                    "ro_patient_details" =>  $key->patient_details ?? "",
                    "ro_patient_address" =>  $key->patient_address ?? "",
                );
            }
        }

        //echo $complete_appointment_data;

        return view('clinicViews.appointment.accepted_view', [
            "accepted_data" => $complete_appointment_data ?? "",
            "negotiation_data" =>  $complete_appointment_negotiations ?? "",
        ]);

        // if ($count_app > 0) {
        //     return view('clinicViews.appointment.accepted_view', ["data" => $complete_appointment_data]);
        // } else {
        //     return view('clinicViews.appointment.accepted_view', ["data" => ""]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        foreach ($receipts as $key) {
            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)->first();
            if ($appointments) {
                //checking validity of appointment REGARDLESS IF ACCEPTED OR NOT || expiration date
                if (date("Y-m-d") > $appointments->appointed_at && !$appointments->appointment_status_id ==  6) {
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
            }
        }

        $count = 0;
        $count_app = 0;
        foreach ($receipts as $key) {

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  2) //for pending appointments
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $key->id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $k) {
                $services_summary = $services_summary . ", " . $k->name;
            }

            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();


            if ($appointments) {
                // echo  $customer_root_data;

                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email ?? "",
                    "user_avatar" => $customer_root_data->avatar ?? "",

                    "app_id" =>  $appointments->id ?? "", //galing sa appointmnent table
                    "app_created_at" =>  $appointments->created_at ?? "", //galing sa appointmnent table
                    "time" =>  $appointments->time ?? "", //galing sa appointmnent table
                    "app_appointed_at" =>  $appointments->appointed_at ?? "", //galing sa appointmnent table
                    "app_status" =>  $appointments->appointment_status_id ?? "", //galing sa appointmnent table

                    "ro_id" =>  $receipts[$count]->id ?? "", //galing sareceipts table
                    "ro_package_name" =>  $package->name ?? "", //galing sareceipts table
                    "ro_services_name" => $services_summary ?? "",
                    "ro_customer_id" =>  $receipts[$count]->user_as_customer_id ?? "", //galing sareceipts table
                    "ro_patient_details" =>  $receipts[$count]->patient_details ?? "", //galing sareceipts table
                    "ro_patient_address" =>  $receipts[$count]->patient_address ?? "", //galing sareceipts table
                );

                $count_app++;
            }

            $count++;
        }

        //echo json_encode($complete_appointment_data);

        if ($count_app > 0) {
            return view('clinicViews.appointment.index', ["data" => $complete_appointment_data,]);
        } else {
            return view('clinicViews.appointment.index', ["data" => ""]);
        }



        //return view('clinicViews.appointment.index');
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
        if ($id == 0) {
            $appointments = Appointments::where('appointment_status_id', '=',  2)->get();
            return response()->json(['data' =>  count($appointments)]);
        } else {

            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();


            $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('id', '=',  $id)
                ->first();

            $patient = explode(',', $receipts->patient_details); //splitting string into sepratae string using the comma

            $appointments = Appointments::where('receipt_orders_id', '=', $receipts->id)
                ->first();

            $package = Packages::where('id', '=', $receipts->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $key) {
                $services_summary = $services_summary . ", " . $key->name;
            }

            $customer = User_as_customer::where('id', '=', $receipts->user_as_customer_id)->first();
            $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

            $specialists = Clinic_specialists::where('user_as_clinic_id', '=', $clinic->id)->get();

            $complete_appointment_data = (object) array(
                "user_email" => $customer_root_data->email,
                "user_avatar" => $customer_root_data->avatar,
                "user_contact" => $customer->phone,
                "user_name" => $customer->fname . " " . $customer->lname,
                "user_gender" => $customer->gender,
                "user_age" => $customer->age,
                "user_address" => $customer_add->address_line_1 . " " . $customer_add->address_line_2 . " " . $customer_add->city,


                "app_id" => $appointments->id, //galing sa appointmnent table
                "app_created_at" =>  $appointments->created_at, //galing sa appointmnent table
                "time" =>  $appointments->time, //galing sa appointmnent table
                "app_appointed_at" =>  $appointments->appointed_at, //galing sa appointmnent table
                "app_status" =>  $appointments->appointment_status_id, //galing sa appointmnent table

                "ro_id" => $receipts->id ?? "", //galing sareceipts table
                "ro_package_name" => $package->name ?? "", //galing sareceipts table
                "ro_services_name" => $services_summary ?? "", //galing sareceipts table
                "ro_customer_id" => $receipts->user_as_customer_id ?? "", //galing sareceipts table

                "ro_patient_details" => $receipts->patient_details, //galing sareceipts table
                "ro_patient_address" => $receipts->patient_address, //galing sareceipts table

                "patient_name" => $patient[0] ?? "", //galing sareceipts table
                "patient_gender" => $patient[1] ?? "", //galing sareceipts table
                "patient_age" => $patient[2] ?? "", //galing sareceipts table
                "patient_contact" => $patient[3] ?? "", //galing sareceipts table
                "patient_address" => $receipts->patient_address, //galing sareceipts table
            );


            // $count = 0;
            // foreach ($receipts as $key) {



            //     $count++;
            // }

            return response()->json(['data' => $complete_appointment_data, 'specialists' => $specialists, 'tester' => $services_summary]);
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
        // return response()->json(['tester' => $request->all()]);
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $datetime = explode(' ', $request->datetime);
        $date = $datetime[0];
        $time = $datetime[1];


        $customer_email = $request->customer_email;

        //SUGGESTION: put timestamp on this table for trapping purposes
        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $appointments = Appointments::where('receipt_orders_id', '=', $id)->first();

        if ($appointments->appointed_at == $date && $appointments->time == $time) {
            //ACCEPT PATIENT'S TIME & DATE

            //verify date time if already taken
            foreach ($receipts as $key) {
                $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

                if ($this_app->appointed_at == $date && $this_app->time == $time && $this_app->appointment_status_id == 4) {
                    return response()->json([
                        'status' => 0,
                        'datetime' => "You have already set an appointment on this given time and date, please check your calendar for reference.",
                        'tester' => "error message"
                    ]);
                }
            }

            //IF TIME AND DATE PASSES VERIFICATION
            //accepted || accept customer's time request
            DB::table('appointments')
                ->where('receipt_orders_id', $id)
                ->update([
                    'appointment_status_id' =>  4, //4 is the id for accepted
                ]);

            $ro_update = Receipt_orders::find($id);
            $ro_update->specialist = $request->specialist ?? NULL;
            $ro_update->save();

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "Appointmen has been set with Receipt Order No: " . $id;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Appointment Accepted',
                'body' => 'Your appointment has been set, see you on ' . $date . " " . date("g:i a", strtotime($time)),
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            // Mail::to($customer_email)->send(new EmailNotification($details));

            //checking if there is a data left
            $count_app = Appointments::where('appointment_status_id', '=', 2)->get();

            return response()->json([
                'message' => 'Appointmnent Accepted with Reciept Order ' . $id,
                'count_app' => count($count_app),
                'tester' => "Accepted"
            ]);


            // return response()->json(['tester' => $receipts]);

            // $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();
            // $count = 0;
            // foreach ($receipts as $key) {
            //     $count++;
            //     $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();
            //     if ($this_app) {
            //         if ($this_app->appointed_at == $date && $this_app->time == $time && $this_app->appointment_status == 4) {
            //             //error message || checking if an time and date is already taken
            //             return response()->json(['status' => 0, 'datetime' => "Time and Date already taken", 'tester' => "error message"]);
            //         } else if ($count == count($receipts)) {
            //             //accepted || accept customer's time request
            //             DB::table('appointments')
            //                 ->where('receipt_orders_id', $id)
            //                 ->update([
            //                     'appointment_status_id' =>  4, //4 is the id for accepted
            //                 ]);

            //             $ro_update = Receipt_orders::find($id);
            //             $ro_update->specialist = $request->specialist ?? NULL;
            //             $ro_update->save();

            //             //checking logs limit 5000
            //             if ($logs_count == 5000) {
            //                 Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            //             }
            //             $logs = new Logs();
            //             $logs->message = "Appointmen has been set with Receipt Order No: " . $id;
            //             $logs->remark = "success";
            //             $logs->date =  date("Y/m/d");
            //             $logs->time = date("h:i:sa");
            //             $logs->user_as_clinic_id = $clinic->id;
            //             $logs->save();

            //             //sending email notification
            //             $details = [
            //                 'title' => 'Appointment Accepted',
            //                 'body' => 'Your appointment has been set, see you on ' . $date . " " . date("g:i a", strtotime($time)),
            //             ];
            //             // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            //             Mail::to($customer_email)->send(new EmailNotification($details));

            //             return response()->json(['message' => 'Appointmnent Accepted with Reciept Order ' . $id, 'tester' => "Accepted"]);
            //         }
            //     }
            // }
        } else {
            //NEGOTIATION

            //verify date time if already taken
            foreach ($receipts as $key) {
                $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

                if ($this_app->appointed_at == $date && $this_app->time == $time && $this_app->appointment_status_id == 4) {
                    return response()->json([
                        'status' => 0,
                        'datetime' => "You have already set an appointment on this given time and date, please check your calendar for reference.",
                        'tester' => "error message"
                    ]);
                }
            }

            //IF TIME AND DATE PASSES VERIFICATION
            //go to negotiating status
            DB::table('appointments')
                ->where('receipt_orders_id', $id)
                ->update([
                    'appointed_at' =>  $date,
                    'time' =>  $time,
                    'appointment_status_id' =>  5, //5 is the id for negotiating
                ]);

            $ro_update = Receipt_orders::find($id);
            $ro_update->specialist = $request->specialist ?? NULL;
            $ro_update->save();

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "Appointment is in a negotiation state with Receipt Order No: " . $id;
            $logs->remark = "warning";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            // //sending email notification
            // $details = [
            //     'clinic' => $clinic->name,
            //     'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
            //     'contact' => $clinic->phone,
            //     'title' => 'Appointment Negotiation',
            //     'body' => 'Your appointment has been changed to ' . $date . " " . date("g:i a", strtotime($time)) . '. Please confirm if you are available on the adjusted time, and cancel if not. Your patience is appreciated.',
            // ];
            // // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            // Mail::to($customer_email)->send(new EmailNotification($details));


            return response()->json(['message' => "Appointment is now under Negotiation", 'tester' => "negotiating na"]);

            // $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

            // $count = 0;
            // foreach ($receipts as $key) {
            //     $count++;
            //     $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

            //     if ($this_app) {
            //         if ($this_app->appointed_at == $date && $this_app->time == $time  && $this_app->appointment_status == 4) {
            //             //error message
            //             return response()->json(['status' => 0, 'datetime' => "Time and Date already taken", 'tester' => "error message"]);
            //         } else if ($count == count($receipts)) {

            //             //$this_receipt = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

            //             //go to negotiating status
            //             DB::table('appointments')
            //                 ->where('receipt_orders_id', $id)
            //                 ->update([
            //                     'appointed_at' =>  $date,
            //                     'time' =>  $time,
            //                     'appointment_status_id' =>  5, //5 is the id for negotiating
            //                 ]);

            //             $ro_update = Receipt_orders::find($id);
            //             $ro_update->specialist = $request->specialist ?? NULL;
            //             $ro_update->save();

            //             //checking logs limit 5000
            //             if ($logs_count == 5000) {
            //                 Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            //             }
            //             $logs = new Logs();
            //             $logs->message = "Appointment is in a negotiation state with Receipt Order No: " . $id;
            //             $logs->remark = "warning";
            //             $logs->date =  date("Y/m/d");
            //             $logs->time = date("h:i:sa");
            //             $logs->user_as_clinic_id = $clinic->id;
            //             $logs->save();

            //             //sending email notification
            //             $details = [
            //                 'title' => 'Appointment Negotiation',
            //                 'body' => 'Your appointment has been changed to ' . $date . " " . date("g:i a", strtotime($time)) . '. Please confirm it if you are available, and cancel if not.',
            //             ];
            //             // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            //             Mail::to($customer_email)->send(new EmailNotification($details));


            //             return response()->json(['message' => "Appointment is now under Negotiation", 'tester' => "negotiating na"]);
            //         }
            //     }
            // }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $receipt = Receipt_orders::where('id', '=',  $id)->first();
        $customer = User_as_customer::where('id', '=',  $receipt->user_as_clinic_id)->first();
        $customer_root = User::where('id', '=', $customer->users_id)->first();

        if (strpos($id, "DONE")) {
            //done appointment
            $getid = explode(" ", $id);

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Done Appointment',
                'body' => 'Your appointment is done. See you again.',
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            // Mail::to($customer_root->email)->send(new EmailNotification($details));

            DB::table('appointments')
                ->where('receipt_orders_id', $getid[0])
                ->update([
                    'appointment_status_id' =>  1, //1 is the id for DONE
                ]);

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "An appointment has been finished with Receipt Order No: " . $getid[0];
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            return response()->json(['message' => "DONE APPOINTMENT"]);
        } else {
            //declined appointment

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Appointment Declined',
                'body' => 'Your appointment has been declined, this is due to the following reasons: Clinic is out of service for a while, Your doctor is not avaialable, or unexpected activities occurs',
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            // Mail::to($customer_root->email)->send(new EmailNotification($details));

            DB::table('appointments')
                ->where('receipt_orders_id', $id)
                ->update([
                    'appointment_status_id' =>  3, //3 is the id for declined
                ]);

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "An appointment has been declined with Receipt Order No: " . $id;
            $logs->remark = "danger";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            return response()->json(['message' => "Appointment Declined"]);
        }
    }
}
