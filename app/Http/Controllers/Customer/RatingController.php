<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\User_as_clinic;


use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Rating Customer to System
        // if($request->rating){

            $validator = Validator::make($request->all(), [
                'area' => 'required|not_in:Choose an area',
                'message' => 'required',
                'rating' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'request' => $request->all()]);
            } else {

            $rating = new Ratings();
            $rating->rating = $request->rating;
            $rating->comment =  "FEEDBACK ~~ " . $request->area . ' ~@~' . $request->message;
            $rating->users_id_ratee = 1;
            $rating->users_id_rater = $request->rater_id;
            $rating->save();
            
            return response()->json(['data'=> $request->rating]);

            }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Clinic Rate (Clinic Info)
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();
        $clinic_id = $id;
        $clinic_data = User_as_clinic::where('id', '=', $clinic_id)->first();
        $rootClinic = User::where('id', '=', $clinic_data->users_id)->first();
        $rate = Ratings::where('users_id_ratee', '=', $rootClinic->id)->pluck('rating')->avg();

        return response()->json(['clinic_rate'=>$rate]);
        // return response()->json(['clinic'=>$clinic_data]);
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
