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
use App\Models\Logs;
use App\Models\Customer_logs;



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
        $clinic_data = User_as_clinic::where('id', '=', $clinic_id)->first();
        $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
        $service = Clinic_services::where('user_as_clinic_id', '=', $id)->get();
        $package = Packages::where('user_as_clinic_id', '=', $id)->get();
    //    echo($clinic_id);
        return view('customerViews.appointment.relativeAppointment',['clinic_data' => $clinic_data,'customer'=>$customer, 'customer_add'=>$customer_add,'package'=>$package, 'service'=>$service, 'clinic_id'=>$clinic_id]);
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
        //Cancel Appointment
        $appointment = Appointments::find($id);
        $appointment->appointment_status_id = 8;
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
        $logs->message = $customer->fname . ' ' . $customer->lname . " cancelled the appointment day and time.";
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
          $c_log->message = "You cancelled an appointment from " . $clinic_name->name;
          $c_log->remark = "notif";
          $c_log->date =  date("m/d/Y");
          $c_log->time = date("h:i a");
          $c_log->user_as_customer_id = $customer->id;
          $c_log->save();
 

        return response()->json(['all' => $appointment, 'status' => 'OK']);
    }
}
