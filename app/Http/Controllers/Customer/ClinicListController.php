<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\Clinic_types;
use App\Models\Clinic_services;
use App\Models\Packages;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Receipt_orders;
use App\Models\Customer_logs;

class ClinicListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('customerViews.clinicList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // List of Registered Clinic

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $clinics = User_as_clinic::all();
        $count = 0;
        foreach ($clinics as $key) {
            $clinic_types = Clinic_types::where('id', '=',  $key->clinic_types_id)->first();
            $clinic_address = User_address::where('id', '=', $key->user_address_id)->first();
            $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
            $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();

            if (isset($package) || isset($service)) {

                if (isset($package)) {
                    $packname =  $package->name;
                    // $ClinicAdd["package"] = $package->name;
                }
                if (isset($service)) {
                    $sername = $service->name;
                    // $ClinicAdd["service"] = $service->name;
                }

                $all[] = (object) array(
                    "id" => $key->id,
                    "name" => $key->name,
                    "phone" => $key->phone,
                    "telephone" => $key->telephone,
                    "type_of_clinic" => $clinic_types->type_of_clinic,
                    "address_line_1" => $clinic_address->address_line_1,
                    "address_line_2" => $clinic_address->address_line_2,
                    "package" => $packname ?? "no data",
                    "service" => $sername ?? "no data"
                );

                $count++;
            }
        }

        if ($count > 0) {
            return response()->json(['all' => $all, 'customer' => $customer]);
            // return response()->json(['customer'=>$customer]);
        } else {
            return response()->json(['status' => 0, 'customer' => $customer]);
        }

        // return response()->json(['all'=>$clinics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($id == 0) {

            // Search Clinic 

            $user = User::where('email', '=',  Auth::user()->email)->first();
            // $clinic = User_as_clinic::where('users_id', '=', $user->id)->first();

            if ($request->ajax()) {
                // $info = "hello";
                $query = strtoupper($request->get('query'));
                $data = User_as_clinic::query()->where('name', 'LIKE', "%{$query}%")->get();

                $count = 0;
                if (count($data) > 0) {
                    foreach ($data as $key) {
                        $address = User_address::where('id', '=', $key->user_address_id)->first();
                        $type = Clinic_types::where('id', '=', $key->clinic_types_id)->first();
                        $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
                        $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();

                        if (isset($package) || isset($service)) {

                            if (isset($package)) {
                                $packname =  $package->name;
                                // $ClinicAdd["package"] = $package->name;
                            }
                            if (isset($service)) {
                                $sername = $service->name;
                                // $ClinicAdd["service"] = $service->name;
                            }

                            $ClinicAdd[] = (object) array(
                                "id" => $key->id,
                                "name" => $data[$count]->name,
                                "addLine1" => $address->address_line_1,
                                "addLine2" => $address->address_line_2,
                                "type" => $type->type_of_clinic,
                                "package" => $packname ?? "no data",
                                "service" => $sername ?? "no data"
                            );

                            $count++;
                        }
                    }


                    if ($count > 0) {
                        return  response()->json(['ClinicAdd' => $ClinicAdd, 'status' => 1]);
                    } else {
                        return response()->json(['status' => 0]);
                    }
                }
            }
        } else {

            // Search Clinic (Categorial Search)

            $user = User::where('email', '=',  Auth::user()->email)->first();

            if ($request->ajax()) {
                $query = $request->query;
                $data = User_as_clinic::where('clinic_types_id', $query)->get();

                $count = 0;
                if (count($data) > 0) {
                    foreach ($data as $key) {
                        $address = User_address::where('id', '=', $key->user_address_id)->first();
                        $type = Clinic_types::where('id', '=', $key->clinic_types_id)->first();
                        $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
                        $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();


                        if (isset($service)) {

                            if (isset($package)) {
                                $packname =  $package->name;
                                // $ClinicAdd["package"] = $package->name;
                            }
                            if (isset($service)) {
                                $sername = $service->name;
                                // $ClinicAdd["service"] = $service->name;
                            }

                            $ClinicAdd[] = (object) array(
                                "id" => $key->id,
                                "name" => $data[$count]->name,
                                "addLine1" => $address->address_line_1,
                                "addLine2" => $address->address_line_2,
                                "type" => $type->type_of_clinic,
                                "package" => $packname ?? "no data",
                                "service" => $sername ?? "no data"
                            );

                            $count++;
                        }
                    }

                    // echo($package);


                    if ($count > 0) {
                        return  response()->json(['ClinicAdd' => $ClinicAdd, 'status' => 1]);
                    } else {
                        return response()->json(['status' => 0]);
                    }
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
        // Negotiating Appointment (Mail: Appointment Status Declined)  
        $appointment = Appointments::find($id);
        $appointment->appointment_status_id = 3;
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
        $logs->message = $customer->fname . ' ' . $customer->lname . " declined to the suggested appointment day and time.";
        $logs->remark = "notif";
        $logs->date =  date("Y/m/d");
        $logs->time = date("h:i:s a");
        $logs->user_as_clinic_id =  $receipt->user_as_clinic_id;
        $logs->save();

        // customer logs
        $customer_logs_count = Customer_logs::where('user_as_customer_id', '=',  $customer->id)->count();
        if ($customer_logs_count == 5000) {
            Customer_logs::where('user_as_customer_id', '=',  $customer->id)->first()->delete();
        }

        $clinic_name = User_as_clinic::where('id', '=', $receipt->user_as_clinic_id)->first();

        //creating logs
        $c_log = new Customer_logs();
        $c_log->message = "You declined the scheduled appointment from " . $clinic_name->name;
        $c_log->remark = "notif";
        $c_log->date =  date("m/d/Y");
        $c_log->time = date("h:i a");
        $c_log->user_as_customer_id = $customer->id;
        $c_log->save();

        return response()->json(['all' => $appointment, 'status' => 'OK']);
    }
}
