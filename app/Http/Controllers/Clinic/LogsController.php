<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Clinic_equipment_inventory;
use App\Models\Clinic_equipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\Logs;
use App\Models\Packages_has_equipments;
use App\Models\Ratings;
use App\Models\Services_has_equipments;
use App\Models\User_address;
use Illuminate\Support\Facades\Mail;

class LogsController extends Controller
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
        $data = Logs::where('user_as_clinic_id', '=',  $clinic->id)->orderBy('id', 'desc')->get();
        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        return view('clinicViews.logs.index', ['data' => $data, 'logs' => $logs]);
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
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=', $clinic->id)->count();

        $rate = Ratings::where('users_id_ratee', '=', $user->id)->pluck('rating')->avg();

        //for notification
        if ($id == 0) {

            //FOR EXPIRATION DATE OF MATERIALS
            $all_equipments = Clinic_equipments::where("user_as_clinic_id",  $clinic->id)->get();
            foreach ($all_equipments as $key) {
                $get_inventory = Clinic_equipment_inventory::where("clinic_equipments_id",  $key->id)->get();

                //FOR MONTH COMPARISON || PRODUCTION
                foreach ($get_inventory as $k) {

                    //TAKE NOT comparing YEAR & MONTH only
                    $expiration_day = date("Y-m", strtotime("-1 day", strtotime($k->expiration)));
                    $expiration_month = date("Y-m", strtotime("-1 month", strtotime($k->expiration)));

                    $expiration_day_exact = date("Y-m-d", strtotime($k->expiration));
                    $expiration_month_exact = date("Y-m", strtotime($k->expiration));

                    $curdate = date('Y-m');

                    $curdate_exact = date('Y-m-d');

                    //Checking Expiration || Notif
                    if ($curdate >= $expiration_month) {
                        //expiration notif logic
                        if ($k->notify != "done") {
                            $up_inventory = Clinic_equipment_inventory::find($k->id);
                            $up_inventory->notify =  "done";
                            $up_inventory->save();

                            //checking logs limit 5000
                            if ($logs_count == 5000) {
                                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                            }
                            $logs = new Logs();
                            $logs->message = "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has more or less a month left. Please be informed that after the expiration date, the system will automatically remove it to your inventory.";
                            $logs->remark = "notif";
                            $logs->date =  date("Y/m/d");
                            $logs->time = date("h:i:sa");
                            $logs->user_as_clinic_id = $clinic->id;
                            $logs->save();
                        }
                    }

                    //Deleting || Removing Logic EXACT DATE
                    if ($curdate_exact == $expiration_day_exact) {
                        //expiration notif logic
                        if ($k->notify == "done") {
                            $up_inventory = Clinic_equipment_inventory::find($k->id);
                            $up_inventory->quantity =  0;
                            $up_inventory->save();
                        }

                        $recount = Clinic_equipment_inventory::where("clinic_equipments_id",  $key->id)->get();
                        $quant_count = 0;

                        foreach ($recount as $sana_all) {
                            if ($sana_all->quantity) {
                                $quant_count = $sana_all->quantity +  $quant_count;
                            }
                        }

                        $equipment = Clinic_equipments::find($k->clinic_equipments_id);
                        $equipment->quantity = $quant_count;
                        $equipment->save();

                        //checking logs limit 5000
                        if ($logs_count == 5000) {
                            Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                        }
                        $logs = new Logs();
                        $logs->message = "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has expired.";
                        $logs->remark = "danger";
                        $logs->date =  date("Y/m/d");
                        $logs->time = date("h:i:sa");
                        $logs->user_as_clinic_id = $clinic->id;
                        $logs->save();

                        //checking logs limit 5000
                        if ($logs_count == 5000) {
                            Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                        }
                        $logs = new Logs();
                        $logs->message = "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has expired.";
                        $logs->remark = "notif";
                        $logs->date =  date("Y/m/d");
                        $logs->time = date("h:i:sa");
                        $logs->user_as_clinic_id = $clinic->id;
                        $logs->save();

                        //sending email notification
                        $details = [
                            'clinic' => $clinic->name,
                            'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                            'contact' => $clinic->phone,
                            'title' => 'Expired Stock',
                            'body' => "Your stock of " . $key->name . " with expiration date of " . date('M d, Y', strtotime($k->expiration)) . " has expired.",
                        ];
                        Mail::to(Auth::user()->email)->send(new EmailNotification($details));
                    }
                }
            }



            $notif = Logs::where('user_as_clinic_id', '=',  $clinic->id)
                ->whereIn('remark', ["notif", "done_notif"])
                ->limit(15)
                ->orderBy('id', 'desc')
                ->get();

            $notif_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('remark', '=', "notif")
                ->get();

            return response()->json([
                'data' => $notif ?? "",
                'notif_count' =>  $notif_count ?? "",
                "rate" => $rate,
                "clinic" => $clinic,
            ]);
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

        if ($id == 0) {
            $logs_id = Logs::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('remark', '=', "notif")
                ->get(["id"]);

            foreach ($logs_id  as $key) {
                $logs = Logs::find($key->id);
                $logs->remark =  "done_notif";
                $logs->save();
            }

            return response()->json([
                'tester' => "success"
            ]);
        }
    }
}
