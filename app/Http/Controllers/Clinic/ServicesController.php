<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Clinic_equipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Clinic_services;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Packages_has_services;
use App\Models\Services_has_equipments;
use App\Models\User;
use App\Models\User_as_clinic;


class ServicesController extends Controller
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

        $data = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->paginate(10);
        $myequipments = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get();

        return view('clinicViews.services.index', ['data' => $data, 'equipments' =>  $myequipments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        if ($request->ajax()) {
            $query = $request->get('query');
            $data = Clinic_services::query()->where('name', 'LIKE', "%{$query}%")
                ->where('user_as_clinic_id', '=', $clinic->id)
                ->get();
            return  response()->json(['data' => $data]);
        }
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
            'description' => 'required|min:5',
            'min_price' => 'required|numeric|gt:0',
            'max_price' => 'required|numeric|gt:min_price',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $myservices = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('name', '=',  $request->name)
                ->first();

            if ($myservices) {
                return response()->json(['status' => 3, 'tester' => "meron na bawal na to"]);
            } else {
                $service = new Clinic_services();
                $service->name = $request->name;
                $service->description = $request->description;
                $service->min_price = $request->min_price;
                $service->max_price = $request->max_price;
                $service->user_as_clinic_id = $clinic->id;
                $service->save();

                // $equipment_ids = request('equipment_ids'); //Gettinng string of ids
                // $equipment_ids_array = explode(',', $equipment_ids); //splitting string into sepratae string using the comma
                // foreach ($equipment_ids_array as $key) {
                //     $sequipments = new Services_has_equipments();
                //     $sequipments->clinic_services_id = $service->id;
                //     $sequipments->clinic_equipments_id = $key;
                //     $sequipments->user_as_clinic_id = $clinic->id;
                //     $sequipments->save();
                // }

                //checking logs limit 5000
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                //creating logs
                $logs = new Logs();
                $logs->message = '"' . request('name') . '"' . " has been added to the services.";
                $logs->remark = "success";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();


                return response()->json([
                    'message' => request('name') . ' added successfully',
                    'keys' => $service,
                    'dataCount' => count(Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->get()),
                ]);
            }
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

        if (strpos($id, "BILLING")) {
            $remove_text = explode(" ", $id);

            $getid = explode(",", $remove_text[0]);

            $getservices = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)
                ->whereIn('id', $getid)
                ->get();

            $getEqupId = Services_has_equipments::where('user_as_clinic_id', '=',  $clinic->id)
                ->whereIn('clinic_services_id', $getid)
                ->get(['clinic_equipments_id']);


            foreach ($getEqupId as $key) {
                $equipments[] = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)
                    ->where('id', '=',  $key->clinic_equipments_id)
                    ->first();
            }

            return response()->json(['services' => $getservices, 'equipments' => $equipments]);
        } else {
            $services = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->get();

            $current_ids = $id; //Gettinng string of ids
            $array_ids = explode(',', $current_ids); //splitting string into sepratae string using the comma

            return response()->json(['ids' => json_encode($array_ids), 'services' =>  $services]);
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        if (strpos($id, "stats")) {
            $getid = explode("_", $id);

            return response()->json([
                'tester' => "tesst stats",
            ]);
        } else {
            $services = Clinic_services::where('id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            $getID_myequipments = Services_has_equipments::where('clinic_services_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->get();

            $myequipments_orig_ids = [];

            foreach ($getID_myequipments as $key) {
                $myequipments[] = Clinic_equipments::where('id', '=',  $key->clinic_equipments_id)
                    ->where('user_as_clinic_id', '=',  $clinic->id)
                    ->get();

                array_push($myequipments_orig_ids, $key->clinic_equipments_id);
            }


            $allequipments = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get();;

            $get_packages_id = Packages_has_services::where('clinic_services_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->get();

            if (count($get_packages_id) > 0) {
                foreach ($get_packages_id as $key) {
                    $packages[] = Packages::where('id', '=',  $key->packages_id)
                        ->where('user_as_clinic_id', '=',  $clinic->id)
                        ->get();
                }
                return response()->json([
                    'tester' => 'if package exists',
                    'services' => $services,
                    'packages' => $packages,
                    'myequipments' => $myequipments,
                    'myequipments_orig_ids' =>  $myequipments_orig_ids,
                    'allequipments' => $allequipments
                ]);
            } else {
                return response()->json([
                    'services' => $services,
                    'myequipments' => $myequipments,
                    'myequipments_orig_ids' =>  $myequipments_orig_ids,
                    'allequipments' => $allequipments
                ]);
            }
        }
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'description' => 'required|min:5',
            'min_price' => 'required|numeric|gt:0',
            'max_price' => 'required|numeric|gt:min_price',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $service_last_name = Clinic_services::find($id);

            $service = Clinic_services::find($id);
            $service->name = request('name');
            $service->min_price = request('min_price');
            $service->max_price = request('max_price');
            $service->description = request('description');
            $service->save();

            if (!empty(request('equipment_ids_edit'))) { //if equipments has changes
                //deleting old equipments first
                $orig = request('equipments_original_ids'); //Gettinng string of ids
                $orig_array = explode(',', $orig); //splitting string into sepratae string using the comma
                foreach ($orig_array as $key) {
                    Services_has_equipments::where('clinic_services_id', '=',  $id)
                        ->where('clinic_equipments_id', '=', $key)
                        ->where('user_as_clinic_id', '=',  $clinic->id)
                        ->delete();
                }

                //adding new equipments
                $new = request('equipment_ids_edit'); //Gettinng string of ids
                $new_array = explode(',', $new); //splitting string into sepratae string using the comma
                foreach ($new_array as $key) {
                    $sequipments = new Services_has_equipments();
                    $sequipments->clinic_services_id = $id;
                    $sequipments->clinic_equipments_id = $key;
                    $sequipments->user_as_clinic_id = $clinic->id;
                    $sequipments->save();
                }
            }


            //creating logs
            if (!($service_last_name->name == request('name'))) {
                //checking logs limit 5000
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = '"' . $service_last_name->name . '"' . " has changed into " . '"' . request('name') . '".';
                $logs->remark = "warning";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }

            if (!($service_last_name->min_price == request('min_price')) || !($service_last_name->min_price == request('min_price'))) {
                //checking logs limit 5000
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = $service_last_name->name . '\'s price: changed into' . ' "' . request('min_price') . ' - ' . request('max_price') . '"';
                $logs->remark = "warning";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }

            if (!($service_last_name->description == request('description'))) {
                //checking logs limit 5000
                if ($logs_count  == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = '"' . $service_last_name->description . '"' . " has changed into " . '"' . request('description') . '".';
                $logs->remark = "warning";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }




            return response()->json(['message' => 'Service Updated!']);
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

        //getting packages id
        $get_packages_id = Packages_has_services::where('clinic_services_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        //getting equipments id
        $get_equipments_id = Services_has_equipments::where('clinic_services_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        //removing service from every packages

        foreach ($get_packages_id as $key) {
            Packages_has_services::where('packages_id', '=',  $key->packages_id)
                ->where('clinic_services_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }

        foreach ($get_equipments_id as $key) {
            Services_has_equipments::where('clinic_services_id', '=',  $id)
                ->where('clinic_equipments_id', '=', $key->clinic_equipments_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }

        //deleting the service
        $service = Clinic_services::findOrFail($id);
        $service->delete();


        //checking logs limit 5000
        $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

        if ($logs_count == 5000) {
            Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
        }
        //creating logs
        $logs = new Logs();
        $logs->message = '"' . $service->name . '"' . " has been deleted.";
        $logs->remark = "danger";
        $logs->date =  date("Y/m/d");
        $logs->time = date("h:i:sa");
        $logs->user_as_clinic_id = $clinic->id;
        $logs->save();



        //return response()->json(['message' => json_encode($get_packages_id)]);

        return response()->json([
            'message' => 'Service Deleted!',
            'dataCount' => count(Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->get()),
        ]);
    }
}
