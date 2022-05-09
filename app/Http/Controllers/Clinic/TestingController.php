<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Clinic_equipment_inventory;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Clinic_specialists;
use App\Models\Clinic_types;
use Illuminate\Http\Request;

use App\Models\User_address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\Logs;
use App\Models\Messages;
use App\Models\Packages;
use App\Models\Ratings;
use App\Models\Services_has_equipments;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_inventory = Clinic_equipment_inventory::where("clinic_equipments_id",  4)->get();

        $expiration_month = date("Y-m", strtotime($get_inventory[0]->expiration));

        echo $expiration_month;
        // return view('adminViews.layouts.clinic.clinicAcceptMessage',);

        // $todelete = Clinic_types::findOrFail(3);
        // $todelete->delete();

        // echo "deleted na ssob";

        // //getting all dates in range
        // function getBetweenDates($startDate, $endDate)
        // {
        //     $rangArray = [];

        //     $startDate = strtotime($startDate);
        //     $endDate = strtotime($endDate);

        //     for (
        //         $currentDate = $startDate;
        //         $currentDate <= $endDate;
        //         $currentDate += (86400)
        //     ) {

        //         $date = date('Y-m-d', $currentDate);
        //         $rangArray[] = $date;
        //     }

        //     return $rangArray;
        // }

        // $dates = getBetweenDates("2022-04-05", "2022-04-12");


        // //getting equipments of this clinic
        // $equipmetns = Clinic_equipments::where('user_as_clinic_id', '=',  1)
        //     ->get();

        // //setting consumable names in one array
        // foreach ($equipmetns as $key) {
        //     $consumables[] = $key->name;
        // }

        // foreach ($dates  as $key) {
        //     $this_date = $key;

        //     $this_billing = Billings::where('user_as_clinic_id', '=',  1)
        //         ->where('created_at', 'LIKE', '%' . $key . '%')
        //         ->get();

        //     if (count($this_billing) > 0) {

        //         foreach ($this_billing as $kk) {
        //             if (isset($kk->materials_summary)) {
        //                 $exploded_materials = explode(",", $kk->materials_summary);
        //                 // echo $kk->created_at;
        //                 // echo json_encode($exploded_materials);
        //                 // echo "<br><br>";
        //                 foreach ($exploded_materials as $kmat) {
        //                     $this_material[] =  $kmat;
        //                 }
        //             }
        //         }

        //         //cpunt duplicates
        //         if (isset($this_material)) {
        //             $all_material = array_filter(array_count_values($this_material), function ($v) {
        //                 return $v > 0;
        //             });

        //             //array_push($all_material, "date" => $this_date);
        //             // $all_material['date'] = $this_date;

        //             // echo json_encode($all_material);


        //             // echo "<br><br>";

        //             // $daily_report[] =  $all_material;
        //         }





        //         // finalizing data
        //         if (isset($all_material)) {
        //             foreach ($all_material as $key => $value) {
        //                 $materials_summary[] = (object) array(
        //                     'name' => $key,
        //                     'count' => $value,
        //                 );
        //             }
        //             $daily_report_date[] = $this_date;
        //             $daily_report[] =  $materials_summary;
        //         }
        //     }


        //     // echo  $this_billing;
        //     // echo "<br>";
        //     // echo "<br>";
        // }


        // // echo json_encode($daily_report_date);
        // // echo json_encode($daily_report);

        // for ($i = 0; $i < count($daily_report_date); $i++) {
        //     echo "Date: " . $daily_report_date[$i];
        //     echo "<br>";
        //     foreach ($daily_report[$i] as $key) {
        //         echo "Name: " . $key->name . "| Count: " . $key->count;
        //         echo "<br>";
        //     }


        //     echo "<br><br>";
        // }



        // foreach ($daily_report[1] as $key => $value) {
        //     echo $key . ":" . $value;
        // }


        // $user = User::where('email', '=',  Auth::user()->email)->first();
        // $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        // $specialists = Clinic_specialists::where('user_as_clinic_id', '=', $clinic->id)->get();
        // if (count($specialists) == 0) {
        //     echo "walang laman";
        // } else {
        //     echo "nag else";
        // }

        // $all_equipments = Clinic_equipments::where("user_as_clinic_id",  $clinic->id)->get();
        // $logs_count = Logs::where('user_as_clinic_id', '=', $clinic->id)->count();

        // foreach ($all_equipments as $key) {
        //     $get_inventory = Clinic_equipment_inventory::where("clinic_equipments_id",  $key->id)->get();

        //     //FOR MONTH COMPARISON || PRODUCTION
        //     foreach ($get_inventory as $k) {

        //         //TAKE NOT comparing YEAR & MONTH only
        //         $expiration_day = date("Y-m", strtotime("-1 day", strtotime($k->expiration)));
        //         $expiration_month = date("Y-m", strtotime("-1 month", strtotime($k->expiration)));
        //         $curdate = date('Y-m');
        //         if ($expiration_month  == $curdate) {
        //             //expiration notif logic
        //             if ($k->notify != "done") {
        //                 $up_inventory = Clinic_equipment_inventory::find($k->id);
        //                 $up_inventory->notify =  "done";
        //                 $up_inventory->save();

        //                 //checking logs limit 5000
        //                 if ($logs_count == 5000) {
        //                     Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
        //                 }
        //                 $logs = new Logs();
        //                 $logs->message = "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has more or less a month left. Please be informed that after the expiration date, the system will automatically remove it to your inventory.";
        //                 $logs->remark = "notif";
        //                 $logs->date =  date("Y/m/d");
        //                 $logs->time = date("h:i:sa");
        //                 $logs->user_as_clinic_id = $clinic->id;
        //                 $logs->save();
        //             }
        //         }
        //     }

        //     // //FOR DAY COMPARISON || TESTING PURPOSES
        //     // foreach ($get_inventory as $k) {
        //     //     $expiration_day = date("Y-m-d", strtotime("-1 day", strtotime($k->expiration)));
        //     //     $expiration_month = date("Y-m-d", strtotime("-1 month", strtotime($k->expiration)));
        //     //     $curdate = date('Y-m-d');
        //     //     if ($expiration_day  == $curdate) {
        //     //         //expiration notif logic
        //     //         if ($k->notify != "done") {
        //     //             $up_inventory = Clinic_equipment_inventory::find($k->id);
        //     //             $up_inventory->notify =  "done";
        //     //             $up_inventory->save();

        //     //             //checking logs limit 5000
        //     //             if ($logs_count == 5000) {
        //     //                 Logs::where('user_as_clinic_id', '=',  $user->id)->first()->delete();
        //     //             }
        //     //             $logs = new Logs();
        //     //             $logs->message = "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has a month left. Please be informed that after the expiration date, the system will automatically remove it to your inventory.";
        //     //             $logs->remark = "notif";
        //     //             $logs->date =  date("Y/m/d");
        //     //             $logs->time = date("h:i:sa");
        //     //             $logs->user_as_clinic_id = $clinic->id;
        //     //             $logs->save();

        //     //             echo $logs->message;
        //     //         }

        //     //         // echo "notify user <br>";
        //     //         // echo $key . " <br>";
        //     //         // echo $k . " <br>";
        //     //     } else {
        //     //         echo "walang mangyayare<br>";
        //     //     }
        //     // }
        // }

        // $date = date('Y-m');
        // $date2 = date('Y-m', strtotime("2022-04-07 00:00:00"));
        // echo $date;
        // echo "<br>";
        // echo  date("Y-m", strtotime("-1 month", strtotime($date)));
        // echo "<br>";

        // if ($date == $date2) {
        //     echo "nag true";
        // } else {
        //     echo "nag false";
        // }


        // echo $all_equipments;



        // $services = Clinic_services::all(['name']);
        // foreach ($services as $key) {
        //     $services_array[] = $key->name;
        // }

        // //get price summary in billing first CHANGE ID TO USER ID
        // $billing_summary = Billings::where('user_as_clinic_id', 1)->get(['price_summary']);

        // foreach ($billing_summary as $key) {
        //     $this_summary = explode(",", $key->price_summary);

        //     foreach ($this_summary as $k) {
        //         $this_summary_2nd = explode(":", $k);

        //         // echo $this_summary_2nd[0];
        //         // echo "<br><br>";

        //         if (in_array($this_summary_2nd[0], $services_array)) {
        //             // echo "PASOK sa if";
        //             $counter = 1;

        //             if (isset($services_stats)) {
        //                 foreach ($services_stats as $kk) {

        //                     if ($kk->name == $this_summary_2nd[0]) {
        //                         $kk->count++;
        //                     } else if (count($services_stats) == $counter) {
        //                         $services_stats[] = (object) array(
        //                             'name' => $this_summary_2nd[0],
        //                             'count' => 1,
        //                         );
        //                     }

        //                     $counter++;
        //                 }
        //             } else {

        //                 $services_stats[] = (object) array(
        //                     'name' => $this_summary_2nd[0],
        //                     'count' => 1,
        //                 );
        //             }
        //         }
        //     }
        // }


        // echo json_encode($services_stats);





        // $clinics = DB::table('ratings')->distinct()->get(['users_id_ratee']); //root id used
        // foreach ($clinics as $key) {
        //     if ($key->users_id_ratee == 1) {
        //         //para sa buong system to
        //     } else {
        //         //para sa clinics and shit

        //         $clinic_info = User_as_clinic::where('users_id', '=', $key->users_id_ratee)->first();
        //         $thisclinic_avg = Ratings::where('users_id_ratee', '!=', 1)->where('users_id_ratee', '=', $key->users_id_ratee)->avg('rating');
        //         $this_clinic_type = Clinic_types::where('id', '=', $clinic_info->clinic_types_id)->first();

        //         $clinic_complete[] = (object) array(
        //             "root_id" => $key->users_id_ratee,
        //             "clinic_id" =>  $clinic_info->id,
        //             "name" => $clinic_info->name,
        //             "type" => $this_clinic_type->type_of_clinic,
        //             "avg" => $thisclinic_avg,

        //         );
        //     }
        // }
        // echo json_encode($clinic_complete);

        // echo (Messages::whereIn('receiver', ['all', 'patient'])->get());

        // $sequipments = new Services_has_equipments();
        // $sequipments->clinic_services_id = 3;
        // $sequipments->clinic_equipments_id = 4;
        // $sequipments->user_as_clinic_id = 3;
        // $sequipments->save();

        // $clinic = User_as_clinic::all();
        // $service = Clinic_services::all();
        // $equip = Clinic_equipments::all();


        // foreach ($clinic as $key) {
        //     echo $key;
        //     echo "<br>";
        // }

        // echo "<br><br>";


        // foreach ($service as $key) {
        //     echo $key;
        //     echo "<br>";
        // }

        // echo "<br><br>";


        // foreach ($equip as $key) {
        //     echo $key;
        //     echo "<br>";
        // }

        // echo "<br><br>";


        // $getID_myequipments = Services_has_equipments::all();

        // $sequipments = new Services_has_equipments();
        // $sequipments->clinic_services_id = 1;
        // $sequipments->clinic_equipments_id = 1;
        // $sequipments->user_as_clinic_id = 1;
        // $sequipments->save();

        // echo $getID_myequipments;

        //return view('clinicViews.testing.index');

        //para kay lags, para less query loading
        //return User_address::get(['latitude', 'longitude']);



        // if (Logs::where('user_as_clinic_id', '=',  1)->count() == 1000) {
        //     Logs::where('user_as_clinic_id', '=',  1)->first()->delete();
        // }

        //return Logs::where('user_as_clinic_id', '=',  1)->count();
        // $details = [
        //     'title' => 'Mr Jams Title of Email',
        //     'body' => 'Message to ng email',
        // ];

        // $recipient = "ragunayon@gmail.com";

        // Mail::to($recipient)->send(new EmailNotification($details));
        // return "Email Sent";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $clinics = User_as_clinic::all();

        // $clinics_add = User_address::get(['id', 'latitude', 'longitude']);

        // // $data = User::select(DB::('count(id) as total'), DB::raw('MONTH(created_at) month'))
        // //     ->groupby('month')
        // //     ->orderBy('created_at', 'asc')
        // //     ->get();

        // // foreach ($clinics as $clinic) {
        // //     $temp = User_address::where('user_as_clinic_id', '=', $clinic->id)
        // // }


        // // foreach ($clinics as $clinic) {
        // //     // $package[] = Packages::where('user_as_clinic_id', '=', $clinic->id)
        // //     //     ->get();
        // // }

        // return response()->json(['clinic_add' => $clinics_add]);


        $user = User::where('email', '=',  "laravelmovie@gmail.com")->first();
        $customer = User_as_customer::where('id', '=', $user->id)->get();

        // $customer_add_table = User_address::all();
        $customer_add = User_address::where('id', '=', $customer[0]->user_address_id)->get();

        // echo($customer->user_address_id);
        //echo ($customer[0]->user_address_id);
        echo ($customer_add);
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
        $address = User_address::where('id', '=',  $id)
            ->get();
        return response()->json(['address' => $address]);
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
