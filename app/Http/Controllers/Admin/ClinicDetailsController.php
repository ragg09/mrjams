<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\Receipt_orders;
use App\Models\Appointments;
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;

class ClinicDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('role','=',"clinic")->get();
        $user = User_as_clinic::all();
        // $userCustomer = User_as_customer::all();
        // return view('adminViews.tables' , ['user'=>$user, 'customer'=>$userCustomer]);
        return view('adminViews.tablesClinic', ['clinic' => $user]);

        // return view('adminViews.tables');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->forClinicType) {
            # code...
        } else {
            // para makuha yung id
            $clinic = User_as_clinic::where('id', '=', $request->id)->first();

            // para makuha sa receipt yung may same id, receipt ng pumunta sa kanya 
            $receipt = Receipt_orders::where('user_as_clinic_id', '=', $clinic->id)->get();

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

            return response()->json(['appointments' => $appointments, 'appMonth' => $appMonth]);
            // return response()->json(['receipt'=>$receipt]);
        }
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
            $getUserClinic = User_as_clinic::where('id', '=', $id)->first();
            $appReceipt = Receipt_orders::where('user_as_clinic_id', '=', $getUserClinic->id)->count();

            //rating for the clinic
            $avgRating = Ratings::where('users_id_ratee', '=', $id)->avg('rating');

            //rating for the system
            $getUserClinic = User_as_clinic::where('id', '=', $id)->first();
            $getUser = User::where('id', '=', $getUserClinic->users_id)->first();
            $avgRatingApp = Ratings::where('users_id_ratee', '=', 1)->where('users_id_rater', '=', $getUser->id)->avg('rating');

            // get data
            $clinic = User_as_clinic::findOrFail($id);

            return response()->json(['clinics' => $clinic, 'avgRatings' => $avgRating, 'avgRatingApp' => $avgRatingApp, 'appReceipt' => $appReceipt]);
        } else {
            //get all appointments
            $getUserClinic = User_as_clinic::where('id', '=', $id)->first();
            $appReceipt = Receipt_orders::where('user_as_clinic_id', '=', $getUserClinic->id)->count();

            //rating for the clinic
            $avgRating = Ratings::where('users_id_ratee', '=', $id)->avg('rating');

            //rating for the system
            $getUserClinic = User_as_clinic::where('id', '=', $id)->first();
            $getUser = User::where('id', '=', $getUserClinic->users_id)->first();
            $avgRatingApp = Ratings::where('users_id_ratee', '=', 1)->where('users_id_rater', '=', $getUser->id)->avg('rating');

            // get data
            $clinic = User_as_clinic::findOrFail($id);

            return view('adminViews.layouts.clinic.clinicView', ['clinics' => $clinic, 'avgRatings' => $avgRating, 'avgRatingApp' => $avgRatingApp, 'appReceipt' => $appReceipt]);
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
        $clinic = User_as_clinic::findOrFail($id);
        // echo($clinic);
        return view('adminViews.layouts.clinic.clinicUpdate', ['clinic' => $clinic]);
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
        // echo($request->input('name'));
        $clinic = User_as_clinic::find($id);
        $clinic->name = $request->input('clinicname');
        $clinic->phone = $request->input('clinicphone');
        $clinic->telephone = $request->input('clinictelephone');
        $clinic->update();
        return response()->json(['clinic' => $clinic]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinic = User_as_clinic::findOrFail($id);
        $clinic->delete();
        return response()->json(['clinic' => $clinic]);
    }
}
