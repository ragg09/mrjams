<?php

namespace App\Http\Controllers\Customer_API;

use App\Http\Controllers\Controller;
use App\Models\Clinic_equipments;
use Illuminate\Http\Request;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\Clinic_services;
use App\Models\Packages;


class MCustomerMap extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = User_as_clinic::all();

        $count = 0;
        foreach ($clinics as $key) {
            $with_service = Clinic_equipments::where("user_as_clinic_id", $key->id)->get();


            $clinic_address = User_address::where('id', '=', $key->user_address_id)->first();
            $clinic_types = Clinic_types::where('id', '=',  $key->clinic_types_id)->first();

            if (count($with_service) > 0) {
                if ($clinics) {
                    $data[] = (object) array(
                        "id" => $key->id,
                        "name" => $key->name,
                        "phone" => $key->phone,
                        "telephone" => $key->telephone,
                        "type" => $clinic_types->type_of_clinic,
                        "address_line_1" => $clinic_address->address_line_1,
                        "address_line_2" => $clinic_address->address_line_2,
                        "longitude" => $clinic_address->longitude,
                        "latitude" => $clinic_address->latitude,
                        "city" => $clinic_address->city,
                        "zip_code" => $clinic_address->zip_code
                    );
                }
                $count++;
            }

        }

        if ($count > 0) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['status' => 0]);
        }
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
        $clinic = User_As_clinic::where('id', '=', $id)->first();
        $clinic_type = Clinic_types::where('id', '=', $clinic->clinic_types_id)->first();
        $clinic_add = User_address::where('id', '=', $clinic->user_address_id)->first();
   
        $clinic_data[] = (object) array(  
                    "id" => $clinic->id, 
                    "name" => $clinic->name,
                    "phone" => $clinic->phone,
                    "telephone" => $clinic->telephone,
                    "type" => $clinic_type->type_of_clinic,
                    "address_line_1" => $clinic_add->address_line_1,
                    "address_line_2" => $clinic_add->address_line_2,
                    "longitude" => $clinic_add->longitude,
                    "latitude" => $clinic_add->latitude,
                    "city" => $clinic_add->city,
                    "zip_code" => $clinic_add->zip_code
        );

        return response()->json([
            "clinic_data"=>$clinic_data
        ]);
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
