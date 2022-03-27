<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\Appointments;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $data = User::select(DB::raw('count(id) as `total`'), DB::raw('MONTH(created_at) month'))
            ->groupby('month')
            ->orderBy('created_at', 'asc')
            ->get();
        // $data = User::all();

        foreach ($data as $item) {
            $formatted_data[] = array(
                'total' => $item->total,
                'month' => date("F", mktime(0, 0, 0, $item->month, 10)),
            );
        }

        $dataClinic = User::where('role', '=', 'clinic')
            ->select(DB::raw('count(id) as `total`'), DB::raw('MONTH(created_at) month'))
            ->groupby('month')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($dataClinic as $item) {
            $formatted_data_clinic[] = array(
                'total' => $item->total,
                'month' => date("F", mktime(0, 0, 0, $item->month, 10)),
            );
        }

        $dataCustomer = User::where('role', '=', 'customer')
            ->select(DB::raw('count(id) as `total`'), DB::raw('MONTH(created_at) month'))
            ->groupby('month')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($dataCustomer as $item) {
            $formatted_data_customer[] = array(
                'total' => $item->total,
                'month' => date("F", mktime(0, 0, 0, $item->month, 10)),
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


        return response()->json(['data' => $formatted_data, 'clinic' => $formatted_data_clinic, 'customer' => $formatted_data_customer, 'appointment' => $appMonth]);
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
