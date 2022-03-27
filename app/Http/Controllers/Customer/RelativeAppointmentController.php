<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\Packages;
use App\Models\Clinic_services;
use App\Models\Receipt_orders;
use App\Models\Appointments;
use App\Models\Clinic_time_availability;


class RelativeAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customerViews.appointment.appointment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where('email', '=',  Auth::user()->email)->first();
        // $customer = User_as_customer::where('users_id', '=', $user->id)->get();
       
        // $customer_add = User_address::where('id', '=', $customer[0]->user_address_id)->get();
        // $service = Clinic_services::all();
        // $package = Packages::all();
       
        //  return view('customerViews.appointment.relativeAppointment',['customer'=>$customer, 'customer_add'=>$customer_add,'package'=>$package, 'service'=>$service]);
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
    public function show($id)
    {
        $clinic_id = $id;
        $availability_data = Clinic_time_availability::where('user_as_clinic_id', '=', $clinic_id)->first();

        $split_data = explode("&", $availability_data->summary);
        $count = 0;
        foreach ($split_data as $key) {
            $this_data = explode("*", $key);
            $count++;
            $availability[] = (object) array(
                "day" => $this_data[0],
                "min" => $this_data[1],
                "max" =>  $this_data[2],
                "status" =>  $this_data[3],
            );
        }

        return response()->json(['avail'=>$availability]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Making Appointment (Relative or Friends)

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();
        $clinic_id = $id;
        $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
        $service = Clinic_services::where('user_as_clinic_id', '=', $id)->get();
        $package = Packages::where('user_as_clinic_id', '=', $id)->get();
    //    echo($clinic_id);
        return view('customerViews.appointment.relativeAppointment',['customer'=>$customer, 'customer_add'=>$customer_add,'package'=>$package, 'service'=>$service, 'clinic_id'=>$clinic_id]);
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
