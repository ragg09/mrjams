<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Clinic_services;
use App\Models\Clinic_specialists;
use App\Models\Customer_logs;
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
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();



        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();



        foreach ($receipts as $key) {
            $package_service = [];

            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            if (isset($package)) {
                array_push($package_service, $package->name);
            }

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $key->id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $k) {
                $services_summary = $services_summary . ", " . $k->name;

                array_push($package_service, $k->name);
            }


            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

            if ($appointments->appointment_status_id == 4) { //accepted appointments only
                $dateime = $appointments->appointed_at . " " . $appointments->time;
                if (date("Y-m-d H:i") > $dateime) {
                    $update_app = Appointments::find($appointments->id);
                    $update_app->appointment_status_id = 6; //expired
                    $update_app->save();

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                    $logs->remark = "danger";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs_notif = new Logs();
                    $logs_notif->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                    $logs_notif->remark = "notif";
                    $logs_notif->date =  date("Y/m/d");
                    $logs_notif->time = date("h:i:sa");
                    $logs_notif->user_as_clinic_id = $clinic->id;
                    $logs_notif->save();

                    $this_ro = Receipt_orders::where("id", $appointments->receipt_orders_id)->first();

                    $clogs = new Customer_logs();
                    $clogs->message = "Your appointment has expired. Too bad " . $clinic->name . " expected you.";
                    $clogs->remark = "notif";
                    $clogs->date =  date("Y/m/d");
                    $clogs->time = date("h:i:sa");
                    $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
                    $clogs->save();
                } else {
                    $complete_appointment_data[] = (object) array(
                        "user_email" => $customer_root_data->email ?? "",
                        "user_avatar" => $customer_root_data->avatar ?? "",

                        "app_id" =>  $appointments->id ?? "",
                        "app_created_at" =>  $appointments->created_at ?? "",
                        "time" =>  date("g:i a", strtotime($appointments->time)) ?? "",
                        "app_appointed_at" =>  $appointments->appointed_at ?? "",
                        "app_status" =>  $appointments->appointment_status_id ?? "",
                        "package_service" => $package_service,
                        "ro_id" =>  $key->id ?? "",
                        "ro_package_name" =>  $package->name ?? "",
                        "ro_services_name" => $services_summary ?? "",
                        "ro_customer_id" =>  $key->user_as_customer_id ?? "",
                        "ro_patient_details" =>  $key->patient_details ?? "",
                        "ro_patient_address" =>  $key->patient_address ?? "",
                    );
                }
            }

            if ($appointments->appointment_status_id == 5) { // negotiation

                // echo date("Y-m-d H:i");
                $dateime = $appointments->appointed_at . " " . $appointments->time;
                if (date("Y-m-d H:i") > $dateime) {
                    $update_app = Appointments::find($appointments->id);
                    $update_app->appointment_status_id = 6; //expired
                    $update_app->save();

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                    $logs->remark = "danger";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs_notif = new Logs();
                    $logs_notif->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                    $logs_notif->remark = "notif";
                    $logs_notif->date =  date("Y/m/d");
                    $logs_notif->time = date("h:i:sa");
                    $logs_notif->user_as_clinic_id = $clinic->id;
                    $logs_notif->save();

                    $this_ro = Receipt_orders::where("id", $appointments->receipt_orders_id)->first();

                    $clogs = new Customer_logs();
                    $clogs->message = "Your appointment has expired. Too bad " . $clinic->name . " expected you.";
                    $clogs->remark = "notif";
                    $clogs->date =  date("Y/m/d");
                    $clogs->time = date("h:i:sa");
                    $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
                    $clogs->save();
                } else {
                    $complete_appointment_negotiations[] = (object) array(
                        "user_email" => $customer_root_data->email ?? "",
                        "user_avatar" => $customer_root_data->avatar ?? "",

                        "app_id" =>  $appointments->id ?? "",
                        "app_created_at" =>  $appointments->created_at ?? "",
                        "time" =>  date("g:i a", strtotime($appointments->time)) ?? "",
                        "app_appointed_at" =>  $appointments->appointed_at ?? "",
                        "app_status" =>  $appointments->appointment_status_id ?? "",
                        "package_service" => $package_service,
                        "ro_id" =>  $key->id ?? "",
                        "ro_package_name" =>  $package->name ?? "",
                        "ro_services_name" => $services_summary ?? "",
                        "ro_customer_id" =>  $key->user_as_customer_id ?? "",
                        "ro_patient_details" =>  $key->patient_details ?? "",
                        "ro_patient_address" =>  $key->patient_address ?? "",
                    );
                }
            }
        }



        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();



        return view('clinicViews.appointment.accepted_view', [
            "accepted_data" => $complete_appointment_data ?? "",
            "negotiation_data" =>  $complete_appointment_negotiations ?? "",
            "logs" =>  $logs
        ]);
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
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();

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
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = "An Appointment has been expired with Receipt Order No: " . $appointments->id;
                    $logs->remark = "danger";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    $this_ro = Receipt_orders::where("id", $appointments->receipt_orders_id)->first();

                    $clogs = new Customer_logs();
                    $clogs->message = "Your appointment has expired. Too bad " . $clinic->name . " expected you.";
                    $clogs->remark = "notif";
                    $clogs->date =  date("Y/m/d");
                    $clogs->time = date("h:i:sa");
                    $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
                    $clogs->save();
                }
            }
        }

        $count = 0;
        $count_app = 0;

        foreach ($receipts as $key) {
            $package_service = [];
            $appointments = Appointments::where('receipt_orders_id', '=',  $key->id)
                ->where('appointment_status_id', '=',  2) //for pending appointments
                ->first();

            $package = Packages::where('id', '=',   $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();


            if (isset($package)) {
                array_push($package_service, $package->name);
            }

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $key->id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $k) {
                $services_summary = $services_summary . ", " . $k->name;

                array_push($package_service, $k->name);
            }



            $customer = User_as_customer::where('id', '=',   $key->user_as_customer_id)->first();
            $customer_root_data = User::where('id', '=',   $customer->users_id)->first();


            if ($appointments) {
                // echo json_encode($package_service);
                // echo "<br";
                // echo  $customer_root_data;

                $complete_appointment_data[] = (object) array(
                    "user_email" => $customer_root_data->email ?? "",
                    "user_avatar" => $customer_root_data->avatar ?? "",

                    "app_id" =>  $appointments->id ?? "", //galing sa appointmnent table
                    "app_created_at" =>  $appointments->created_at ?? "", //galing sa appointmnent table
                    "time" =>  $appointments->time ?? "", //galing sa appointmnent table
                    "app_appointed_at" =>  $appointments->appointed_at ?? "", //galing sa appointmnent table
                    "app_status" =>  $appointments->appointment_status_id ?? "", //galing sa appointmnent table
                    "package_service" => $package_service,
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

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();



        if ($count_app > 0) {
            return view('clinicViews.appointment.index', ["data" => $complete_appointment_data, "logs" => $logs]);
        } else {
            return view('clinicViews.appointment.index', ["data" => "", "logs" => $logs]);
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
            $package_service = [];
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

            if (isset($package)) {
                array_push($package_service, $package->name);
            }

            $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $id)->get(['clinic_services_id']);

            $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
                ->whereIn('id', $ro_services_id)
                ->get();

            $services_summary = "";
            foreach ($services as $key) {
                $services_summary = $services_summary . ", " . $key->name;

                array_push($package_service, $key->name);
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
                "package_service" => implode(", ", $package_service),
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
        $logs_count = Logs::where('user_as_clinic_id', '=', $clinic->id)->count();

        $datetime = explode(' ', $request->datetime);
        $date = $datetime[0];
        $time = $datetime[1];


        $customer_email = $request->customer_email;

        //SUGGESTION: put timestamp on this table for trapping purposes
        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $appointments = Appointments::where('receipt_orders_id', $id)->first();
        $this_ro = Receipt_orders::where('id', '=', $id)->first();

        if ($appointments->appointed_at == $date && $appointments->time == $time) {
            //ACCEPT PATIENT'S TIME & DATE

            //verify date time if already taken IF NO OTHER DOCTORS (NO SPECIALIST ON SETTINGS)
            $specialists = Clinic_specialists::where('user_as_clinic_id', '=', $clinic->id)->get();
            if (count($specialists) == 0) {
                foreach ($receipts as $key) {
                    $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

                    if (isset($this_app)) {
                        if ($this_app->appointed_at == $date && $this_app->time == $time && $this_app->appointment_status_id == 4) {
                            return response()->json([
                                'status' => 0,
                                'datetime' => "You have already set an appointment on this given time and date, please check your calendar for reference.",
                                'tester' => "error message"
                            ]);
                        }
                    }
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
            $ro_update->specialist_id = $request->specialist ?? NULL;
            $ro_update->save();

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }



            $logs = new Logs();
            $logs->message = "Appointmen has been set with Receipt Order No: " . $id;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            $clogs = new Customer_logs();
            $clogs->message = "Your appointment has been accepted. See you at " . $clinic->name;
            $clogs->remark = "notif";
            $clogs->date =  date("Y/m/d");
            $clogs->time = date("h:i:sa");
            $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
            $clogs->save();

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Appointment Accepted',
                'body' => 'Your appointment has been set, see you on ' . $date . " " . date("g:i a", strtotime($time)),
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            Mail::to($customer_email)->send(new EmailNotification($details));

            //checking if there is a data left
            $count_app = Appointments::where('appointment_status_id', '=', 2)->get();

            return response()->json([
                'message' => 'Appointmnent Accepted with Reciept Order ' . $id,
                'count_app' => count($count_app),
                'tester' => "Accepted"
            ]);
        } else {
            //NEGOTIATION

            //verify date time if already taken IF NO OTHER DOCTORS (NO SPECIALIST ON SETTINGS)
            $specialists = Clinic_specialists::where('user_as_clinic_id', '=', $clinic->id)->get();
            if (count($specialists) == 0) {
                foreach ($receipts as $key) {
                    $this_app = Appointments::where('receipt_orders_id', '=', $key->id)->first();

                    if (isset($this_app)) {
                        if ($this_app->appointed_at == $date && $this_app->time == $time && $this_app->appointment_status_id == 4) {
                            return response()->json([
                                'status' => 0,
                                'datetime' => "You have already set an appointment on this given time and date, please check your calendar for reference.",
                                'tester' => "error message"
                            ]);
                        }
                    }
                }
            }

            //check existing negotiations
            $check_nego = Appointments::where('appointed_at', '=', $date)
                ->where('time', '=', $time)
                ->where('appointment_status_id', '=', 5)
                ->first();

            if ($check_nego) {
                return response()->json([
                    'status' => 5,
                    'datetime' => "You have already set a pending negotiation on the selected time and date. Please select again.",
                    'tester' => "error message"
                ]);
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
            $ro_update->specialist_id = $request->specialist ?? NULL;
            $ro_update->save();

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "Appointment is in a negotiation state with Receipt Order No: " . $id;
            $logs->remark = "warning";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            $clogs = new Customer_logs();
            $clogs->message = $clinic->name . " is negotiating for a new time and date. The clinic is waiting for your response.";
            $clogs->remark = "notif";
            $clogs->date =  date("Y/m/d");
            $clogs->time = date("h:i:sa");
            $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
            $clogs->save();

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Appointment Negotiation',
                'body' => 'Your appointment has been changed to ' . $date . " " . date("g:i a", strtotime($time)) . '. Please confirm if you are available on the adjusted time, and cancel if not. Your patience is appreciated.',
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            Mail::to($customer_email)->send(new EmailNotification($details));


            return response()->json(['message' => "Appointment is now under Negotiation", 'tester' => "negotiating na"]);
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
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();

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
            Mail::to($customer_root->email)->send(new EmailNotification($details));

            DB::table('appointments')
                ->where('receipt_orders_id', $getid[0])
                ->update([
                    'appointment_status_id' =>  1, //1 is the id for DONE
                ]);

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=', $clinic->id)->first()->delete();
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
            $this_ro = Receipt_orders::where('id', '=', $id)->first();

            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => 'Appointment Declined',
                'body' => 'Your appointment has been declined, this is due to the following reasons: Clinic is out of service for a while, Your doctor is not avaialable, or unexpected activities occurs',
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            Mail::to($customer_root->email)->send(new EmailNotification($details));

            DB::table('appointments')
                ->where('receipt_orders_id', $id)
                ->update([
                    'appointment_status_id' =>  3, //3 is the id for declined
                ]);

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "An appointment has been declined with Receipt Order No: " . $id;
            $logs->remark = "danger";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            $clogs = new Customer_logs();
            $clogs->message = "Your appointment at " . $clinic->name . " has been declined.";
            $clogs->remark = "notif";
            $clogs->date =  date("Y/m/d");
            $clogs->time = date("h:i:sa");
            $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
            $clogs->save();


            return response()->json(['message' => "Appointment Declined"]);
        }
    }
}
