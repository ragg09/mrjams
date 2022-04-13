<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\Receipt_orders;
use App\Models\Appointments;
use App\Models\Ratings;
use App\Mail\AcceptRegistrationMail;
use App\Models\Clinic_time_availability;
use App\Models\Clinic_auto_scheduling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClinicRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicReg = User::where('role', '=', 'clinic')->where('status', '=', 'verifying')->get();

        return view('adminViews.layouts.clinic.clinicRegistration', ['clinicReg' => $clinicReg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // pag get nung clinic
        // $clinicReg = User::findOrFail($id);

        $clinicReg = User_as_clinic::where('users_id', '=', $id)->first();

        //pag get ng address
        $clinicAdd = User_address::where('id', '=', $clinicReg->user_address_id)->first();

        $clinicType = Clinic_types::where('id', '=', $clinicReg->clinic_types_id)->first();
        return view('adminViews.layouts.clinic.clinicRegView', ['clinicReg' => $clinicReg, 'clinicAdd' => $clinicAdd, 'clinicType' => $clinicType]);
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
        $clinic = User_as_clinic::find($id);
        $clinicReg = User::where('id', '=', $clinic->users_id)->first();
        $clinicReg->status = 'verified';
        $clinicReg->update();
        // echo ($clinicReg);

        // email
        $details = [
            'title' => 'MR.JAMS',
            'body' => 'WELCOME! You have been Accepted as a Registered Clinic to MR.JAMS Application.',
        ];

        // Mail::to($request->sender)->send(new AdminMail($details));
        Mail::to($clinicReg->email)->send(new AcceptRegistrationMail($details));
        // return "email sent";
        return response()->json(['clinicReg' => $clinicReg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`mrjams_system`.`user_as_clinic`, CONSTRAINT `fk_user_as_clinic_user_adress1` FOREIGN KEY (`user_address_id`) REFERENCES `user_address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) (SQL: delete from `user_address` where `id` = 10)"
        // getclinic
        $getClinic = User_as_clinic::find($id);
        // //clinic add
        $clinicAdd = User_address::where('id', '=', $getClinic->user_address_id)->first();
        // //clinic time availability
        $clinicTime = Clinic_time_availability::where('user_as_clinic_id', '=', $getClinic->id)->first();
        // //clinic auto shced
        $clinicAutoSched = Clinic_auto_scheduling::where('user_as_clinic_id', '=', $getClinic->id)->first();
        //clinic user
        $clinicUser = User::where('id', '=', $getClinic->users_id)->first();

        $clinicTime->delete();
        $clinicAutoSched->delete();
        $getClinic->delete();
        $clinicAdd->delete();
        $clinicUser->delete();

        return response()->json(['tester' => $getClinic, 'tester2' => $clinicAdd, 'tester3' => $clinicTime, 'tester4' => $clinicAutoSched,]);



        // echo json_encode($clinicTime);
        // echo json_encode($clinicAutoSched);
    }
}
