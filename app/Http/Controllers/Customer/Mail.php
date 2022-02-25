<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use App\Models\Receipt_orders;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\User_address;
use App\Models\Clinic_services;
use App\Models\Packages;
use App\Models\Appointment_status;

class Mail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // $appointments = Appointments::all();
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $user_id = $customer->id;
      
        $all_receipts = Receipt_orders::where('user_as_customer_id', '=',  $user_id)
        ->get();

    foreach ($all_receipts as $key) {
        $all_appointments[] = Appointments::where('id', '=',  $key->id)
            ->get();

        $all_clinics[] = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)
            ->get();
    }

    $count = 0;
    foreach ($all_receipts as $key) {
        $all[] = [
            "created_at" => $all_appointments[$count][0]->created_at, //galing sa appointment table
            "appointed_at" => $all_appointments[$count][0]->appointed_at,
            "name" => $all_clinics[$count][0]->name //galing sa clinic table
        ];
        $count++;
    }

    // echo (json_encode($all));
    //  return view('customerViews.mail.mail',['all'=>$all]);
     return view('customerViews.mail.mail',['all_appointments'=>$all_appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // $appointment = $request->receipt_orders_id;
       
        // $receipt_data = Receipt_orders::where('id','=', $appointment_data->receipt_orders_id)->first();
        // echo($receipt_data);

        if($id == 0){
            $user = User::where('email', '=',  Auth::user()->email)->first();
                $customer = User_as_customer::where('users_id', '=', $user->id)->first();

                $user_id = $customer->id;
            
                $all_receipts = Receipt_orders::where('user_as_customer_id', '=',  $user_id)
                ->get();

            // foreach ($all_receipts as $key) {
            //     // $all_appointments[] = Appointments::where('id', '=',  $key->id)->get();
            //     // $all_appointments[] = Appointments::where('id', '=',  $key->id)->whereNotIn('appointment_status_id', [7])->get();
            //     $all_appointments[] = Appointments::where('id', '=',  $key->id)->where('appointment_status_id', '!=', 7)->get();
            //     $all_clinics[] = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)->get();
            // }

            $count = 0;
            foreach ($all_receipts as $key) {
                    $all_appointments = Appointments::where('receipt_orders_id', '=',  $key->id)->where('appointment_status_id', '!=', 7)->first();
                    $all_clinics = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)->first();
               
                    if($all_appointments){
                        $all[] = [
                            "created_at" =>  $all_appointments->created_at, //galing sa appointment table
                            "appointed_at" => $all_appointments->appointed_at,
                            "status" =>  $all_appointments->appointment_status_id,
                            "name" => $all_clinics->name, //galing sa clinic table
                            "id" =>  $all_appointments->id 
                        ];  
                        $count++;
                    }
              
            }

            return response()->json(['all'=>$all]);

        }else if(strpos($id, "status")){
            $astatus = explode(" ", $id);
            $user = User::where('email', '=',  Auth::user()->email)->first();
            $customer = User_as_customer::where('users_id', '=', $user->id)->first();

            $receipt = Receipt_orders::where('user_as_customer_id', '=', $customer->id)->get();

            $count = 0;
            foreach($receipt as $key){
                    $all_appointments = Appointments::where('receipt_orders_id', '=',  $key->id)->where('appointment_status_id', '=', $astatus[0])->first();
                    $all_clinics = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)->first();

                    
                    if($all_appointments){
                        $all[] = [
                            "created_at" =>  $all_appointments->created_at, //galing sa appointment table
                            "appointed_at" => $all_appointments->appointed_at,
                            "status" =>  $all_appointments->appointment_status_id,
                            "name" => $all_clinics->name, //galing sa clinic table
                            "id" =>  $all_appointments->id 
                        ];  
                        $count++;
                    }
            }
        
            return response()->json(['all'=>$all]);

        }else{


            $appointment_data = Appointments::where('id', '=', $id)->first();
            
            $receipt_info = Receipt_orders::where('id', '=', $appointment_data->receipt_orders_id)->first();
            $clinic_info = User_as_clinic::where('id', '=', $receipt_info->user_as_clinic_id)->first();
            $clinic_address = User_address::where('id', '=', $clinic_info->user_address_id)->first();

            $service = Clinic_services::where('id','=', $receipt_info->clinic_services_id)->first();
            $package = Packages::where('id', '=', $receipt_info->packages_id)->first();

            $status = Appointment_status::where('id', '=', $appointment_data->appointment_status_id)->first();

            return view('customerViews.mail.mail_info', ['appointment_data'=>$appointment_data, 'clinic_info'=>$clinic_info, 'clinic_address'=>$clinic_address, 'service'=>$service, 'package'=>$package, 'status' => $status]);
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
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointments::find($id);

        $appointment->appointment_status_id = 7;
        $appointment->save();

        return response()->json(['all'=>$appointment, 'status'=> 'OK']);
    }
}
