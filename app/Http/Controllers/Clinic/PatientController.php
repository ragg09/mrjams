<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Clinic_services;
use App\Models\Clinic_specialists;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Receipt_orders;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
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

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        //getting customers from receipts
        $ro = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)->distinct()->get(['user_as_customer_id']);

        //echo $ro;

        foreach ($ro as $key) {
            $customer = User_as_customer::where('id', $key->user_as_customer_id)->first();
            $root_customer = User::where('id', $customer->users_id)->first();
            $address = User_address::where('id', $customer->user_address_id)->first();

            $customers[] = (object) array(
                "id" => $customer->id,
                "email" => $root_customer->email,
                "avatar" => $root_customer->avatar,
                "name" => $customer->fname . " " . $customer->lname,
            );
        }

        // echo  json_encode($customers);

        if (!isset($customers)) {
            $customers = [];
        }

        return view('clinicViews.patient.index', compact('customers', 'logs'));
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
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'request' => $request->all()]);
        } else {

            //checking logs limit 5000
            $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();

            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }
            //creating logs
            $logs = new Logs();
            $logs->message = "You have sent an email to " . $request->name;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            //sending email notification
            $details = [
                'clinic' => $clinic->name,
                'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                'contact' => $clinic->phone,
                'title' => $request->title,
                'body' => $request->message,
            ];
            // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            Mail::to($request->email)->send(new EmailNotification($details));

            return response()->json([
                'tester' => $request->all(),
                'message' => "you have sent email to " . $request->name,
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

        $customer = User_as_customer::where('id', $id)->first();
        $root_customer = User::where('id', $customer->users_id)->first();
        $address = User_address::where('id', $customer->user_address_id)->first();

        $this_ro = Receipt_orders::where("user_as_clinic_id", $clinic->id)
            ->where("user_as_customer_id", $customer->id)
            ->get();

        foreach ($this_ro as $key) {
            $this_app = Appointments::where("receipt_orders_id", $key->id)
                ->first();

            //done
            if ($this_app->appointment_status_id == 1) {
                $done_app[] = $this_app;
            }

            //upcoming
            if ($this_app->appointment_status_id == 4) {
                $upcoming_app[] = $this_app;
            }
        }

        if (isset($done_app)) {
            foreach ($done_app as $key) {
                $this_ro = Receipt_orders::where("id", $key->receipt_orders_id)->first();
                $services_packacges = [];

                $this_services = Receipt_orders_has_clinic_services::where("receipt_orders_id", $key->receipt_orders_id)->get();

                // getting service
                foreach ($this_services as $k) {
                    $service = Clinic_services::where("id", $k->clinic_services_id)->first();

                    array_push($services_packacges, $service->name);
                }

                //getting package
                if (!$this_ro->packages_id == null) {
                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                    array_push($services_packacges, $this_package->name);
                }

                //getting specialist if any
                if (!$this_ro->specialist_id == null) {
                    $this_specialist = Clinic_specialists::where("id", $this_ro->specialist_id)->first();
                }

                $treatment = implode(", ", $services_packacges);

                $done_app_complete[] = (object) array(
                    "date" => $key->appointed_at,
                    "specialist" => $this_specialist->fullname ?? "Not mentioned",
                    "treatment" => $treatment,
                );
            }
        }

        if (isset($upcoming_app)) {
            foreach ($upcoming_app as $key) {
                $this_ro = Receipt_orders::where("id", $key->receipt_orders_id)->first();
                $services_packacges = [];

                $this_services = Receipt_orders_has_clinic_services::where("receipt_orders_id", $key->receipt_orders_id)->get();

                // getting service
                foreach ($this_services as $k) {
                    $service = Clinic_services::where("id", $k->clinic_services_id)->first();

                    array_push($services_packacges, $service->name);
                }

                //getting package
                if (!$this_ro->packages_id == null) {
                    $this_package = Packages::where("id", $this_ro->packages_id)->first();

                    array_push($services_packacges, $this_package->name);
                }

                //getting specialist if any
                if (!$this_ro->specialist_id == null) {
                    $this_specialist = Clinic_specialists::where("id", $this_ro->specialist_id)->first();
                }

                $treatment = implode(", ", $services_packacges);

                $upcoming_app_complete[] = (object) array(
                    "date" => $key->appointed_at,
                    "specialist" => $this_specialist->fullname ?? "Not mentioned",
                    "treatment" => $treatment,
                );
            }
        }





        if (!isset($done_app_complete)) {
            $done_app_complete = [];
        }

        if (!isset($upcoming_app_complete)) {
            $upcoming_app_complete = [];
        }

        // echo json_encode($upcoming_app_complete);

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('clinicViews.patient.details', [
            "customer" => $customer,
            "root_customer" => $root_customer,
            "address" => $address,
            "done_app" =>  $done_app ?? [],
            "upcoming_app" => $upcoming_app ?? [],
            "done_app_complete" => $done_app_complete,
            "upcoming_app_complete" => $upcoming_app_complete,
            "logs" => $logs,
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
