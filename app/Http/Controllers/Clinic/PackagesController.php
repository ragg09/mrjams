<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Packages;
use App\Models\Packages_has_equipments;
use App\Models\Packages_has_services;
use App\Models\Clinic_services;
use App\Models\Clinic_equipments;
use App\Models\Logs;
use App\Models\User;
use App\Models\User_as_clinic;
use Facade\Ignition\Support\Packagist\Package;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        $services = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->get();
        $equipments = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get();
        $data = Packages::where('user_as_clinic_id', '=',  $clinic->id)->get();

        return view('clinicViews.packages.index', ['data' => $data, 'services' => $services, 'equipments' => $equipments]);
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'description' => 'required|min:5|max:45',
            'min_price' => 'required|numeric|gt:0',
            // 'max_price' => 'required|numeric|gt:min_price',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $package = new Packages();
            $package->name = request('name');
            $package->description = request('description');
            $package->min_price = request('min_price');
            $package->max_price = request('max_price');
            $package->user_as_clinic_id = $clinic->id;
            $package->save();

            $service_ids = request('service_ids'); //Gettinng string of ids
            $service_ids_array = explode(',', $service_ids); //splitting string into sepratae string using the comma
            foreach ($service_ids_array as $key) {
                $package_service = new Packages_has_services();
                $package_service->packages_id = $package->id;
                $package_service->clinic_services_id = $key;
                $package_service->user_as_clinic_id = $clinic->id;
                $package_service->save();
            }

            $equipment_ids = request('equipment_ids'); //Gettinng string of ids
            $equipment_ids_array = explode(',', $equipment_ids); //splitting string into sepratae string using the comma
            foreach ($equipment_ids_array as $key) {
                $package_equipment = new Packages_has_equipments();
                $package_equipment->packages_id = $package->id;
                $package_equipment->clinic_equipments_id = $key;
                $package_equipment->user_as_clinic_id = $clinic->id;
                $package_equipment->save();
            }

            //checking logs limit 5000
            $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            //creating logs
            $logs = new Logs();
            $logs->message = '"' . request('name') . '"' . " has been added to the Package.";
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();


            return response()->json([
                'message' => request('name') . ' added successfully',
                'keys' => $package,
                'dataCount' => count(Packages::where('user_as_clinic_id', '=',  $clinic->id)->get()),
            ]);
        }
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
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        $package = Packages::where('id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        $equipments = Packages_has_equipments::where('packages_id', '=', $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->select('clinic_equipments_id')
            ->get();

        $services = Packages_has_services::where('packages_id', '=', $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->select('clinic_services_id')
            ->get();


        $all_equipments_ids = ""; // for updatinging purposes
        foreach ($equipments as $key) {
            $all_equipments[] = Clinic_equipments::where('id', '=',  $key->clinic_equipments_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->get();

            $all_equipments_ids = $key->clinic_equipments_id . ',' . $all_equipments_ids;
        }

        $all_services_ids = ""; // for updatinging purposes
        foreach ($services as $key) {
            $all_services[] = Clinic_services::where('id', '=',  $key->clinic_services_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->get();

            $all_services_ids = $key->clinic_services_id . ',' . $all_services_ids;
        }


        //echo ($all_services_ids);



        return view('clinicViews.packages.edit_show', ['package' => $package, 'equipments' => $all_equipments, 'equipment_ids' => $all_equipments_ids, 'services' => $all_services, 'service_ids' => $all_services_ids]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        $package = Packages::where('id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();
        return response()->json(['package' => $package]);
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
        // UPDATE PACKAGE DETAILS
        if (request('package_update_filter') == "package_details") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2',
                'description' => 'required|min:5|max:45',
                'min_price' => 'required|numeric|gt:0',
                // 'max_price' => 'required|numeric|gt:min_price',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {

                $user = User::where('email', '=',  Auth::user()->email)->first();
                $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

                $package_last_name = Packages::find($id);

                $package = Packages::find($id);
                $package->name = request('name');
                $package->min_price = request('min_price');
                $package->max_price = request('max_price');
                $package->description = request('description');
                $package->save();

                //creating logs
                if (!($package_last_name->name == request('name'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = '"' . $package_last_name->name . '"' . " has changed into " . '"' . request('name') . '".';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }

                if (!($package_last_name->min_price == request('min_price')) || !($package_last_name->max_price == request('max_price'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = $package_last_name->name . '\'s price: changed into' . ' "' . request('min_price') . ' - ' . request('max_price') . '"';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }

                if (!($package_last_name->description == request('description'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    //checking logs limit 5000
                    if ($logs_count  == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = '"' . $package_last_name->description . '"' . " has changed into " . '"' . request('description') . '".';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }

                return response()->json(['message' => 'Package Updated!']);
            }
        }

        // UPDATE PACKAGE EQUIPMENTS
        if (request('package_update_filter') == "package_equipments" && request("equipment_ids") != "") {
            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

            $equipments = explode(',', request("equipments_original_ids")); //splitting string into sepratae string using the comma
            foreach ($equipments as $key) {
                Packages_has_equipments::where('packages_id', '=',  $id)
                    ->where('clinic_equipments_id', '=',  $key)
                    ->where('user_as_clinic_id', '=',  $clinic->id)
                    ->delete();
            }

            $equipment_ids = request('equipment_ids'); //Gettinng string of ids
            $equipment_ids_array = explode(',', $equipment_ids); //splitting string into sepratae string using the comma
            foreach ($equipment_ids_array as $key) {
                $package_equipment = new Packages_has_equipments();
                $package_equipment->packages_id = $id;
                $package_equipment->clinic_equipments_id = $key;
                $package_equipment->user_as_clinic_id = $clinic->id;
                $package_equipment->save();
            }



            return response()->json(['message' => "Pacakage equipments updated"]);
        }

        // UPDATE PACKAGE SERVICES
        if (request('package_update_filter') == "package_services") {
            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

            $services = explode(',', request("services_original_ids")); //splitting string into sepratae string using the comma
            foreach ($services as $key) {
                Packages_has_services::where('packages_id', '=',  $id)
                    ->where('clinic_services_id', '=',  $key)
                    ->where('user_as_clinic_id', '=',  $clinic->id)
                    ->delete();
            }

            $service_ids = request('service_ids'); //Gettinng string of ids
            $service_ids_array = explode(',', $service_ids); //splitting string into sepratae string using the comma
            foreach ($service_ids_array as $key) {
                $package_service = new Packages_has_services();
                $package_service->packages_id = $id;
                $package_service->clinic_services_id = $key;
                $package_service->user_as_clinic_id = $clinic->id;
                $package_service->save();
            }
            return response()->json(['message' => "Pacakage services updated"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        $services = Packages_has_services::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('packages_id', '=',  $id)
            ->get();

        $equipments = Packages_has_equipments::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('packages_id', '=',  $id)
            ->get();

        foreach ($services as $service) {
            Packages_has_services::where('packages_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }

        foreach ($equipments as $equipment) {
            Packages_has_equipments::where('packages_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }

        $package = Packages::findOrFail($id);
        $package->delete();

        //checking logs limit 5000
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
        if ($logs_count == 5000) {
            Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
        }
        //creating logs
        $logs = new Logs();
        $logs->message = '"' . $package->name . '"' . " has been deleted.";
        $logs->remark = "danger";
        $logs->date =  date("Y/m/d");
        $logs->time = date("h:i:sa");
        $logs->user_as_clinic_id = $clinic->id;
        $logs->save();


        return response()->json([
            'message' => 'Package Deleted!',
            'dataCount' => count(Packages::where('user_as_clinic_id', '=',  $clinic->id)->get()),
        ]);


        //return response()->json(['service' => $services, 'equipments' => $equipments]);
    }
}
