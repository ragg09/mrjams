<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Clinic_services;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Packages_has_services;
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
        return view('clinicViews.services.index', ['data' => $data]);
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
            'name' => 'required|unique:clinic_services,name|min:2',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $service = new Clinic_services();
            $service->name = $request->name;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->user_as_clinic_id = $clinic->id;
            $service->save();

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


            return response()->json(['message' => request('name') . ' added successfully', 'keys' => $service]);
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

        $services = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $current_ids = $id; //Gettinng string of ids
        $array_ids = explode(',', $current_ids); //splitting string into sepratae string using the comma

        return response()->json(['ids' => json_encode($array_ids), 'services' =>  $services]);
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

        $services = Clinic_services::where('id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->first();

        $get_packages_id = Packages_has_services::where('clinic_services_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        if (count($get_packages_id) > 0) {
            foreach ($get_packages_id as $key) {
                $packages[] = Packages::where('id', '=',  $key->packages_id)
                    ->where('user_as_clinic_id', '=',  $clinic->id)
                    ->get();
            }
            return response()->json(['services' => $services, 'packages' => $packages]);
        } else {
            return response()->json(['services' => $services]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

            $service_last_name = Clinic_services::find($id);

            $service = Clinic_services::find($id);
            $service->name = request('name');
            $service->price = request('price');
            $service->description = request('description');
            $service->save();

            //creating logs
            if (!($service_last_name->name == request('name'))) {
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
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

            if (!($service_last_name->price == request('price'))) {
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
                //checking logs limit 5000
                if ($logs_count == 5000) {
                    Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
                }
                $logs = new Logs();
                $logs->message = $service_last_name->name . '\'s price: "' . $service_last_name->price . '"' . " has changed into " . '"' . request('price') . '".';
                $logs->remark = "warning";
                $logs->date =  date("Y/m/d");
                $logs->time = date("h:i:sa");
                $logs->user_as_clinic_id = $clinic->id;
                $logs->save();
            }

            if (!($service_last_name->description == request('description'))) {
                $logs_count = Logs::where('user_as_clinic_id', '=',  $user->id)->count();
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

        //removing service from every packages
        $get_packages_id = Packages_has_services::where('clinic_services_id', '=',  $id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->get();

        foreach ($get_packages_id as $key) {
            Packages_has_services::where('packages_id', '=',  $key->packages_id)
                ->where('clinic_services_id', '=',  $id)
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

        return response()->json(['message' => 'Service Deleted!']);
    }
}
