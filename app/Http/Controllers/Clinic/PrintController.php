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
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Printing Title";
        return view('clinicViews.print.receipt', compact(['title']));
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_address = User_address::where('id', '=',  $clinic->user_address_id)->first();

        if (strpos($id, "receipt")) {
            $getid = explode("_", $id);

            $ro = Receipt_orders::where('id', '=',  $getid[0])->first();

            $customer = User_as_customer::where('id', '=',  $ro->user_as_customer_id)->first();
            $customer_root = User::where('id', '=',  $customer->users_id)->first();

            $appointment = Appointments::where('receipt_orders_id', '=',  $ro->id)->first();

            $bill = Billings::where('receipt_orders_id', '=',  $ro->id)->first();

            $service = explode(",", $bill->price_summary);

            foreach ($service as $key) {
                $this_data = explode(":", $key);

                $service_summary[] = (object) array(
                    'name' => $this_data[0],
                    'amount' => $this_data[1],
                );
            }

            // echo json_encode($service_summary);

            return view(
                'clinicViews.print.receipt',
                compact([
                    'clinic',
                    'user',
                    'clinic_address',
                    'ro',
                    'customer',
                    'customer_root',
                    'appointment',
                    'bill',
                    'service_summary'
                ])
            );
        }

        if (strpos($id, "summary")) {
            //accounting vv
            $total_paid = Billings::where('user_as_clinic_id', $clinic->id)->sum('total_paid');
            $total_balance = Billings::where('user_as_clinic_id', $clinic->id)->sum('balance');
            $total_raw = $total_paid + $total_balance;

            //appointment vv
            $ro = Receipt_orders::where('user_as_clinic_id', $clinic->id)->get();
            foreach ($ro as $key) {
                $ro_ids[] = $key->id;
            }

            $accepted = 0;
            $declined = 0;
            $done = 0;
            $expired = 0;
            $peding = 0;
            $total_appointments = 0;
            foreach ($ro as $key) {
                $this_app = Appointments::where("receipt_orders_id", $key->id)->first();
                $total_appointments++;

                //Accepted + Negotiation
                if ($this_app->appointment_status_id == 4 || $this_app->appointment_status_id == 5) {
                    $accepted++;
                }

                //declined
                if ($this_app->appointment_status_id == 3) {
                    $declined++;
                }

                //done
                if ($this_app->appointment_status_id == 1) {
                    $done++;
                }

                //expired
                if ($this_app->appointment_status_id == 6) {
                    $expired++;
                }

                //peding
                if ($this_app->appointment_status_id == 6) {
                    $peding++;
                }
            }

            //Top Service vv
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
                $top_services[] = (object) array(
                    'name' => $key,
                    'count' => $value,
                );
            }


            usort($top_services, function ($a, $b) {
                return  $b->count <=> $a->count;
            });



            //Top Packages vv
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
                $top_packages[] = (object) array(
                    'name' => $key,
                    'count' => $value,
                );
            }

            usort($top_packages, function ($a, $b) {
                return  $b->count <=> $a->count;
            });



            //Top Consumable Materials VV
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
                $top_consumable[] = (object) array(
                    'name' => $key,
                    'count' => $value,
                );
            }

            usort($top_consumable, function ($a, $b) {
                return  $b->count <=> $a->count;
            });

            //echo  json_encode($top_consumable);

            return view(
                'clinicViews.print.report_summary',
                compact([
                    'clinic',
                    'user',
                    'clinic_address',

                    //acounting
                    'total_paid',
                    'total_balance',
                    'total_raw',

                    //appointment
                    'accepted',
                    'declined',
                    'done',
                    'expired',
                    'peding',
                    'total_appointments',

                    //top services
                    'top_services',

                    //top packages
                    'top_packages',

                    //top consumable
                    'top_consumable',

                ])
            );
        }

        if (strpos($id, "inventory")) {
            $getid = explode("_", $id);

            $all_materials = Clinic_equipments::where("user_as_clinic_id", $clinic->id)
                ->orderBy('type')
                ->get();

            $all_consumable = Clinic_equipments::where("user_as_clinic_id", $clinic->id)
                ->where("type", "consumable")
                ->get();

            $all_equipment = Clinic_equipments::where("user_as_clinic_id", $clinic->id)
                ->where("type", "equipment")
                ->get();

            $all_medicine = Clinic_equipments::where("user_as_clinic_id", $clinic->id)
                ->where("type", "medicine")
                ->get();

            //echo json_encode($all_medicine);

            return view(
                'clinicViews.print.inventory',
                compact([
                    'clinic',
                    'user',
                    'clinic_address',
                    'all_consumable',
                    'all_equipment',
                    'all_medicine',
                ])
            );
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
        //
    }
}
