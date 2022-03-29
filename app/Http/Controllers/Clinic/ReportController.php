<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Billings;
use App\Models\Clinic_services;
use App\Models\Receipt_orders;
use App\Models\User;
use App\Models\User_as_clinic;
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

        //ILL USED THIS FUNCTION TO RETURN JSON FOR MY STATISTICS
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

                $services_name_array[] = $this_summary_2nd[0];
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


        return response()->json([
            'services_stats' =>  $services_stats,
            'services_count' => count($ro),
            'tester' => "pasok",
        ]);

        //================== Top Service ============================//
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
