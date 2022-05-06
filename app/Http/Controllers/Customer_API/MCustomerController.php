<?php

namespace App\Http\Controllers\Customer_API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class MCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $address = User_address::where('id', '=', $customer->user_address_id)->first();

        return response()->json([
            'user'=>$user,
            'customer'=>$customer, 
            'address'=>$address
        ]);
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
        //
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
        $fname = $request->fname;
        // $mname = $request->mname;
        $lname = $request->lname;
        // $gender = $request->gender;
        $phone = $request->phone;
        $age = $request->age;

        $addline1 = $request->addline1;
        $addline2 = $request->addline2;
        $city = $request->city;
        $zipcode = $request->zipcode;

        $user_customer = User_as_customer::where('users_id', '=', $id)->first();
        $user_customer->fname = $fname;
        // $user_customer->mname = $mname;
        $user_customer->lname = $lname;
        // $user_customer->gender = $gender;
        $user_customer->phone = $phone;
        $user_customer->age = $age;
        $user_customer->save();

        $customer_add = User_address::where('id', '=', $user_customer->user_address_id)->first();
        $customer_add->address_line_1 = $addline1;
        $customer_add->address_line_2 = $addline2;
        $customer_add->city = $city;
        $customer_add->zip_code = $zipcode;
        $customer_add->save();

        return response()->json(['message' => "Success"]);
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
