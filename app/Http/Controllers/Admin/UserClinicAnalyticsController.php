<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
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
        // $user = User::all();
        // return view('adminViews.analytics' , ['user'=>$user]);
        return view('adminViews.analytics');

        // //ALL USERS
        // $current_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        // $before_1_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        // $before_2_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        // $before_3_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        // $before_4_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        // $before_5_month_user = User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(5))->count();
        // $usersCount = array($current_month_user,$before_1_month_user,$before_2_month_user,$before_3_month_user,$before_4_month_user,$before_5_month_user);

        // //CLINIC
        // $current_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        // $before_1_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        // $before_2_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        // $before_3_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        // $before_4_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        // $before_5_month_clinic = User::where('role','=','clinic')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(5))->count();
        // $clinicsCount = array($current_month_clinic,$before_1_month_clinic,$before_2_month_clinic,$before_3_month_clinic,$before_4_month_clinic,$before_5_month_clinic);

        // //CUSTOMER
        // $current_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        // $before_1_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        // $before_2_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
        // $before_3_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->count();
        // $before_4_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->count();
        // $before_5_month_customer = User::where('role','=','customer')->whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(5))->count();
        // $customersCount = array($current_month_customer,$before_1_month_customer,$before_2_month_customer,$before_3_month_customer,$before_4_month_customer,$before_5_month_customer);

        // return view('adminViews.analytics')->with(compact('usersCount','clinicsCount','customersCount'));
        // return $user;
        // dd($user);
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

        return response()->json(['data' => $formatted_data, 'clinic' => $formatted_data_clinic, 'customer' => $formatted_data_customer]);
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
