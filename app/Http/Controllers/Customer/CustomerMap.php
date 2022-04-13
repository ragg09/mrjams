<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\Clinic_services;
use App\Models\Packages;

class CustomerMap extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('customerViews.mapping');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // $clinic_add = User_address::get(['latitude', 'longitude', 'address_line_1', 'address_line_2', 'city', 'zip_code']);
        // return response()->json(['data' => $data]);

        $clinics = User_as_clinic::all();
        
        $count = 0;
        foreach ($clinics as $key) {
            
            $clinic_address = User_address::where('id', '=', $key->user_address_id)->first();
            $clinic_types = Clinic_types::where('id', '=',  $key->clinic_types_id)->first();
           
            if($clinics){
                $data[] = (object) array(  
                    "id" => $key->id, 
                    "name" => $key->name,
                    "phone" => $key->phone,
                    "telephone" => $key->telephone,
                    "type" => $clinic_types->type_of_clinic,
                    "address_line_1" => $clinic_address->address_line_1,
                    "address_line_2" => $clinic_address->address_line_2,
                    "longitude" => $clinic_address->longitude,
                    "latitude"=> $clinic_address->latitude,
                    "city" => $clinic_address->city,
                    "zip_code" => $clinic_address->zip_code

                );
            }
            $count++;
           
        }

        if($count > 0){
            return response()->json(['data'=>$data]);
        }else{
            return response()->json(['status'=> 0]);
        }

        //return User_address::get(['latitude', 'longitude']);
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
        // $user = User::where('email', '=',  Auth::user()->email)->first();

        // if ($request->ajax()) {
        //     $query = $request->get('query');
        //     $data = User_as_clinic::query()->where('clinic_types_id', 'LIKE', "%{$query}%")->get();

        //     $count = 0;
        //     if (count($data) > 0) {
        //         foreach ($data as $key) {
        //             $address = User_address::where('id', '=', $key->user_address_id)->first();
        //             $type = Clinic_types::where('id', '=', $key->clinic_types_id)->first();
        //             $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
        //             $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();


        //             if (isset($package) && isset($service)) {
        //                 $ClinicAdd[] = (object) array(
        //                     "id" => $key->id,
        //                     "name" => $data[$count]->name,
        //                     "addLine1" => $address->address_line_1,
        //                     "addLine2" => $address->address_line_2,
        //                     "type" => $type->type_of_clinic,
        //                     "package" => $package->name,
        //                     "service" => $service->name
        //                 );
        //                 $count++;
        //             }
        //         }

        //         if ($count > 0) {
        //             return  response()->json(['ClinicAdd' => $ClinicAdd, 'status' => 1]);
        //         } else {
        //             return response()->json(['status' => 0]);
        //         }
        //     }
        // }
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
