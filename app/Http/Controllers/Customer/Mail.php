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
use App\Models\Receipt_orders_has_clinic_services;

class Mail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //      // $appointments = Appointments::all();
    //     $user = User::where('email', '=',  Auth::user()->email)->first();
    //     $customer = User_as_customer::where('users_id', '=', $user->id)->first();

    //     $user_id = $customer->id;
      
    //     $all_receipts = Receipt_orders::where('user_as_customer_id', '=',  $user_id)
    //     ->get();

    // foreach ($all_receipts as $key) {
    //     $all_appointments[] = Appointments::where('id', '=',  $key->id)
    //         ->get();

    //     $all_clinics[] = User_as_clinic::where('id', '=',  $key->user_as_clinic_id)
    //         ->get();
    // }

    // $count = 0;
    // foreach ($all_receipts as $key) {
    //     $all[] = [
    //         "created_at" => $all_appointments[$count][0]->created_at, //galing sa appointment table
    //         "appointed_at" => $all_appointments[$count][0]->appointed_at,
    //         "name" => $all_clinics[$count][0]->name //galing sa clinic table
    //     ];
    //     $count++;
    // }

    // // echo (json_encode($all));
    // //  return view('customerViews.mail.mail',['all'=>$all]);
     return view('customerViews.mail.mail');
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

        if($id == 0){
            $user = User::where('email', '=',  Auth::user()->email)->first();
                $customer = User_as_customer::where('users_id', '=', $user->id)->first();

                $user_id = $customer->id;
            
                $all_receipts = Receipt_orders::where('user_as_customer_id', '=',  $user_id)
                ->get();

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

          if($count > 0){
            return response()->json(['all'=>$all]);
          }else{

            // $user = User::where('email', '=',  Auth::user()->email)->first();
            // $customer = User_as_customer::where('users_id', '=', $user->id)->first();

            return response()->json(['status'=> 0]);
          }

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
        
            // return response()->json(['all'=>$all]);

            if($count > 0){
                return response()->json(['all'=>$all]);
              }else{
                return response()->json(['status'=> 0]);
              }

        }else{


            $appointment_data = Appointments::where('id', '=', $id)->first();
            
            $receipt_info = Receipt_orders::where('id', '=', $appointment_data->receipt_orders_id)->first();
            $clinic_info = User_as_clinic::where('id', '=', $receipt_info->user_as_clinic_id)->first();
            $clinic_address = User_address::where('id', '=', $clinic_info->user_address_id)->first();

            $receiptService = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $receipt_info->id)->first();
            $service = Clinic_services::where('id','=', $receiptService->clinic_services_id)->first();

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
        if($id == 0){
            $user = User::where('email', '=',  Auth::user()->email)->first();
        // $clinic = User_as_clinic::where('users_id', '=', $user->id)->first();
        
            if ($request->ajax()) {
                // $info = "hello";
                $query = $request->get('query');
                $data = User_as_clinic::query()->where('name', 'LIKE', "%{$query}%")->get();

                $count = 0;
                if(count($data) > 0){
                    foreach($data as $key){
                        // $address = User_address::where('id', '=', $key->user_address_id)->first();
                        // $type = Clinic_types::where('id', '=', $key->clinic_types_id)->first();
                        // $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
                        // $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();

                        $receipt = Receipt_orders::where('user_as_clinic_id', '=', $key->id)->first();
                        $appointment = Appointments::where('receipt_orders_id', '=', $receipt->id)->first();

                        $ClinicAppoint[] = (object) array(
                            "id" => $key->id, 
                            "name" => $data[$count]->name,
                            "created_at" => $appointment->created_at,
                            "appointed_at" => $appointment->appointed_at
                        );
                        $count++;
                    
                    }
                    return  response()->json(['ClinicAppoint' => $ClinicAppoint, 'status' => 1]);
                }
                

            }

        }else{

        }
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
