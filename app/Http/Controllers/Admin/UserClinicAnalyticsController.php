<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\Appointments;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserClinicAnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminViews.analytics');
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
        // $user = User::all();

        // $data = User::select(DB::raw('MONTH(created_at) month'), DB::raw('count(*) as total'))
        //     ->groupBy('created_at')
        //     ->orderBy('created_at', 'asc')
        //     ->get();



        // $data = User::select(FacadesDB::raw('count(id) as `total`'), FacadesDB::raw('MONTH(created_at) month'))
        //     ->groupby('month')
        //     ->orderBy('created_at', 'asc')
        //     ->get();


        $data = User::all();

        foreach ($data as $key) {
            // $dates[] = date("F", mktime(0, 0, 0, $key->created_at, 10));

            $dates[] = date("F", strtotime($key->created_at));
        }



        //cpunt duplicates
        if (isset($dates)) {
            $counted_month = array_filter(array_count_values($dates), function ($v) {
                return $v > 0;
            });
        }



        foreach ($counted_month as $k => $v) {
            $formatted_data[] = array(
                'total' => $v,
                'month' => $k,
            );
        }








        // $dataClinic = User::where('role', '=', 'clinic')
        //     ->select(FacadesDB::raw('count(id) as `total`'), FacadesDB::raw('MONTH(created_at) month'))
        //     ->groupby('month')
        //     ->orderBy('created_at', 'asc')
        //     ->get();

        // foreach ($dataClinic as $item) {
        //     $formatted_data_clinic[] = array(
        //         'total' => $item->total,
        //         'month' => date("F", mktime(0, 0, 0, $item->month, 10)),
        //     );
        // }

        $dataClinic = User::where('role', '=', 'clinic')->where('status', '=', 'verified')->get();

        foreach ($dataClinic as $key) {
            // $dates[] = date("F", mktime(0, 0, 0, $key->created_at, 10));

            $dates_clinics[] = date("F", strtotime($key->created_at));
        }



        //cpunt duplicates
        if (isset($dates_clinics)) {
            $counted_month_clinic = array_filter(array_count_values($dates_clinics), function ($v) {
                return $v > 0;
            });
        }



        foreach ($counted_month_clinic as $k => $v) {
            $formatted_data_clinic[] = array(
                'total' => $v,
                'month' => $k,
            );
        }






        // $dataCustomer = User::where('role', '=', 'customer')
        //     ->select(FacadesDB::raw('count(id) as `total`'), FacadesDB::raw('MONTH(created_at) month'))
        //     ->groupby('month')
        //     ->orderBy('created_at', 'asc')
        //     ->get();

        // foreach ($dataCustomer as $item) {
        //     $formatted_data_customer[] = array(
        //         'total' => $item->total,
        //         'month' => date("F", mktime(0, 0, 0, $item->month, 10)),
        //     );
        // }

        $dataCustomer = User::where('role', '=', 'customer')->get();

        foreach ($dataCustomer as $key) {
            // $dates[] = date("F", mktime(0, 0, 0, $key->created_at, 10));

            $dates_customer[] = date("F", strtotime($key->created_at));
        }



        //cpunt duplicates
        if (isset($dates_customer)) {
            $counted_month_customer = array_filter(array_count_values($dates_customer), function ($v) {
                return $v > 0;
            });
        }



        foreach ($counted_month_customer as $k => $v) {
            $formatted_data_customer[] = array(
                'total' => $v,
                'month' => $k,
            );
        }









        $appPerMonth = Appointments::where('appointment_status_id', '=', 1)->get();
        $months = [];
        $months_filtered = "";
        foreach ($appPerMonth as $item) {
            $date = date('M', strtotime($item->created_at));
            array_push($months, $date);
        }

        $appMonth = array_filter(array_count_values($months), function ($v) {

            return $v > 0;
        });







        if (!isset($formatted_data)) {
            $formatted_data = [];
        }
        if (!isset($formatted_data_clinic)) {
            $formatted_data_clinic = [];
        }
        if (!isset($formatted_data_customer)) {
            $formatted_data_customer = [];
        }
        if (!isset($appMonth)) {
            $appMonth = [];
        }

        return response()->json([
            'data' => $formatted_data,
            'clinic' => $formatted_data_clinic,
            'customer' => $formatted_data_customer,
            'appointment' => $appMonth,

            'tester2' => $formatted_data_customer,
        ]);
        // return response()->json(['data' => $formatted_data, 'clinic' => $formatted_data_clinic, 'customer' => $formatted_data_customer]);
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
