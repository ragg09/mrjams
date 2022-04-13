<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
