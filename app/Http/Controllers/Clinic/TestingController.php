<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Clinic_types;
use Illuminate\Http\Request;

use App\Models\User_address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\Logs;
use App\Models\Messages;
use App\Models\Packages;
use App\Models\Ratings;
use App\Models\Services_has_equipments;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $clinics = DB::table('ratings')->distinct()->get(['users_id_ratee']); //root id used
        // foreach ($clinics as $key) {
        //     if ($key->users_id_ratee == 1) {
        //         //para sa buong system to
        //     } else {
        //         //para sa clinics and shit

        //         $clinic_info = User_as_clinic::where('users_id', '=', $key->users_id_ratee)->first();
        //         $thisclinic_avg = Ratings::where('users_id_ratee', '!=', 1)->where('users_id_ratee', '=', $key->users_id_ratee)->avg('rating');
        //         $this_clinic_type = Clinic_types::where('id', '=', $clinic_info->clinic_types_id)->first();

        //         $clinic_complete[] = (object) array(
        //             "root_id" => $key->users_id_ratee,
        //             "clinic_id" =>  $clinic_info->id,
        //             "name" => $clinic_info->name,
        //             "type" => $this_clinic_type->type_of_clinic,
        //             "avg" => $thisclinic_avg,

        //         );
        //     }
        // }
        // echo json_encode($clinic_complete);

        // echo (Messages::whereIn('receiver', ['all', 'patient'])->get());

        // $sequipments = new Services_has_equipments();
        // $sequipments->clinic_services_id = 3;
        // $sequipments->clinic_equipments_id = 4;
        // $sequipments->user_as_clinic_id = 3;
        // $sequipments->save();

        $clinic = User_as_clinic::all();
        $service = Clinic_services::all();
        $equip = Clinic_equipments::all();


        foreach ($clinic as $key) {
            echo $key;
            echo "<br>";
        }

        echo "<br><br>";


        foreach ($service as $key) {
            echo $key;
            echo "<br>";
        }

        echo "<br><br>";


        foreach ($equip as $key) {
            echo $key;
            echo "<br>";
        }


        //$getID_myequipments = Services_has_equipments::all();

        // echo $equip;

        //return view('clinicViews.testing.index');

        //para kay lags, para less query loading
        //return User_address::get(['latitude', 'longitude']);



        // if (Logs::where('user_as_clinic_id', '=',  1)->count() == 1000) {
        //     Logs::where('user_as_clinic_id', '=',  1)->first()->delete();
        // }

        //return Logs::where('user_as_clinic_id', '=',  1)->count();
        // $details = [
        //     'title' => 'Mr Jams Title of Email',
        //     'body' => 'Message to ng email',
        // ];

        // $recipient = "ragunayon@gmail.com";

        // Mail::to($recipient)->send(new EmailNotification($details));
        // return "Email Sent";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $clinics = User_as_clinic::all();

        // $clinics_add = User_address::get(['id', 'latitude', 'longitude']);

        // // $data = User::select(DB::('count(id) as total'), DB::raw('MONTH(created_at) month'))
        // //     ->groupby('month')
        // //     ->orderBy('created_at', 'asc')
        // //     ->get();

        // // foreach ($clinics as $clinic) {
        // //     $temp = User_address::where('user_as_clinic_id', '=', $clinic->id)
        // // }


        // // foreach ($clinics as $clinic) {
        // //     // $package[] = Packages::where('user_as_clinic_id', '=', $clinic->id)
        // //     //     ->get();
        // // }

        // return response()->json(['clinic_add' => $clinics_add]);


        $user = User::where('email', '=',  "laravelmovie@gmail.com")->first();
        $customer = User_as_customer::where('id', '=', $user->id)->get();

        // $customer_add_table = User_address::all();
        $customer_add = User_address::where('id', '=', $customer[0]->user_address_id)->get();

        // echo($customer->user_address_id);
        //echo ($customer[0]->user_address_id);
        echo ($customer_add);
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
        $address = User_address::where('id', '=',  $id)
            ->get();
        return response()->json(['address' => $address]);
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
