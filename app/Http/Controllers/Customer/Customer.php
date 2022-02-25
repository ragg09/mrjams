<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->get();

        echo($customer);
        // return view('customerViews.index_one')->with($customer);
        // return view('layouts.customerlayout', ['customer'=>$customer]);
        // return $customer;
    }

    public function about()
    {
        //
        return view('customerViews.about');
    }

    
    public function contact()
    {
        //
        return view('customerViews.contact');
    }

    public function profile()
    {
        // $user = User::where('email', '=',  Auth::user()->email)->first();
        // $customer = User_as_customer::where('users_id', '=', $user->id)->get();

        // return view('customerViews.profile', ['customer'=>$customer]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->get();

        // $address = User_address::where('id', '=', $customer->user_address_id)->get();

        return view('layouts.customerlayout', ['customer'=>$customer]);
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->get();

        // $address = User_address::where('id', '=', $customer->user_address_id)->get();

        return view('customerViews.profile', ['customer'=>$customer]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
