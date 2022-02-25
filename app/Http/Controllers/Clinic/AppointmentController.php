<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        $count = 0;
        $count_app = 0;
        foreach ($receipts as $key) {

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  2) //for pending appointments
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();


            if ($appointments) {
                // echo  $customer_root_data;

                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email,
                    "user_avatar" => $customer_root_data->avatar,

                    "app_id" =>  $appointments->id, //galing sa appointmnent table
                    "app_created_at" =>  $appointments->created_at, //galing sa appointmnent table
                    "time" =>  $appointments->time, //galing sa appointmnent table
                    "app_appointed_at" =>  $appointments->appointed_at, //galing sa appointmnent table
                    "app_status" =>  $appointments->appointment_status_id, //galing sa appointmnent table

                    "ro_id" =>  $receipts[$count]->id, //galing sareceipts table
                    "ro_package_name" =>  $package->name, //galing sareceipts table
                    "ro_customer_id" =>  $receipts[$count]->user_as_customer_id, //galing sareceipts table
                    "ro_patient_details" =>  $receipts[$count]->patient_details, //galing sareceipts table
                    "ro_patient_address" =>  $receipts[$count]->patient_address, //galing sareceipts table
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();


        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $count = 0;
        $count_app = 0;
        foreach ($receipts as $key) {

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  4) //for accecpted appointments
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

            if ($appointments) {
                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email,
                    "user_avatar" => $customer_root_data->avatar,

                    "app_id" =>  $appointments->id, //galing sa appointmnent table
                    "app_created_at" =>  $appointments->created_at, //galing sa appointmnent table
                    "time" =>  date("g:i a", strtotime($appointments->time)), //galing sa appointmnent table
                    "app_appointed_at" =>  $appointments->appointed_at, //galing sa appointmnent table
                    "app_status" =>  $appointments->appointment_status_id, //galing sa appointmnent table

                    "ro_id" =>  $receipts[$count]->id, //galing sareceipts table
                    "ro_package_name" =>  $package->name, //galing sareceipts table
                    "ro_customer_id" =>  $receipts[$count]->user_as_customer_id, //galing sareceipts table
                    "ro_patient_details" =>  $receipts[$count]->patient_details, //galing sareceipts table
                    "ro_patient_address" =>  $receipts[$count]->patient_address, //galing sareceipts table
                );
                $count_app++;
            }
            $count++;
        }

        //echo $complete_appointment_data;

        if ($count_app > 0) {
            return view('clinicViews.appointment.accepted_view', ["data" => $complete_appointment_data]);
        } else {
            return view('clinicViews.appointment.accepted_view', ["data" => ""]);
        }
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

            $customer = User_as_customer::where('id', '=', $receipts->user_as_customer_id)->first();
            $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

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

                "ro_id" => $receipts->id, //galing sareceipts table
                "ro_package_name" => $package->name, //galing sareceipts table
                "ro_customer_id" => $receipts->user_as_customer_id, //galing sareceipts table

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

            return response()->json(['data' => $complete_appointment_data, 'tester' => $customer_add]);
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

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $datetime = explode(' ', $request->datetime);
        $date = $datetime[0];
        $time = $datetime[1];
        $customer_email = $request->customer_email;

        $appointments = Appointments::where('receipt_orders_id', '=', $id)->first();

        if ($appointments->appointed_at == $date && $appointments->time == $time) {
            //accepted
            $up_app = Appointments::find($id);
            $up_app->appointment_status_id =  4; //4 is the id for accepted
            $up_app->save();


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
                'title' => 'Appointment Accepted',
                'body' => 'Your appointment has been set, see you on ' . $date . " " . date("g:i a", strtotime($time)),
            ];
            Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            //Mail::to($customer_email)->send(new EmailNotification($details));

            return response()->json(['message' => 'Appointmnent Accepted with Reciept Order ' . $id, 'tester' => "Accepted"]);
        } else {
            //negotiating

            $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

            $count = 0;
            foreach ($receipts as $key) {
                $count++;
                $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

                if ($this_app->appointed_at == $date && $this_app->time == $time) {
                    //error message
                    return response()->json(['status' => 0, 'datetime' => "Time and Date already taken", 'tester' => "error message"]);
                } else if ($count == count($receipts)) {
                    //go to negotiating status
                    $up_app = Appointments::find($id);
                    $up_app->appointed_at =  $date;
                    $up_app->time =  $time;
                    $up_app->appointment_status_id =  5; //5 is the id for negotiating
                    $up_app->save();

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

                    //sending email notification
                    $details = [
                        'title' => 'Appointment Negotiation',
                        'body' => 'Your appointment has been changed to ' . $date . " " . date("g:i a", strtotime($time)) . '. Please confirm it if you are available, and cancel if not.',
                    ];
                    Mail::to($customer_email)->send(new EmailNotification($details));


                    return response()->json(['message' => "Appointment is now under Negotiation", 'tester' => "negotiating na"]);
                }
            }

            // $all_appointments = Appointments::where('appointed_at', '=', $date)->get();
            // return response()->json(['tester' => $all_appointments]);
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
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $receipt = Receipt_orders::where('id', '=',  $id)->first();
        $customer = User_as_customer::where('id', '=',  $receipt->user_as_clinic_id)->first();
        $customer_root = User::where('id', '=', $customer->users_id)->first();

        //sending email notification
        $details = [
            'title' => 'Appointment Declined',
            'body' => 'Your appointment has been declined, this is due to the following reasons: mga buwakanang inang reason',
        ];
        Mail::to($customer_root->email)->send(new EmailNotification($details));

        $up_app = Appointments::find($id);
        $up_app->appointment_status_id =  3; //3 is the id for declined
        $up_app->save();

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

        return response()->json(['tester' => "Appointment Declined"]);
    }
}
