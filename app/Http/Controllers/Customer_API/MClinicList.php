<?php

namespace App\Http\Controllers\Customer_API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\Clinic_types;
use App\Models\Clinic_services;
use App\Models\Packages;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Receipt_orders;

class MClinicList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List of Registered Clinic
        
        $user = User::where('email', '=',  Auth::user()->email)->first(); // should be uncomment
        $customer = User_as_customer::where('users_id', '=', $user->id)->first(); // should be uncomment

        $clinics = User_as_clinic::all();
        $count = 0;
        foreach ($clinics as $key) {
            $clinic_types = Clinic_types::where('id', '=',  $key->clinic_types_id)->first();
            $clinic_address = User_address::where('id', '=', $key->user_address_id)->first();
            $package = Packages::where('user_as_clinic_id', '=', $key->id)->first();
            $service = Clinic_services::where('user_as_clinic_id', '=', $key->id)->first();

           
            if ($clinics &&  isset($package) && isset($service)) {
                $all[] = (object) array(
                    "id" => $key->id,
                    "name" => $key->name,
                    "phone" => $key->phone,
                    "telephone" => $key->telephone,
                    "type_of_clinic" => $clinic_types->type_of_clinic,
                    "address_line_1" => $clinic_address->address_line_1,
                    "address_line_2" => $clinic_address->address_line_2,
                    "packages" => $package->name,
                    "services" => $service->name
                );

                $count++;
            }elseif($clinics &&  isset($service)){
                $all[] = (object) array(
                    "id" => $key->id,
                    "name" => $key->name,
                    "phone" => $key->phone,
                    "telephone" => $key->telephone,
                    "type_of_clinic" => $clinic_types->type_of_clinic,
                    "address_line_1" => $clinic_address->address_line_1,
                    "address_line_2" => $clinic_address->address_line_2,
                    "packages" => "no packages",
                    "services" => $service->name
                );

                $count++;
            }elseif ($clinics &&  isset($package)){
                $all[] = (object) array(
                    "id" => $key->id,
                    "name" => $key->name,
                    "phone" => $key->phone,
                    "telephone" => $key->telephone,
                    "type_of_clinic" => $clinic_types->type_of_clinic,
                    "address_line_1" => $clinic_address->address_line_1,
                    "address_line_2" => $clinic_address->address_line_2,
                    "packages" => $package->name,
                    "services" => "no services",

                );
                $count++;
            }
        }

        if ($count > 0) {
            return response()->json([
                'all' => $all,
                'services' => $service
            ]);
            // return response()->json(['customer'=>$customer]);
        } else {
            return response()->json(['status' => 0, 'customer' => $customer, 'clinics' => $clinics]);
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
