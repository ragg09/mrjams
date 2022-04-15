<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Clinic_auto_scheduling;
use App\Models\Clinic_specialists;
use App\Models\Clinic_time_availability;
use App\Models\Logs;
use App\Models\Receipt_orders;
use App\Models\User_address;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_as_clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClinicSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['check_user', 'role_clinic'])->except(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $address = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $specialists = Clinic_specialists::where('user_as_clinic_id', '=',  $clinic->id)->get();

        $general =  (object) array(
            'id' => $clinic->id,
            'name' => $clinic->name,
            'phone' => $clinic->phone,
            'telephone' => $clinic->telephone,
            'address_line_1' => $address->address_line_1,
            'address_line_2' => $address->address_line_2,
            'city' => $address->city,
            'zip_code' => $address->zip_code,
            'latitude' => $address->latitude,
            'longitude' => $address->longitude,
        );


        $availability_data = Clinic_time_availability::where('user_as_clinic_id', '=',  $clinic->id)->first();

        $split_data = explode("&", $availability_data->summary);
        $count = 0;
        foreach ($split_data as $key) {
            $this_data = explode("*", $key);
            $count++;
            $availability[] = (object) array(
                "day" => $this_data[0],
                "min" => $this_data[1],
                "max" =>  $this_data[2],
                "status" =>  $this_data[3],
                "count" =>  $count,
            );
        }



        $auto_sched = Clinic_auto_scheduling::where('user_as_clinic_id', '=',  $clinic->id)->first();

        $auto_fill_date = $auto_sched->auto_fill_date;
        $auto_accept = $auto_sched->auto_accept;

        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
        $days_full = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];
        $auto_sched_summary = $auto_sched->summary;

        $summary_explode = explode("&", $auto_sched_summary);

        $day_count = 0;
        foreach ($days as $keys) {
            $this_summary = explode("*", $summary_explode[$day_count]);
            $auto_sched_day_status[] = $this_summary[0]; // status each day
            $auto_sched_data_[$keys] = str_split($this_summary[1], 1);
            $auto_sched_data_all[] =  $auto_sched_data_[$keys];
            $day_count++;
        }



        //echo json_encode($auto_sched_data_all);

        // foreach ($days as $keys) {


        //     $this_day = explode("&", $auto_sched->$keys);

        //     $auto_sched_day_status[] = $this_day[0]; //return
        //     $cc = 0;
        //     foreach (array_slice($this_day, 1) as $key) {
        //         $cc++;
        //         $this_data = explode("*", $key);
        //         $auto_sched_data_[$keys][] = (object) array(
        //             "time" => $this_data[0],
        //             "time_status" => $this_data[1],
        //             "count" =>  $cc,
        //         );
        //         // array_push($auto_sched_data_mon, (object) array(
        //         //     "time" => $this_data[0],
        //         //     "time_status" => $this_data[1],
        //         //     "count" =>  $cc,
        //         // ));
        //     }

        //     $auto_sched_data_all[] =  $auto_sched_data_[$keys];
        // }

        // echo json_encode($auto_sched_data_all[0][10]);

        // foreach (array_slice($auto_sched_mon, 1) as $key) {
        //     $cc_mon++;
        //     $this_data = explode("*", $key);
        //     $auto_sched_mon_data[] = (object) array(
        //         "time" => $this_data[0],
        //         "time_status" => $this_data[1],
        //         "count" =>  $cc_mon,
        //     );
        // }

        //echo json_encode($auto_sched_mon_data);.


        //$string = str_split("ABBCCCDDDDEEEEE", 1);
        // $count_occurence = 0;
        // $cur_letter = "";
        // $summary = "";
        // foreach ($string as $key) {



        //     if ($cur_letter == "" || $cur_letter == $key) {
        //         $count_occurence++;
        //         $cur_letter = $key;
        //     } else {
        //         $count_occurence++;
        //         $summary = $summary .  $cur_letter . "" . $count_occurence;
        //         $count_occurence = 0;
        //         $cur_letter = $key;
        //         echo ($key);
        //     }

        // if ($cur_letter == "") {
        //     $count_occurence++;
        //     $cur_letter = $key;
        // } else {
        //     if ($cur_letter == $key) {
        //         $count_occurence++;
        //         $cur_letter = $key;
        //     } else {
        //         // if ($count_occurence == 0) {
        //         //     $count_occurence = 1;
        //         // }
        //         $count_occurence++;

        //         $summary = $summary .  $cur_letter . "" . $count_occurence;
        //         // $trytry[] = (object) array(
        //         //     $cur_letter =>  $count_occurence,
        //         // );
        //         $count_occurence = 0;
        //         $cur_letter = $key;
        //     }
        // }
        //}

        // echo json_encode($summary);

        // echo ($summary);

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view(
            'clinicViews.settings.index',
            compact(
                'clinic',
                'address',
                'general',
                'specialists',
                'availability',
                'days',
                'days_full',
                'auto_fill_date',
                'auto_accept',
                'auto_sched_day_status',
                'auto_sched_data_all',
                'logs'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json(['message' => $request->all()]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'phone' => 'required|numeric|min:11',
            'telephone' => 'nullable|numeric',
            'address_line_1' => 'required|min:2',
            'address_line_2' => 'required|min:2',
            'city' => 'required|min:2',
            'zip_code' => 'required|numeric',
            'clinic_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $address = new User_address();
            $address->address_line_1 = request('address_line_1');
            $address->address_line_2 = request('address_line_2');
            $address->city = request('city');
            $address->zip_code = request('zip_code');
            $address->latitude = request('latitude');
            $address->longitude = request('longitude');
            $address->save();

            $user_table = User::where('email', '=',  Auth::user()->email)->first();

            $user =  User::find($user_table->id);
            $user->role =  request('role');
            $user->status =  "verifying"; //for verification purposes
            $user->save();




            $clinic = new User_as_clinic();
            $clinic->name = strtoupper(request('name'));
            $clinic->phone = request('phone');
            $clinic->telephone = request('telephone');
            $clinic->users_id = $user_table->id;
            $clinic->clinic_types_id =  request('clinic_type_id');
            $clinic->user_address_id = $address->id;
            $clinic->save();

            $logs = new Logs();
            $logs->message = "Welcome to MRJAMS";
            $logs->remark = "notif";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            $availability = new Clinic_time_availability();
            $availability->user_as_clinic_id = $clinic->id;
            $availability->summary = "Sunday*08:00*17:00*on&Monday*08:00*17:00*on&Tuesday*08:00*17:00*on&Wednesday*08:00*17:00*on&Thursday*08:00*17:00*on&Friday*08:00*17:00*on&Saturday*08:00*17:00*on";
            $availability->save();

            //AUTO ACCEPT FOR FUTURE CONCEPT
            $auto_sched = new Clinic_auto_scheduling();
            $auto_sched->auto_fill_date = "off";
            $auto_sched->auto_accept = "off";
            $auto_sched->summary = "off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx&off*xxxxxxxxxxxxxxxxxxxxxxxx";
            $auto_sched->user_as_clinic_id = $clinic->id;
            $auto_sched->save();

            // //checking logs limit 5000
            // if(Logs::all()->count() == 5000){
            //     Logs::all()->first()->delete();
            // }
            // //creating logs
            // $logs = new Logs();
            // $logs->message = '"'. request('name').'"'." has been added to the equipments.";
            // $logs->remark = "success";
            // $logs->date =  date("Y/m/d");
            // $logs->time = date("h:i:sa");
            // $logs->save();


            // return response()->json(['message' => request('name').' added successfully', 'keys' => $equipment]);

            return response()->json(['message' => "Succesful"]);
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        //used to retrieve data for update purpose
        //+
        //showing the availability in accept modal of appointment
        if (strpos($id, "specialist")) {
            $getid = explode("_", $id);

            $get_ro_id = Receipt_orders::where("specialist_id", $getid[0])->get(['id']);

            if (count($get_ro_id) > 0) {
                foreach ($get_ro_id as $key) {
                    $this_app = Appointments::where('receipt_orders_id', $key->id)
                        ->where('appointment_status_id', 4)
                        ->first();

                    if ($this_app) {
                        $app_datetime[] = (object) array(
                            "datetime" => $this_app->appointed_at . " " . $this_app->time,
                            "date" => $this_app->appointed_at,
                            "time" => $this_app->time,

                        );
                    }

                    $this_nego = Appointments::where('receipt_orders_id', $key->id)
                        ->where('appointment_status_id', 5)
                        ->first();

                    if ($this_nego) {
                        $nego_datetime[] = (object) array(
                            "datetime" => $this_nego->appointed_at . " " . $this_nego->time,
                            "date" => $this_nego->appointed_at,
                            "time" => $this_nego->time,

                        );
                    }
                }
            }


            $specialists = Clinic_specialists::where('id', '=',  $getid[0])
                ->where('user_as_clinic_id', '=',  $clinic->id)
                ->first();

            return response()->json([
                // 'message' => 'Time Availability Updated Succesfully',
                'tester' => $id,
                'specialist' => $specialists,
                'specialist_appointments' => $app_datetime ?? "",
                'specialist_nego' => $nego_datetime ?? "",
                'testet' => $app_datetime ?? "",
            ]);
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

        if ($request->role == "general") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2',
                'phone' => 'required|numeric',
                'telephone' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $this_clinic = User_as_clinic::find($id);
                $this_clinic->name = $request->name;
                $this_clinic->phone = $request->phone;
                $this_clinic->telephone = $request->telephone;
                $this_clinic->save();

                $this_address = User_address::find($this_clinic->user_address_id);
                $this_address->address_line_1 = $request->address_line_1;
                $this_address->address_line_2 = $request->address_line_2;
                $this_address->city = $request->city;
                $this_address->zip_code = $request->zip_code;
                $this_address->latitude = $request->lat;
                $this_address->longitude = $request->lon;
                $this_address->save();
            }

            return response()->json(['data' => $this_address]);
        }



        if (strpos($id, "time")) {
            $getid = explode("_", $id);

            for ($x = 1; $x <= 7; $x++) { //0 - 6
                $day = "day" . (string)$x;
                $min = "min_time" . (string)$x;
                $max = "max_time" . (string)$x;
                $stat = "status" . (string)$x;


                $days[] = $request->$day;
                $mins[] = $request->$min;
                $maxs[] = $request->$max;

                if ($request->$stat == "on") {
                    $stats[] = "on";
                } else {
                    $stats[] = "off";
                }
            }

            $summary = "";
            $separator = "&";
            for ($x = 0; $x <= 6; $x++) { //0 - 6
                if ($x == 6) {
                    $separator = "";
                }

                $summary = $summary . $days[$x] . "*" . $mins[$x] . "*" . $maxs[$x] . "*" . $stats[$x] . $separator;
            }

            $availability = Clinic_time_availability::find($getid[0]);
            $availability->summary = $summary;
            $availability->save();



            return response()->json([
                'message' => 'Time Availability Updated Succesfully',
            ]);
        }

        if (strpos($id, "AddSpecialists")) {
            $getid = explode("_", $id);

            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'specialization' => 'required',
                'min_time' => 'required',
                'max_time' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $specialists = new Clinic_specialists();
                $specialists->fullname = $request->fullname;
                $specialists->specialization = $request->specialization;
                $specialists->min_time = $request->min_time;
                $specialists->max_time = $request->max_time;
                $specialists->user_as_clinic_id = $getid[0];
                $specialists->save();

                return response()->json([
                    'message' => 'Specialist Added',
                    //'tester' => $getid,
                ]);
            }
        }

        if (strpos($id, "EditSpecialists")) {
            $getid = explode("_", $id);

            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'specialization' => 'required',
                'min_time' => 'required',
                'max_time' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $specialists = Clinic_specialists::find($getid[0]);
                $specialists->fullname = $request->fullname;
                $specialists->specialization = $request->specialization;
                $specialists->min_time = $request->min_time;
                $specialists->max_time = $request->max_time;
                $specialists->save();

                return response()->json([
                    'message' => 'Specialist Name Updated Successfully',
                ]);
            }
        }

        if (strpos($id, "EditAutoSched")) {
            $getid = explode("_", $id);
            $auto_sched = Clinic_auto_scheduling::where('user_as_clinic_id', '=', $getid[0])->first();
            $auto_sched->auto_fill_date = $request->auto_fill_date;
            $auto_sched->auto_accept = $request->auto_accept;
            $auto_sched->summary = $request->auto_summary;
            $auto_sched->save();

            // $this_day = $request->day_name;
            // $time = "timepicker_" . $this_day;
            // $new_data = $auto_sched->$this_day . "&" . $request->$time . "*off";

            return response()->json([
                'message' => 'Auto Scheduling Settings Updated!',
                'tester' => $request->all(),
            ]);
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
        if (strpos($id, "DeleteSpecialists")) {
            $getid = explode("_", $id);

            $service = Clinic_specialists::findOrFail($getid[0]);
            $service->delete();

            return response()->json([
                'message' => 'Specialist Deleted',
            ]);
        }
    }
}
