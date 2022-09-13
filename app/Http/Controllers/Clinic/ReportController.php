<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Clinic_equipment_inventory;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Clinic_specialists;
use App\Models\Clinic_specialists_compensation;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
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




        $top_specialist =  DB::table('receipt_orders')
            ->where('user_as_clinic_id', $clinic->id)
            ->select('specialist_id', DB::raw('count(*) as total'))
            ->groupBy('specialist_id')
            ->orderBy('total', 'desc')
            ->get();

        foreach ($top_specialist as $key) {

            if ($key->specialist_id > 0) {
                $this_specialist = Clinic_specialists::find($key->specialist_id);

                $complete_specialists_data[] = (object) array(
                    "id" => $key->specialist_id,
                    "name" => $this_specialist->fullname,
                    "specialization" => $this_specialist->specialization,
                    "served" => $key->total,
                );
            }
        }

        // return $complete_specialists_data;



        // $revenue_today = Billings::where(date('Y-m-d', strtotime('created_at')),  date('Y-m-d'))->get();

        // return  $revenue_today;



        //for accounting
        $total_paid = Billings::where('user_as_clinic_id', $clinic->id)->sum('total_paid');
        $total_balance = Billings::where('user_as_clinic_id', $clinic->id)->sum('balance');

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();




        return view('clinicViews.report.index', [
            'total_paid' => $total_paid,
            'total_balance' => $total_balance,
            'clinic' => $clinic,
            'complete_specialists_data' => $complete_specialists_data,
            'logs' => $logs,
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


        $ro = Receipt_orders::where('user_as_clinic_id', $clinic->id)->get();

        foreach ($ro as $key) {
            $ro_ids[] = $key->id;
        }

        if (isset($ro_ids)) {
            $appointments = Appointments::whereIn("receipt_orders_id", $ro_ids)->get();

            //ILL USED THIS FUNCTION TO RETURN JSON FOR MY STATISTICS

            //================== Top Appointment ============================//
            foreach ($appointments as $key) {
                $app_dates[] = $key->appointed_at;
            }

            $app_filtered_by_date = array_filter(array_count_values($app_dates), function ($v) {
                return $v > 0;
            });

            foreach ($app_filtered_by_date as $key => $value) {
                $count_done_appointment = Appointments::whereIn("receipt_orders_id", $ro_ids)
                    ->where("appointed_at", "=", $key)
                    ->where("appointment_status_id", "=", 1)
                    ->get();

                $appointment_stats[] = (object) array(
                    'date' => $key,
                    'incoming' => $value,
                    'done' => count($count_done_appointment),
                );
            }

            //================== Top Appointment ============================//

            //================== Top Service ============================//
            $services = Clinic_services::where('user_as_clinic_id', $clinic->id)->get(['name']);
            foreach ($services as $key) {
                $services_array[] = $key->name;
            }

            //get price summary in billing first CHANGE ID TO USER ID
            $billing_summary = Billings::where('user_as_clinic_id', $clinic->id)->get(['price_summary']);

            foreach ($billing_summary as $key) {
                $this_summary = explode(",", $key->price_summary);

                foreach ($this_summary as $k) {
                    $this_summary_2nd = explode(":", $k);

                    if (in_array($this_summary_2nd[0], $services_array)) {
                        $services_name_array[] = $this_summary_2nd[0];
                    }
                }
            }

            if (isset($services_name_array)) {
                $service_stats_summary = array_filter(array_count_values($services_name_array), function ($v) {
                    return $v > 0;
                });
            }

            if (isset($service_stats_summary)) {
                foreach ($service_stats_summary as $key => $value) {
                    $services_stats[] = (object) array(
                        'name' => $key,
                        'count' => $value,
                    );
                }
            }


            //================== Top Service ============================//

            //================== Top Service ============================//
            $packages = Packages::where('user_as_clinic_id', $clinic->id)->get(['name']);
            foreach ($packages as $key) {
                $packages_array[] = $key->name;
            }

            //get price summary in billing first CHANGE ID TO USER ID
            $billing_summary = Billings::where('user_as_clinic_id', $clinic->id)->get(['price_summary']);

            foreach ($billing_summary as $key) {
                $this_summary = explode(",", $key->price_summary);

                foreach ($this_summary as $k) {
                    $this_summary_2nd = explode(":", $k);

                    if (isset($packages_array)) {
                        if (in_array($this_summary_2nd[0], $packages_array)) {
                            $packages_name_array[] = $this_summary_2nd[0];
                        }
                    }
                }
            }

            if (isset($packages_name_array)) {
                $package_stats_summary = array_filter(array_count_values($packages_name_array), function ($v) {
                    return $v > 0;
                });
            }

            if (isset($package_stats_summary)) {
                foreach ($package_stats_summary as $key => $value) {
                    $packages_stats[] = (object) array(
                        'name' => $key,
                        'count' => $value,
                    );
                }
            }


            //================== Top Service ============================//

            //================== Top Consumed Materials ============================//
            $apps = Appointments::whereIn("receipt_orders_id", $ro_ids)
                ->where("appointment_status_id", 1)
                ->get();

            //filtring every equipmetns into comsumables only
            $equipmetns = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('type', '=',  "consumable")
                ->get();

            //setting consumable names in one array
            foreach ($equipmetns as $key) {
                $consumables[] = $key->name;
            }

            //getting done appointment id
            foreach ($apps as $key) {
                $done_ro_ids[] =  $key->receipt_orders_id;
            }

            if (isset($done_ro_ids)) {
                foreach ($done_ro_ids as $key) {
                    $this_billing = Billings::where("receipt_orders_id", $key)->first();

                    if (isset($this_billing->materials_summary)) {
                        $exploded_materials = explode(",", $this_billing->materials_summary);
                    }


                    if (isset($exploded_materials)) {
                        foreach ($exploded_materials as $k) {
                            if ($k != "") {
                                $materials_array[] = $k;
                            }
                        }
                    }
                }
            }


            //filtering verified consumables
            if (isset($materials_array)) {
                foreach ($materials_array as $key) {
                    if (in_array($key, $consumables)) {
                        $verified_consumables[] = $key;
                    }
                }
            }


            //cpunt duplicates
            if (isset($verified_consumables)) {
                $consumable_stats_summary = array_filter(array_count_values($verified_consumables), function ($v) {
                    return $v > 0;
                });
            }


            //finalizing data
            if (isset($consumable_stats_summary)) {
                foreach ($consumable_stats_summary as $key => $value) {
                    $materials_stats[] = (object) array(
                        'name' => $key,
                        'count' => $value,
                    );
                }
            }


            // if (!isset($packages_stats) || !isset($materials_stats)) {
            //     $packages_stats  = 0;
            //     $materials_stats = 0;
            // }



            //================== Top Consumed Materials ============================//

            return response()->json([
                //Appointments
                'appointment_stats' => array_slice($appointment_stats, -30) ?? 0, //making sure that 1 month will fit the graph

                //Services
                'services_stats' =>  $services_stats  ?? 0,
                'services_count' => count($ro)  ?? 0,

                //Packages
                'packages_stats' =>  $packages_stats  ?? 0,

                //Equipments/Materials
                'materials_stats' => $materials_stats  ?? 0,

                'tester' =>   "tester",
            ]);
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
    public function show($id, Request $request)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_address = User_address::where('id', '=',  $clinic->user_address_id)->first();

        $date_range = explode(" to ", $request->datetime);

        //getting all dates in range
        function getBetweenDates($startDate, $endDate)
        {
            $rangArray = [];

            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            for (
                $currentDate = $startDate;
                $currentDate <= $endDate;
                $currentDate += (86400)
            ) {

                $date = date('Y-m-d', $currentDate);
                $rangArray[] = $date;
            }

            return $rangArray;
        }

        $dates = getBetweenDates($date_range[0], $date_range[1]);


        //getting equipments of this clinic
        $equipmetns = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        //setting consumable names in one array
        foreach ($equipmetns as $key) {
            $consumables[] = $key->name;
        }

        foreach ($dates  as $key) {
            $this_date = $key;

            $this_billing = Billings::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('created_at', 'LIKE', '%' . $key . '%')
                ->get();

            if (count($this_billing) > 0) {

                $app_count[] = count($this_billing);

                foreach ($this_billing as $kk) {
                    if (isset($kk->materials_summary)) {
                        $exploded_materials = explode(",", $kk->materials_summary);
                        // echo $kk->created_at;
                        // echo json_encode($exploded_materials);
                        // echo "<br><br>";
                        if (isset($this_material)) {
                            $this_material = [];
                        }

                        foreach ($exploded_materials as $kmat) {
                            $this_material[] =  $kmat;
                        }
                    }
                }

                //cpunt duplicates
                if (isset($this_material)) {
                    $all_material = array_filter(array_count_values($this_material), function ($v) {
                        return $v > 0;
                    });

                    //array_push($all_material, "date" => $this_date);
                    // $all_material['date'] = $this_date;

                    // echo json_encode($all_material);


                    // echo "<br><br>";

                    // $daily_report[] =  $all_material;
                }





                // finalizing data
                if (isset($all_material)) {
                    if (isset($materials_summary)) {
                        $materials_summary = [];
                    }

                    foreach ($all_material as $key => $value) {
                        $materials_summary[] = (object) array(
                            'name' => $key,
                            'count' => $value,
                        );
                    }
                    $daily_report_date[] = $this_date;
                    $daily_report[] =  $materials_summary;
                }
            }


            // echo  $this_billing;
            // echo "<br>";
            // echo "<br>";
        }


        // echo json_encode($daily_report_date);
        // echo json_encode($daily_report);

        // for ($i = 0; $i < count($daily_report_date); $i++) {
        //     echo "Date: " . $daily_report_date[$i];
        //     echo "<br>";
        //     foreach ($daily_report[$i] as $key) {
        //         echo "Name: " . $key->name . "| Count: " . $key->count;
        //         echo "<br>";
        //     }


        //     echo "<br><br>";
        // }




        // print_r($dates);

        // return response()->json([
        //     'tester' =>   $this_billing,
        // ]);



        return view('clinicViews.print.material_generated_report', [
            'clinic' => $clinic,
            'user' => $user,
            'selected_date' => $date_range,
            'clinic_address' => $clinic_address,
            'app_count' => $app_count,
            'daily_report_date' => $daily_report_date,
            'daily_report' => $daily_report,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_address = User_address::where('id', '=',  $clinic->user_address_id)->first();

        $date_range = explode(" to ", $request->datetime_report_generator);
        //FOR GETTING DATE
        //getting all dates in range
        function getBetweenDatesReport($startDate, $endDate)
        {
            $rangArray = [];

            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            for (
                $currentDate = $startDate;
                $currentDate <= $endDate;
                $currentDate += (86400)
            ) {

                $date = date('Y-m-d', $currentDate);
                $rangArray[] = $date;
            }

            return $rangArray;
        }



        if (count($date_range) > 1) {
            $dates = getBetweenDatesReport($date_range[0], $date_range[1]);
        } else {

            if ($request->datetime_report_generator == "") {
                $dates[] = date("Y-m-d");
            } else {
                $dates[] = $request->datetime_report_generator;
            }
        }


        // echo json_encode($dates);
        // dd($dates);

        $this_ro = Receipt_orders::where("user_as_clinic_id", $clinic->id)->get();

        foreach ($this_ro as $ro_key) {
            $this_clinic_appointments[] = Appointments::where("receipt_orders_id", $ro_key->id)->first();
        }

        $this_bills = Billings::where("user_as_clinic_id", $clinic->id)->get();

        $daily_report = array();



        foreach ($dates as $date_key) {

            $this_day_summary = array();

            ############################# FOR APPOINTMENTS  #############################
            if (isset($request->app_option_selected)) {
                if ($request->app_option_selected == "detailed") { //FOR DETAILED APPOINTMENT

                    if (isset($request->app_done)) { //DONE ISSET
                        // echo "done appointments";

                        $all_done = Billings::where("user_as_clinic_id", $clinic->id)
                            ->where('created_at', 'LIKE', '%' . $date_key . '%')
                            ->get();

                        if (count($all_done) > 0) {
                            $complete_done_data = [];

                            foreach ($all_done as $key) {
                                $this_app = Appointments::where("receipt_orders_id", $key->receipt_orders_id)->first();


                                $this_customer = User_as_customer::where("id", $key->user_as_customer_id)->first();

                                $treatment = array();
                                $first_explode = explode(",", $key->price_summary);
                                foreach ($first_explode as $k) {
                                    $sec_explode = explode(":", $k);

                                    array_push($treatment, $sec_explode[0]);
                                }


                                $complete_done_data[] = (object) array(
                                    "receipt" => $key->receipt_orders_id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_app->time,
                                );
                            }

                            array_push($this_day_summary, $complete_done_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }


                    if (isset($request->app_pending)) { //PENDING ISSET
                        // echo "pending appointments";
                        $all_pending = array();
                        if (isset($key->appointment_status_id)) {

                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 2 && $key->appointed_at == $date_key) {
                                    array_push($all_pending, $key);
                                }
                            }
                        }

                        if (count($all_pending) > 0) {
                            $complete_pending_data = [];

                            foreach ($all_pending as $al_p) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_p->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_pending_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_pending_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }

                    if (isset($request->app_declined)) { // DECLINED ISSET
                        // echo "declined appointments";
                        $all_declined = array();

                        if (isset($key->appointment_status_id)) {
                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 3 && $key->appointed_at == $date_key) {
                                    array_push($all_declined, $key);
                                }
                            }
                        }

                        if (count($all_declined) > 0) {
                            $complete_declined_data = [];

                            foreach ($all_declined as $al_d) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_d->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_declined_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_declined_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }


                    if (isset($request->app_accepted)) { // ACCEPTED ISSET
                        // echo "accepted appointments";
                        $all_accepted = array();
                        if (isset($key->appointment_status_id)) {
                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 4 && $key->appointed_at == $date_key) {
                                    array_push($all_accepted, $key);
                                }
                            }
                        }

                        if (count($all_accepted) > 0) {
                            $complete_accepted_data = [];

                            foreach ($all_accepted as $al_d) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_d->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_accepted_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_accepted_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }


                    if (isset($request->app_nego)) { // NEGO ISSET
                        // echo "nego appointments";
                        $all_nego = array();
                        if (isset($key->appointment_status_id)) {
                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 5 && $key->appointed_at == $date_key) {
                                    array_push($all_nego, $key);
                                }
                            }
                        }

                        if (count($all_nego) > 0) {
                            $complete_nego_data = [];

                            foreach ($all_nego as $al_d) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_d->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_nego_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_nego_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }


                    if (isset($request->app_expired)) { // EXPIRED ISSET
                        // echo "expired appointments";
                        $all_expired = array();
                        if (isset($key->appointment_status_id)) {
                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 6 && $key->appointed_at == $date_key) {
                                    array_push($all_expired, $key);
                                }
                            }
                        }

                        if (count($all_expired) > 0) {
                            $complete_expired_data = [];

                            foreach ($all_expired as $al_d) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_d->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_expired_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_expired_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }

                    if (isset($request->app_cancelled)) { // CANCELLED ISSET
                        // echo "cancelled appointments";
                        $all_cancelled = array();
                        if (isset($key->appointment_status_id)) {
                            foreach ($this_clinic_appointments as $key) {

                                if ($key->appointment_status_id == 8 && $key->appointed_at == $date_key) {
                                    array_push($all_cancelled, $key);
                                }
                            }
                        }

                        if (count($all_cancelled) > 0) {
                            $complete_cancelled_data = [];

                            foreach ($all_cancelled as $al_d) {
                                $treatment = array();

                                $this_ro = Receipt_orders::where("id", $al_d->receipt_orders_id)->first();
                                $this_customer = User_as_customer::where("id", $this_ro->user_as_customer_id)->first();

                                $ro_services = Receipt_orders_has_clinic_services::where("receipt_orders_id",  $this_ro->id)->get();

                                if (count($ro_services) > 0) {

                                    foreach ($ro_services as $ro_s) {
                                        $this_service = Clinic_services::where("id", $ro_s->clinic_services_id)->first();

                                        array_push($treatment,  $this_service->name);
                                    }
                                }

                                if ($this_ro->packages_id) {
                                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                                    array_push($treatment, $this_package->name);
                                }





                                $complete_cancelled_data[] = (object) array(
                                    "receipt" => $this_ro->id,
                                    "customer" => $this_customer->fname . " " . $this_customer->lname,
                                    "treatment" => implode(", ", $treatment),
                                    "time" => $this_ro->time,
                                );
                            }
                            array_push($this_day_summary,  $complete_cancelled_data);
                        } else {
                            array_push($this_day_summary, array());
                        }
                    } else {
                        array_push($this_day_summary, array());
                    }

                    //pushing the summary of the day

                }
            }
            ############################# ^^ FOR APPOINTMENTS ^^  #############################


            #############################  FOR BILLINGS   #############################

            if (isset($request->billing_fully_paid)) { // BILL FULLY PAID ISSET
                // echo "fully paid";
                $all_fully_paid = array();

                foreach ($this_bills as $key) {
                    if ($key->balance == 0) {
                        $date_explode = explode(" ", $key->created_at);

                        if ($date_explode[0] == $date_key) {
                            array_push($all_fully_paid, $key);
                        }
                    }
                }


                if (count($all_fully_paid) > 0) {
                    $complete_fully_paid_data = [];

                    foreach ($all_fully_paid as $al_paid) {
                        $treatment = array();
                        $this_customer = User_as_customer::where("id", $al_paid->user_as_customer_id)->first();

                        $first_explode = explode(",", $al_paid->price_summary);
                        foreach ($first_explode as $k) {
                            $sec_explode = explode(":", $k);

                            array_push($treatment, $sec_explode[0]);
                        }


                        $complete_fully_paid_data[] = (object) array(
                            "receipt" => $al_paid->receipt_orders_id,
                            "customer" => $this_customer->fname . " " . $this_customer->lname,
                            "treatment" => implode(", ", $treatment),
                            "time" => $al_paid->time,
                        );
                    }
                    array_push($this_day_summary,  $complete_fully_paid_data);
                } else {
                    array_push($this_day_summary, array());
                }
            } else {
                array_push($this_day_summary, array());
            }

            if (isset($request->billing_with_balance)) { // WITH BALANCE ISSET
                // echo "WITH BALANCE";
                $all_with_balance = array();

                foreach ($this_bills as $key) {
                    if ($key->balance > 1) {
                        $date_explode = explode(" ", $key->created_at);

                        if ($date_explode[0] == $date_key) {
                            array_push($all_with_balance, $key);
                        }
                    }
                }


                if (count($all_with_balance) > 0) {
                    $complete_with_balance_data = [];

                    foreach ($all_with_balance as $al_paid) {
                        $treatment = array();
                        $this_customer = User_as_customer::where("id", $al_paid->user_as_customer_id)->first();

                        $first_explode = explode(",", $al_paid->price_summary);
                        foreach ($first_explode as $k) {
                            $sec_explode = explode(":", $k);

                            array_push($treatment, $sec_explode[0]);
                        }


                        $complete_with_balance_data[] = (object) array(
                            "receipt" => $al_paid->receipt_orders_id,
                            "customer" => $this_customer->fname . " " . $this_customer->lname,
                            "treatment" => implode(", ", $treatment),
                            "time" => $al_paid->time,
                        );
                    }
                    array_push($this_day_summary,  $complete_with_balance_data);
                } else {
                    array_push($this_day_summary, array());
                }
            } else {
                array_push($this_day_summary, array());
            }

            ############################# ^^ FOR BILLINGS ^^  #############################


            #############################  FOR MATERIALS DAILY USAGE   #############################

            if (isset($request->material_used_per_day)) { // MATERIAL USED PER DAY ISSET
                // echo "USED PER DAY";
                $material_name = [];

                $this_clinic_materials = Clinic_equipments::where("user_as_clinic_id", $clinic->id)->get();

                foreach ($this_clinic_materials as $key) {
                    $material_name[] = $key->name;
                }

                $all_done = Billings::where("user_as_clinic_id", $clinic->id)
                    ->where('created_at', 'LIKE', '%' . $date_key . '%')
                    ->get();

                if (count($all_done) > 0) {
                    $complete_material_data = [];

                    $this_material = [];

                    foreach ($all_done as $kk) {
                        if (isset($kk->materials_summary)) {
                            $exploded_materials = explode(",", $kk->materials_summary);

                            foreach ($exploded_materials as $kmat) {
                                $this_material[] =  $kmat;
                            }
                        }
                    }

                    //cpunt duplicates
                    $all_material = array_filter(array_count_values($this_material), function ($v) {
                        return $v > 0;
                    });




                    // finalizing data
                    if (isset($materials_summary)) {
                        $materials_summary = [];
                    }

                    foreach ($all_material as $key => $value) {
                        $complete_material_data[] = (object) array(
                            'name' => $key,
                            'count' => $value,
                        );
                    }

                    array_push($this_day_summary, $complete_material_data);
                } else {
                    array_push($this_day_summary, array());
                }
            } else {
                array_push($this_day_summary, array());
            }

            ############################# ^^ FOR MATERIALS DAILY USAGE ^^  #############################


            ############################# ^^ FOR MOST USED MATERIAL^^  #############################
            if (isset($request->material_top_selected)) { // MATERIAL  TOP SELECTED

                $this_clinic_materials_top = Clinic_equipments::where("user_as_clinic_id", $clinic->id)->get();

                foreach ($this_clinic_materials_top as $key) {
                    $material_name_top[] = $key->name;
                }

                $all_done_top = Billings::where("user_as_clinic_id", $clinic->id)
                    ->where('created_at', 'LIKE', '%' . $date_key . '%')
                    ->get();

                if (count($all_done_top) > 0) {

                    foreach ($all_done_top as $kk) {
                        if (isset($kk->materials_summary)) {
                            $exploded_materials = explode(",", $kk->materials_summary);

                            foreach ($exploded_materials as $kmat) {
                                $this_material_top[] =  $kmat;
                            }
                        }
                    }
                }
            }
            ############################# ^^ FOR MOST USED MATERIAL^^  #############################


            #############################  FOR DAILY AVAILED SERVICES & PACKAGES   #############################

            if (isset($request->ServicePackage_availed_per_day)) { // AVAILED SERVICES & PACCKAGES PER DAY ISSET
                $availed_name = [];

                // $this_clinic_services = Clinic_services::where("user_as_clinic_id", $clinic->id)->get();
                // $this_clinic_packages = Packages::where("user_as_clinic_id", $clinic->id)->get();

                // foreach ($this_clinic_services as $key) {
                //     $availed_name[] = $key->name;
                // }

                // foreach ($this_clinic_packages as $key) {
                //     $availed_name[] = $key->name;
                // }

                $all_done = Billings::where("user_as_clinic_id", $clinic->id)
                    ->where('created_at', 'LIKE', '%' . $date_key . '%')
                    ->get();

                if (count($all_done) > 0) {
                    $complete_availed_data = [];

                    $treatment = [];

                    foreach ($all_done as $key) {


                        $first_explode = explode(",", $key->price_summary);
                        foreach ($first_explode as $k) {
                            $sec_explode = explode(":", $k);

                            array_push($treatment, $sec_explode[0]);
                        }

                        //cpunt duplicates
                        $all_availed = array_filter(array_count_values($treatment), function ($v) {
                            return $v > 0;
                        });
                    }

                    foreach ($all_availed as $key => $value) {
                        $complete_availed_data[] = (object) array(
                            'name' => $key,
                            'count' => $value,
                        );
                    }

                    array_push($this_day_summary, $complete_availed_data);
                } else {
                    array_push($this_day_summary, array());
                }
            } else {
                array_push($this_day_summary, array());
            }

            ############################# ^^ FOR DAILY AVAILED SERVICES & PACKAGES ^^  #############################



            // PUSH EVERY DATA
            array_push($daily_report, $this_day_summary);
        }


        if (isset($request->material_top_selected)) { //REFERENCE NG DATA NITO SA TAAS |seratch for| if (isset($request->material_top_selected)) { // MATERIAL  TOP SELECTED


            //count duplicates
            if (isset($this_material_top)) {
                $all_material_top = array_filter(array_count_values($this_material_top), function ($v) {
                    return $v > 0;
                });

                foreach ($all_material_top as $key => $value) {
                    $complete_material_data_top[] = (object) array(
                        'name' => $key,
                        'count' => $value,
                    );
                }
            }
        }

        // echo json_encode($complete_material_data_top ?? []);


        #############################  FOR MATERIALS LIST DO NOT NEED DATE AT ALL   #############################
        if (isset($request->material_list)) { // MATERIAL LIST ISSET
            // echo "material list";

            $this_materials = Clinic_equipments::where("user_as_clinic_id", $clinic->id)->get();

            // echo json_encode($this_materials);

            $complete_consumable_data = [];
            $complete_medicine_data = [];
            $complete_equipment_data = [];

            foreach ($this_materials as $key) {
                if ($key->type == "consumable") {
                    $this_consumable = Clinic_equipment_inventory::where("clinic_equipments_id", $key->id)
                        ->where("quantity", ">", 0)
                        ->get();

                    foreach ($this_consumable as $k) {
                        $complete_consumable_data[] = (object) array(
                            "name" => $key->name,
                            "quantity" => $k->quantity . " " . $key->unit,
                            "supplier" => $k->supplier,
                            "acquired" => $k->acquired,
                            "expiration" => $k->expiration,

                        );
                    }
                }

                if ($key->type == "medicine") {
                    $this_medicine = Clinic_equipment_inventory::where("clinic_equipments_id", $key->id)
                        ->where("quantity", ">", 0)
                        ->get();

                    foreach ($this_medicine as $k) {
                        $complete_medicine_data[] = (object) array(
                            "name" => $key->name,
                            "quantity" => $k->quantity . " " . $key->unit,
                            "supplier" => $k->supplier,
                            "acquired" => $k->acquired,
                            "expiration" => $k->expiration,

                        );
                    }
                }

                if ($key->type == "equipment") {
                    $this_equipment = Clinic_equipment_inventory::where("clinic_equipments_id", $key->id)
                        ->where("quantity", ">", 0)
                        ->get();

                    foreach ($this_equipment as $k) {
                        $complete_equipment_data[] = (object) array(
                            "name" => $key->name,
                            "quantity" => $k->quantity . " " . $key->unit,
                            "supplier" => $k->supplier,
                            "acquired" => $k->acquired,
                            "expiration" => $k->expiration,

                        );
                    }
                }
            }
        }

        ############################# ^^ FOR MATERIALS LIST DO NOT NEED DATE AT ALL^^  #############################


        #############################  FOR SERVICE & PACKAGE LIST DO NOT NEED DATE AT ALL   #############################
        if (isset($request->ServicePackage_list)) { // SERVICE & PACKAGE LIST ISSET
            // echo "material list";

            $this_services = Clinic_services::where("user_as_clinic_id", $clinic->id)->get();
            $this_packages = Packages::where("user_as_clinic_id", $clinic->id)->get();

            $complete_services_data = [];
            $complete_packages_data = [];


            foreach ($this_services as $key) {
                $complete_services_data[] = (object) array(
                    "name" => $key->name,
                    "description" =>  $key->description,
                    "min" => $key->min_price,
                    "max" => $key->max_price,

                );
            }

            foreach ($this_packages as $key) {
                $complete_packages_data[] = (object) array(
                    "name" => $key->name,
                    "description" =>  $key->description,
                    "min" => $key->min_price,
                    "max" => $key->max_price,

                );
            }
        }

        ############################# ^^ FOR SERVICE & PACKAGE LIST DO NOT NEED DATE AT ALL^^  #############################



        // dd($daily_report);

        // echo count($daily_report[0][0]);

        // echo json_encode($dates);


        return view('clinicViews.print.overall_generated_report', [
            'clinic' => $clinic,
            'selected_date' => $dates,
            'two_dates' => $date_range,
            'clinic_address' => $clinic_address,
            'daily_report' => $daily_report,

            'complete_consumable_data' => $complete_consumable_data ?? [],
            'complete_medicine_data' => $complete_medicine_data ?? [],
            'complete_equipment_data' => $complete_equipment_data ?? [],

            'material_top_selected' => $complete_material_data_top ?? [],


            'complete_services_data' => $complete_services_data ?? [],
            'complete_packages_data' => $complete_packages_data ?? [],
        ]);






        // if (isset($request->app_done)) {
        //     echo json_encode($request->all());
        // }
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
