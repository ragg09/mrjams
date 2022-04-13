<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\Billings;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\Receipt_orders;
use App\Models\Appointments;
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;

class PatientDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('role','=',"clinic")->get();
        $patient = User_as_customer::all();

        // if ($patient == 0) {
        //     return view('adminViews.tablesPatient', ['patient' => 0]);
        // } else {
        //     return view('adminViews.tablesPatient', ['patient' => $patient]);
        // }

        return view('adminViews.tablesPatient', ['patient' => $patient]);

        // return view('adminViews.tables');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // para makuha yung id
        $customer = User_as_customer::where('id', '=', $request->id)->first();

        // echo($customer);
        // echo($patientAvg);
        // $all = Receipt_orders::all();

        // para makuha sa receipt yung may same id, receipt ng pumunta sa kanya 
        $receipt = Receipt_orders::where('user_as_customer_id', '=', $customer->id)->get();

        // 
        $count = 0;
        foreach ($receipt as $key) {
            $thisApp = Appointments::where('receipt_orders_id', '=', $key->id)
                ->where('appointment_status_id', '=', 1)
                ->first(['receipt_orders_id', 'created_at']);
            if ($thisApp) {
                $appointments[] = $thisApp;
            }
        }

        $status = 0;
        $months = [];
        foreach ($appointments as $item) {
            $date = date('M', strtotime($item->created_at));
            array_push($months, $date);
        }

        $appMonth = array_filter(array_count_values($months), function ($v) {

            return $v > 0;
        });


        // echo($formatted_data_patient);
        // return response()->json(['formatted_data_patient'=>$formatted_data_patient]);
        return response()->json(['appointments' => $appointments, 'appMonth' => $appMonth]);
        // return response()->json(['receipt'=>$receipt]);
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
        if (strpos($id,  "@")) {
            //get all appointments
            $getUserCustomer = User_as_customer::where('id', '=', $id)->first();
            $appReceipt = Receipt_orders::where('user_as_customer_id', '=', $getUserCustomer->id)->count();

            //rating
            $getUserCus = User_as_customer::where('id', '=', $id)->first();
            $getUser = User::where('id', '=', $getUserCus->users_id)->first();
            $avgRatingApp = Ratings::where('users_id_ratee', '=', 1)->where('users_id_rater', '=', $getUser->id)->avg('rating');

            //get data
            $patient = User_as_customer::findOrFail($id);

            $patientAdd = User_address::where('id','=', $patient->user_address_id)->first();

            return response()->json(['patients' => $patient,'patientAdd' => $patientAdd, 'avgRatingApps' => $avgRatingApp, 'appReceipt' => $appReceipt]);
        } else {
            //get all appointments
            $getUserCustomer = User_as_customer::where('id', '=', $id)->first();
            $appReceipt = Receipt_orders::where('user_as_customer_id', '=', $getUserCustomer->id)->count();

            //rating
            $getUserCus = User_as_customer::where('id', '=', $id)->first();
            $getUser = User::where('id', '=', $getUserCus->users_id)->first();
            $avgRatingApp = Ratings::where('users_id_ratee', '=', 1)->where('users_id_rater', '=', $getUser->id)->avg('rating');

            //get data
            $patient = User_as_customer::findOrFail($id);

            $patientAdd = User_address::where('id','=', $patient->user_address_id)->first();

            return view('adminViews.layouts.user.userView', ['patient' => $patient,'patientAdd' => $patientAdd, 'avgRatingApps' => $avgRatingApp, 'appReceipt' => $appReceipt]);
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
        //echo($id);
        $patient = User_as_customer::findOrFail($id);
        return view('adminViews.layouts.user.userUpdate', ['patient' => $patient]);
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
        // echo json_encode($request->userGender);
        $patient = User_as_customer::findOrFail($id);
        $patient->fname = $request->input('userName');
        $patient->mname = $request->input('mname');
        $patient->lname = $request->input('lname');
        $patient->gender = $request->userGender;
        $patient->phone = $request->input('phone');
        $patient->age = $request->input('age');
        $patient->update();
        return response()->json(['patient' => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$id = id ng user as customer? dba? oo pre

        $bill = Billings::where('user_as_customer_id', '=', $id)->get();

        if (count($bill) > 0) {
            foreach ($bill as $key) {
                $this_bill = Billings::findOrFail($key->id);
                $this_bill->delete();
            }
        }

        $ro = Receipt_orders::where('user_as_customer_id', '=', $id)->get();

        if (count($ro) > 0) {
            foreach ($ro as $key) {
                $this_appointment = Appointments::where('receipt_orders_id', '=', $key->id)->first();
                $this_appointment->delete();

                $this_ro = Receipt_orders::findOrFail($key->id);
                $this_ro->delete();
            }
        }


        $patient = User_as_customer::findOrFail($id);
        $patient->delete();

        $address = User_address::findOrFail($patient->user_address_id);
        $address->delete();

        $root = User::findOrFail($patient->users_id);
        $root->delete();




        // $patient = User_as_customer::findOrFail($id);
        // $patient->delete();

        // message: "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`mrjams_system`.`appointments`, CONSTRAINT `fk_appointments_receipt_orders1` FOREIGN KEY (`receipt_orders_id`) REFERENCES `receipt_orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) (SQL: delete from `receipt_orders` where `id` = 1)"






        return response()->json([
            'test' => $ro ?? "shit",
        ]);
    }
}
