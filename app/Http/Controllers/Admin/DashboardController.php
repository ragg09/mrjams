<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\Receipt_orders;
use App\Models\Ratings;
use App\Models\Appointments;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $RegUser = User_as_customer::count();
        $RegClinic = User_as_clinic::count();
        $Appointment = Appointments::count();
        //all goods yan , bali dito rin ung need mong query? oo , pag ka load ng index sabay sabay na 
        //pano itsura ng data ung need mo pano mo ba gnwa yung dati? wait
        $Rating = Ratings::where('users_id_ratee', '=', 1)->avg('rating');
        round($Rating, 2);

        $latestClinic = User_as_clinic::orderBy('id', 'desc')->first();
        $latestCustomer = User_as_customer::orderBy('id', 'desc')->first();


        if ($RegUser) {
            return view('adminViews.index', ['regUser' => $RegUser, 'regClinic' => $RegClinic, 'appointment' => $Appointment, 'rating' => $Rating, 'latestClinic' => $latestClinic, 'latestCustomer' => $latestCustomer, 'status' => '1']);
        } else {

            return view('adminViews.index', ['status' => '0']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $clinics = DB::table('ratings')->distinct()->get(['users_id_ratee']); //root id used top 5 ng ano to dati? top 5 ratings sa clinicaaah okay okay
        foreach ($clinics as $key) {
            if ($key->users_id_ratee == 1) {
                //para sa buong system to
            } else {
                //para sa clinics and shit

                $clinic_info = User_as_clinic::where('users_id', '=', $key->users_id_ratee)->first();
                $thisclinic_avg = Ratings::where('users_id_ratee', '!=', 1)->where('users_id_ratee', '=', $key->users_id_ratee)->avg('rating');
                $this_clinic_type = Clinic_types::where('id', '=', $clinic_info->clinic_types_id)->first();

                $clinic_complete[] = (object) array(
                    "root_id" => $key->users_id_ratee,
                    "clinic_id" =>  $clinic_info->id,
                    "name" => $clinic_info->name,
                    "type" => $this_clinic_type->type_of_clinic,
                    "avg" => number_format($thisclinic_avg, 2, '.', ','),

                );
            }
        }
        // echo json_encode($clinic_complete);

        // $topClinicTransac = Recipet_orders::where('user_as_clinic_id', '!=', 0)

        $avgRegPerMonth = User::all();
        $months = [];
        $months_filtered = "";
        foreach ($avgRegPerMonth as $item) {
            $date = date('M', strtotime($item->created_at));
            array_push($months, $date);
        }

        $regMonth = array_filter(array_count_values($months), function ($v) {
            return $v > 0;
        });
        // echo json_encode($appMonth);


        //==================================================================================
        $clinic_ids = User_as_clinic::all(['id']); //pang kuha ng id ng bawat clinic

        foreach ($clinic_ids as $k) {
            $count = 0; //default 0, para kada loop mag istart sa 0

            $this_clinic =  User_as_clinic::where('id', '=', $k->id)->first();
            $clinic_type = Clinic_types::where('id', '=', $this_clinic->clinic_types_id)->first();
            $this_ro = Receipt_orders::where('user_as_clinic_id', '=', $k->id)->get(); // getting every receipt order of current clinic sa loop

            foreach ($this_ro as $kk) { // looping through receipt orderssssss
                $this_app = Appointments::where('receipt_orders_id', '=', $kk->id)->first();

                //checking if current appoint of every receipt is ACCEPTED
                if ($this_app->appointment_status_id == 4 || $this_app->appointment_status_id == 1) {
                    $count++; //plus 1 kung mag true
                }
            }

            $top5Clinic_App[] = (object) array(
                "clinic_id" => $k,
                "name" => $this_clinic->name,
                "type" => $clinic_type->type_of_clinic,
                "count" =>  $count,
            );
        }

        //==================================================================================
        $patient_id = User_as_customer::all(['id']); //pang kuha ng id ng bawat clinic

        foreach ($patient_id as $key) {
            $count = 0; //default 0, para kada loop mag istart sa 0

            $this_patient =  User_as_customer::where('id', '=', $key->id)->first();
            // $clinic_type = Clinic_types::where('id', '=', $this_clinic->clinic_types_id)->first();
            $this_ro_patient = Receipt_orders::where('user_as_customer_id', '=', $key->id)->get(); // getting every receipt order of current clinic sa loop

            foreach ($this_ro_patient as $kkey) { // looping through receipt orderssssss
                $this_app = Appointments::where('receipt_orders_id', '=', $kkey->id)->first();

                //checking if current appoint of every receipt is ACCEPTED
                if ($this_app->appointment_status_id == 4 || $this_app->appointment_status_id == 1) {
                    $count++; //plus 1 kung mag true
                }
            }

            $top5Customer_App[] = (object) array(
                "patient_id" => $k,
                "name" => $this_patient->fname,
                // "type" => $clinic_type->type_of_clinic,
                "count" =>  $count,
            );
        }

        return response()->json([
            'tester' => 'ito',
            'clinic_complete' => $clinic_complete,
            'regMonth' => $regMonth,
            'clinic_ids' => $clinic_ids,
            'top5Clinic_App' =>  $top5Clinic_App,
            'top5Customer_App' =>  $top5Customer_App,
        ]);
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
