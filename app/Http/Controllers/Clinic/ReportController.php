<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\User;
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


        return view('clinicViews.report.index', [
            'total_paid' => $total_paid,
            'total_balance' => $total_balance,
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

        $service_stats_summary = array_filter(array_count_values($services_name_array), function ($v) {
            return $v > 0;
        });

        foreach ($service_stats_summary as $key => $value) {
            $services_stats[] = (object) array(
                'name' => $key,
                'count' => $value,
            );
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

                if (in_array($this_summary_2nd[0], $packages_array)) {
                    $packages_name_array[] = $this_summary_2nd[0];
                }
            }
        }

        $package_stats_summary = array_filter(array_count_values($packages_name_array), function ($v) {
            return $v > 0;
        });

        foreach ($package_stats_summary as $key => $value) {
            $packages_stats[] = (object) array(
                'name' => $key,
                'count' => $value,
            );
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


        foreach ($done_ro_ids as $key) {
            $this_billing = Billings::where("receipt_orders_id", $key)->first();

            $exploded_materials = explode(",", $this_billing->materials_summary);

            foreach ($exploded_materials as $k) {
                if ($k != "") {
                    $materials_array[] = $k;
                }
            }
        }

        //filtering verified consumables
        foreach ($materials_array as $key) {
            if (in_array($key, $consumables)) {
                $verified_consumables[] = $key;
            }
        }

        //cpunt duplicates
        $consumable_stats_summary = array_filter(array_count_values($verified_consumables), function ($v) {
            return $v > 0;
        });

        //finalizing data
        foreach ($consumable_stats_summary as $key => $value) {
            $materials_stats[] = (object) array(
                'name' => $key,
                'count' => $value,
            );
        }



        //================== Top Consumed Materials ============================//


        return response()->json([
            //Appointments
            'appointment_stats' => array_slice($appointment_stats, -30), //making sure that 1 month will fit the graph

            //Services
            'services_stats' =>  $services_stats,
            'services_count' => count($ro),

            //Packages
            'packages_stats' =>  $packages_stats,

            //Equipments/Materials
            'materials_stats' => $materials_stats,

            'tester' =>   "tester",
        ]);
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
