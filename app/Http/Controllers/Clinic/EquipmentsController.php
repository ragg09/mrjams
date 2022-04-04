<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Packages_has_equipments;
use App\Models\Packages_has_services;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\Services_has_equipments;
use App\Models\User;
use App\Models\User_as_clinic;

use Illuminate\Support\Facades\DB;

class EquipmentsController extends Controller
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

        $data = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->orderBy('name', 'ASC')->paginate(10);
        $data_all = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->orderBy('name', 'ASC')->get();

        return view('clinicViews.equipments.index', ['data' => $data, 'data_all' => $data_all]);
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
            $data = Clinic_equipments::query()->where('name', 'LIKE', "%{$query}%")
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
            'name' => 'required',
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'request' => $request->all()]);
        } else {
            $myequiipments = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('name', '=',  $request->name)
                ->first();

            if ($myequiipments) {
                if ($myequiipments->name == $request->name && $myequiipments->unit == $request->unit) {
                    $equip = Clinic_equipments::find($myequiipments->id);
                    $equip->quantity =  $myequiipments->quantity + request('quantity');
                    $equip->save();

                    //checking logs limit 5000
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    //creating logs
                    $logs = new Logs();
                    $logs->message = '"' . request('name') . '"' . " already exists, quantity added.";
                    $logs->remark = "success";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    return response()->json([
                        'message' => request('name') . ' already exist, quantity added.',
                        'keys' => $equip,
                        'dataCount' => count(Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get()),
                    ]);
                } else {
                    $equipment = new Clinic_equipments();
                    $equipment->name = $request->name;
                    $equipment->quantity = $request->quantity;
                    $equipment->unit = $request->unit;
                    $equipment->type = $request->type;
                    $equipment->user_as_clinic_id = $clinic->id;
                    $equipment->save();

                    //checking logs limit 5000
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    //creating logs
                    $logs = new Logs();
                    $logs->message = '"' . request('name') . '"' . " has been added to the equipments.";
                    $logs->remark = "success";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    return response()->json([
                        'message' => request('name') . ' added successfully',
                        'keys' => $equipment,
                        'dataCount' => count(Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get()),
                    ]);
                }
            } else {
                $equipment = new Clinic_equipments();
                $equipment->name = $request->name;
                $equipment->quantity = $request->quantity;
                $equipment->unit = $request->unit;
                $equipment->type = $request->type;
                $equipment->user_as_clinic_id = $clinic->id;
                $equipment->save();

                //checking logs limit 5000
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                //creating logs
                $logs = new Logs();
                $logs->message = '"' . request('name') . '"' . " has been added to the equipments.";
                $logs->remark = "success";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();

                return response()->json([
                    'message' => request('name') . ' added successfully',
                    'keys' => $equipment,
                    'dataCount' => count(Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get()),
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

        $equipments = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $current_ids = $id; //Gettinng string of ids
        $array_ids = explode(',', $current_ids); //splitting string into sepratae string using the comma

        return response()->json(['ids' => json_encode($array_ids), 'equipments' =>  $equipments]);
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

        $equipment = Clinic_equipments::where('id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->first();

        $get_packages_id = Packages_has_equipments::where('clinic_equipments_id', '=',  $equipment->id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        foreach ($get_packages_id as $key) {
            $packages[] = Packages::where('id', '=',  $key->packages_id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->get();
        }

        $services_id = Services_has_equipments::where('user_as_clinic_id', '=', $clinic->id)
            ->where('clinic_equipments_id', '=', $id)
            ->get(['clinic_services_id']);

        $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
            ->whereIn('id', $services_id)
            ->get();

        $services_summary = "";
        foreach ($services as $key) {
            $services_summary = $services_summary . ", " . $key->name;
        }

        // if (count($get_packages_id) > 0) {
        //     foreach ($get_packages_id as $key) {
        //         $packages[] = Packages::where('id', '=',  $key->packages_id)
        //             ->where('user_as_clinic_id', '=',  $clinic->id)
        //             ->get();
        //     }
        //     return response()->json(['equipment' => $equipment, 'packages' => $packages]);
        // } else {
        //     return response()->json(['equipment' => $equipment]);
        // }

        return response()->json([
            'equipment' => $equipment ?? "",
            'packages' => $packages ?? "",
            'services_summary' => $services_summary ?? "",
            'tester' => $services_id,
        ]);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $equipment_last_name = Clinic_equipments::find($id);

            if (request('add_equipment') == 'true') {
                $equipment = Clinic_equipments::find($id);
                $equipment->quantity =  $equipment_last_name->quantity + request('quantity');
                $equipment->save();

                //checking logs limit 5000
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                //creating logs
                $logs = new Logs();
                $logs->message = request('quantity') . ' added to "' . $equipment_last_name->name . '". New Quantity: ' . $equipment_last_name->quantity + request('quantity');
                $logs->remark = "warning";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            } else {
                $equipment = Clinic_equipments::find($id);
                $equipment->name = request('name');
                $equipment->quantity = request('quantity');
                $equipment->unit = request('unit');
                $equipment->type = request('type');
                $equipment->save();

                //creating logs
                if (!($equipment_last_name->name == request('name'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = '"' . $equipment_last_name->name . '"' . " has changed into " . '"' . request('name') . '".';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }
                if (!($equipment_last_name->quantity == request('quantity'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = request('name') . ': from "' . $equipment_last_name->quantity . '"' . " changed into " . '"' . request('quantity') . '".';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }
                if (!($equipment_last_name->unit == request('unit'))) {
                    $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = request('name') . ': Unit "' . $equipment_last_name->unit . '"' . " changed into " . '"' . request('unit') . '".';
                    $logs->remark = "warning";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();
                }
            }

            return response()->json(['message' => 'Equipment Updated!']);
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

        //removing service from every packages
        $get_packages_id = Packages_has_equipments::where('clinic_equipments_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        foreach ($get_packages_id as $key) {
            Packages_has_equipments::where('packages_id', '=',  $key->packages_id)
                ->where('clinic_equipments_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }

        //"message": "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`mrjams_system`.`clinic_services_has_equipments`, CONSTRAINT `fk_clinic_equipments_has_clinic_services_clinic_equipments1` FOREIGN KEY (`clinic_equipments_id`) REFERENCES `clinic_equipments` () (SQL: delete from `clinic_equipments` where `id` = 5)",

        $services = Services_has_equipments::where('clinic_equipments_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        foreach ($services as $key) {
            Services_has_equipments::where('clinic_services_id', '=',  $key->clinic_services_id)
                ->where('clinic_equipments_id', '=',  $id)
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->delete();
        }


        $equipment = Clinic_equipments::findOrFail($id);

        if ($equipment->user_as_clinic_id == $clinic->id) {
            $equipment->delete();

            $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
            }
            //creating logs
            $logs = new Logs();
            $logs->message = '"' . $equipment->name . '"' . " has been deleted.";
            $logs->remark = "danger";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();


            return response()->json([
                'message' => 'Equipment Deleted!',
                'dataCount' => count(Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get()),
            ]);
        }
    }
}
