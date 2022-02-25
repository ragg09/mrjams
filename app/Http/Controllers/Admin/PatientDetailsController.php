<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;

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
        return view('adminViews.tablesPatient', ['patient' => $patient]);

        // return view('adminViews.tables');
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
            $patient = User_as_customer::findOrFail($id);
            return response()->json(['patients' => $patient]);
        } else {
            $patient = User_as_customer::findOrFail($id);
            return view('adminViews.layouts.user.userView', ['patient' => $patient]);
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
        // $users = User_as_customer::findOrFail($id);
        // $users->delete();
        // // return Redirect::to('/customer')->with('success','Customer deleted!');
        // return response()->json(["success" => "Patient deleted successfully.", "data" => $users,"status" => 200]);
        $patient = User_as_customer::findOrFail($id);
        $patient->delete();
        return response()->json(['patients' => $patient]);
    }
}
