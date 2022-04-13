<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_as_customer;
use App\Models\User_as_clinic;
use DB;

class TablesController extends Controller
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
        return view('adminViews.tables', ['user' => $user]);

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
        $clinic = User_as_clinic::findOrFail($id);
        // $customer = User_as_customer::findOrFail($id);
        //return view('adminViews.layouts.clinic.clinicView' , ['clinic'=>$clinic, 'customer'=>$customer]);
        return view('adminViews.layouts.clinic.clinicView', ['clinic' => $clinic]);
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
        // $producers = Producer::findOrFail($id);
        // $producers->delete();
        // return json_encode(["producers" => $producers]);
    }
}
