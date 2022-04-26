<?php

namespace App\Http\Controllers\Clinic;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Billings_history;
use App\Models\Clinic_equipment_inventory;
use App\Models\Clinic_equipments;
use App\Models\Clinic_services;
use App\Models\Customer_logs;
use App\Models\Logs;
use App\Models\Packages;
use App\Models\Packages_has_equipments;
use App\Models\Receipt_orders;
use App\Models\Receipt_orders_has_clinic_services;
use App\Models\Services_has_equipments;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $bill_status = "";

        $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();



        if ($request->SortBy) {
            if ($request->SortBy == "balance") {
                $bills = Billings::where('user_as_clinic_id', '=',  $clinic->id)
                    ->where('balance', '>',  0)
                    ->orderBy('id', 'desc')
                    ->get();

                foreach ($bills as $key) {

                    $this_customer = User_as_customer::where('id', '=',  $key->user_as_customer_id)->first();
                    $this_root_customer = User::where('id', '=',  $this_customer->users_id)->first();

                    $customers[] = (object) array(
                        "id" =>  $this_customer->id,
                        "avatar" =>  $this_root_customer->avatar,
                        "name" =>  $this_customer->fname . " " . $this_customer->lname,
                        "email" =>  $this_root_customer->email,
                        "total" => $key->total_paid +  $key->balance,
                        "paid" =>  $key->total_paid,
                        "balance" => $key->balance,
                        "created_at" => $key->created_at,
                        "updated_at" =>  $key->updated_at,
                        "bill_id" => $key->id,
                        "ro_id" =>  $key->receipt_orders_id,

                    );
                    $bill_status = "ok";
                }

                if (isset($customers)) {
                    return view(
                        'clinicViews.billing.index',
                        compact([
                            'bills',
                            'customers',
                            'bill_status',
                            'logs',
                        ])
                    );
                } else {
                    return view(
                        'clinicViews.billing.index',
                        compact([
                            'bill_status',
                            'logs',
                        ])
                    );
                }
            }

            if ($request->SortBy == "paid") {
                $bills = Billings::where('user_as_clinic_id', '=',  $clinic->id)
                    ->where('balance', '=',  0)
                    ->orderBy('id', 'desc')
                    ->get();

                foreach ($bills as $key) {

                    $this_customer = User_as_customer::where('id', '=',  $key->user_as_customer_id)->first();
                    $this_root_customer = User::where('id', '=',  $this_customer->users_id)->first();

                    $customers[] = (object) array(
                        "id" =>  $this_customer->id,
                        "avatar" =>  $this_root_customer->avatar,
                        "name" =>  $this_customer->fname . " " . $this_customer->lname,
                        "email" =>  $this_root_customer->email,
                        "total" => $key->total_paid +  $key->balance,
                        "paid" =>  $key->total_paid,
                        "balance" => $key->balance,
                        "created_at" => $key->created_at,
                        "updated_at" =>  $key->updated_at,
                        "bill_id" => $key->id,
                        "ro_id" =>  $key->receipt_orders_id,

                    );
                    $bill_status = "ok";
                }

                if (isset($customers)) {
                    return view(
                        'clinicViews.billing.index',
                        compact([
                            'bills',
                            'customers',
                            'bill_status',
                            'logs',
                        ])
                    );
                } else {
                    return view(
                        'clinicViews.billing.index',
                        compact([
                            'bill_status',
                            'logs',
                        ])
                    );
                }
            }
        } else {
            $bills = Billings::where('user_as_clinic_id', '=',  $clinic->id)
                ->orderBy('id', 'desc')
                ->get();

            foreach ($bills as $key) {

                $this_customer = User_as_customer::where('id', '=',  $key->user_as_customer_id)->first();
                $this_root_customer = User::where('id', '=',  $this_customer->users_id)->first();

                $customers[] = (object) array(
                    "id" =>  $this_customer->id,
                    "avatar" =>  $this_root_customer->avatar,
                    "name" =>  $this_customer->fname . " " . $this_customer->lname,
                    "email" =>  $this_root_customer->email,
                    "total" => $key->total_paid +  $key->balance,
                    "paid" =>  $key->total_paid,
                    "balance" => $key->balance,
                    "created_at" => $key->created_at,
                    "updated_at" =>  $key->updated_at,
                    "bill_id" => $key->id,
                    "ro_id" =>  $key->receipt_orders_id,

                );

                $bill_status = "ok";
            }

            if (isset($customers)) {
                return view(
                    'clinicViews.billing.index',
                    compact([
                        'bills',
                        'customers',
                        'bill_status',
                        'logs',
                    ])
                );
            } else {
                return view(
                    'clinicViews.billing.index',
                    compact([
                        'bill_status',
                        'logs',
                    ])
                );
            }
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
        $appointment = Appointments::where('receipt_orders_id', '=',  $id)->first(); //to show

        if (!$appointment || $appointment->appointment_status_id == 1 || $appointment->appointment_status_id == 6) {
            return back();
        } else {
            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

            $total = 0; //to show
            $receipt = Receipt_orders::where('id', '=',  $id)->first(); //to show

            $customer = User_as_customer::where('id', '=',  $receipt->user_as_customer_id)->first(); //to show
            $customer_add = User_address::where('id', '=',  $customer->user_address_id)->first(); //to show
            $root_customer = User::where('id', '=',  $customer->users_id)->first(); //to show

            $service_ids = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=',  $id)->get(['clinic_services_id']); //get if there is a data

            $equipmnts_ids = array();
            //$get_equipmnts = array();

            if ($receipt->packages_id != NULL) { // checking if there is a package
                $package = Packages::where('id', '=',  $receipt->packages_id)->first(); //to show

                $this_equipmnts = Packages_has_equipments::where('packages_id', '=', $package->id)->get();
                //getting equipments from this package
                foreach ($this_equipmnts as $k) {
                    $get_equipmnts[] = (object) array(
                        'user_as_clinic_id' => $k->user_as_clinic_id,
                        'clinic_equipments_id' => $k->clinic_equipments_id,
                        'clinic_services_id' => $k->clinic_services_id,
                    );
                }

                $total += $package->price;
            }

            // echo $this_equipmnts;

            if (count($service_ids) > 0) { //checking if there is a service
                foreach ($service_ids as $key) {
                    $this_service = Clinic_services::where('id', '=',  $key->clinic_services_id)->first();
                    $services[] = $this_service; //to show

                    $this_equipmnts = Services_has_equipments::where('clinic_services_id', '=',  $this_service->id)->get();
                    //getting equipments from these services
                    foreach ($this_equipmnts as $k) {
                        $get_equipmnts[] = (object) array(
                            'user_as_clinic_id' => $k->user_as_clinic_id,
                            'clinic_equipments_id' => $k->clinic_equipments_id,
                            'clinic_services_id' => $k->clinic_services_id,
                        );
                    }
                    $total += $this_service->price;
                }
            }

            //echo json_encode($get_equipmnts);

            //logic to get all of the equipments from all of the services availed
            if (isset($get_equipmnts)) {
                foreach ($get_equipmnts as $keys) {
                    //echo $keys->clinic_equipments_id;
                    array_push($equipmnts_ids, $keys->clinic_equipments_id);
                }
            }


            // echo $key;

            $equipments_final_id = array_filter(array_count_values($equipmnts_ids), function ($v) {
                return $v > 0;
            });

            //print_r($equipments_final_id);
            $toshow_equip_id = "";
            $toshow_equip_value = "";

            foreach ($equipments_final_id as $key => $value) {
                // echo $key;
                $this_equipments = Clinic_equipments::where('id', '=',  $key)->first();

                $toshow_equip_id =  $toshow_equip_id . (string)$key . ',';
                $toshow_equip_value =  $toshow_equip_value . (string)$value . ',';

                //array_push($toshow_equip_id, $key);

                $complete_equipments[] = (object) array(
                    "id" => $key,
                    "name" => $this_equipments->name,
                    "unit" => $this_equipments->unit,
                    "min_quantity" => $value,
                    "max_quantity" => $this_equipments->quantity,
                ); //to show
            }

            //echo json_encode($complete_equipments);
            //print_r($complete_equipments);

            $complete_summary = (object) array(
                "name" =>  $customer->fname . " " . $customer->lname,
                "phone" =>  $customer->phone,
                "email" =>  $root_customer->email,
                "address" =>  $customer_add->address_line_1 . ' ' . $customer_add->address_line_2 . ' ' . $customer_add->city,
                "app_time" =>  $appointment->time,
                "app_date" =>  $appointment->appointed_at,
                "customer_id" => $customer->id,
                "ro_id" =>  $id,
                "total" =>  $total,

            );

            $clinic_services = Clinic_services::where('user_as_clinic_id', '=',  $clinic->id)
                ->whereNotIn('id', $service_ids)
                ->get();

            $clinic_materials = Clinic_equipments::where('user_as_clinic_id', '=',  $clinic->id)->get();

            //$clinic_packages = Packages::where('user_as_clinic_id', '=',  $clinic->id)->get();

            // echo $receipt->packages_id;
            $logs = Logs::where('user_as_clinic_id', '=',  $clinic->id)
                ->where('remark', '!=',  "notif")
                ->where('remark', '!=',  "done_notif")
                ->orderBy('id', 'desc')
                ->take(10)
                ->get();

            return view('clinicViews.billing.billing_summary', [
                'complete_summary' => $complete_summary,
                'services' => $services ?? "",
                'package' => $package ?? "",
                'complete_equipments' => $complete_equipments,
                'toshow_equip_id' => $toshow_equip_id,
                'toshow_equip_value' => $toshow_equip_value,
                'clinic_services' => $clinic_services,
                'clinic_materials' => $clinic_materials,
                'status' => 1,
                'logs' => $logs
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
        if (strpos($id, "updateView")) {
            $getid = explode("_", $id);

            $billing = Billings::where('id', '=',   $getid[0])->first();
            $customer = User_as_customer::where('id', '=',  $billing->user_as_customer_id)->first();

            return response()->json([
                'billing' => $billing,
                'customer' => $customer,
            ]);
        }

        if (strpos($id, "historyView")) {
            $getid = explode("_", $id);

            $bill = Billings::where("id", $getid[0])->first();
            $customer = User_as_customer::where("id", $bill->user_as_customer_id)->first();
            $history = Billings_history::where("billings_id", $getid[0])->get();
            return response()->json([
                'history' => $history,
                'customer' => $customer,

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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $logs_count = Logs::where('user_as_clinic_id', '=',  $clinic->id)->count();
        $clinic_add = User_address::where('id', '=',  $clinic->user_address_id)->first();

        if (strpos($id, "UpdateBalance")) {
            //Update Bill Balance
            $getid = explode("_", $id);

            $validator = Validator::make($request->all(), [
                'payment_update' => 'required|numeric|lt:' . $request->edit_balance + 1,
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'request' => $request->all()]);
            } else {

                $new_bal = $request->edit_balance - $request->payment_update;
                $new_total = ($request->edit_total - $request->edit_balance) + $request->payment_update;

                $up_Bill = Billings::find($getid[0]);
                $up_Bill->total_paid = $new_total;
                $up_Bill->balance = $new_bal;
                $up_Bill->save();

                //adding billing history
                $bill_history = new Billings_history();
                $bill_history->paid = $request->payment_update;
                $bill_history->comment = $request->payment_comment ?? "No Comment.";
                $bill_history->billings_id = $getid[0];
                $bill_history->save();

                $cus = User_as_customer::where('id', '=', $up_Bill->user_as_customer_id)->first();
                $cus_root = User::where('id', '=', $cus->users_id)->first();

                if ($cus->gender == "female") {
                    $gender = "Her";
                } else {
                    $gender = "His";
                }

                if ($new_bal == 0) {
                    //Wala na utang

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = $cus->fname . ' ' . $cus->lname . '\'s billing is updated. No balance left';
                    $logs->remark = "success";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    $this_bill = Billings::where("id", $getid[0])->first();

                    $clogs = new Customer_logs();
                    $clogs->message = "Your bill at " . $clinic->name . " with Receipt order  " . $this_bill->receipt_orders_id . " is complete. Thank you";
                    $clogs->remark = "notif";
                    $clogs->date =  date("Y/m/d");
                    $clogs->time = date("h:i:sa");
                    $clogs->user_as_customer_id =   $this_bill->user_as_customer_id;
                    $clogs->save();

                    //sending email notification
                    $details = [
                        'clinic' => $clinic->name,
                        'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                        'contact' => $clinic->phone,
                        'title' => 'Done Billing',
                        'body' => 'We are pleased to announce you that your billing is now fully paid.',
                    ];
                    // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
                    Mail::to($cus_root->email)->send(new EmailNotification($details));
                } else {
                    //email kung ilan pa utang nya

                    //checking logs limit 5000
                    if ($logs_count == 5000) {
                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                    }
                    $logs = new Logs();
                    $logs->message = $cus->fname . ' ' . $cus->lname . '\'s billing is updated. ' . $gender . ' new balance is ₱' . $new_bal;
                    $logs->remark = "success";
                    $logs->date =  date("Y/m/d");
                    $logs->time = date("h:i:sa");
                    $logs->user_as_clinic_id = $clinic->id;
                    $logs->save();

                    $this_bill = Billings::where("id", $getid[0])->first();

                    $clogs = new Customer_logs();
                    $clogs->message = "Your bill at " . $clinic->name . " with Receipt order  " . $this_bill->receipt_orders_id . " is updated. Please be informed that you still have a ₱" . $new_bal . " balance left.";
                    $clogs->remark = "notif";
                    $clogs->date =  date("Y/m/d");
                    $clogs->time = date("h:i:sa");
                    $clogs->user_as_customer_id =   $this_bill->user_as_customer_id;
                    $clogs->save();


                    //sending email notification
                    $details = [
                        'clinic' => $clinic->name,
                        'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                        'contact' => $clinic->phone,
                        'title' => 'Billing Update',
                        'body' => 'Thank you for paying your bills, your current balance now is ₱' . $new_bal . '.',
                    ];
                    // Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
                    Mail::to($cus_root->email)->send(new EmailNotification($details));
                }




                return response()->json([
                    'data' => $request->all(),
                    'test' => $new_bal,
                    'new_total' => $new_total,
                    'id' => $getid[0],
                    'datetime' => date("Y-m-d H:i:s"),
                    'idNgCustomer' => $up_Bill->user_as_customer_id,
                    'email' => $cus_root->email,
                    'message' => 'Billing Updated!',


                ]);
            }
        } else {
            //Finish Appointment
            $customer = User_as_customer::where('id', '=',  $request->customer_id)->first();
            $customer_root = User::where('id', '=',  $customer->users_id)->first();

            $this_ro = Receipt_orders::where('id', '=', $id)->first();

            DB::table('appointments')
                ->where('receipt_orders_id', $id)
                ->update([
                    'appointment_status_id' =>  1, //1 is the id for done
                ]);

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "You've finished an appointment with Receipt Order No: " . $id;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();

            $clogs = new Customer_logs();
            $clogs->message = "Your appointment at " . $clinic->name . " is now finished. Thank you!";
            $clogs->remark = "notif";
            $clogs->date =  date("Y/m/d");
            $clogs->time = date("h:i:sa");
            $clogs->user_as_customer_id =  $this_ro->user_as_customer_id;
            $clogs->save();

            $equipment_ids_array = explode(",", $request->equipment_ids_final);
            $equipment_values_array = explode(",", $request->equipment_values_final);
            $count = 0;



            foreach ($equipment_ids_array as $keys) {
                if ($keys > 0) {
                    $this_equipments = Clinic_equipments::where('id', '=',  $keys)->first();



                    $this_inventory = Clinic_equipment_inventory::where('clinic_equipments_id', '=',  $keys)
                        ->where('quantity', '>', 0)
                        ->orderBy('expiration', 'ASC')
                        ->get();



                    // //updating inveotry qunatity logic
                    if ($this_inventory[0]->quantity > $equipment_values_array[$count]) {
                        $num1 = (int)$this_inventory[0]->quantity; // inventory count
                        $num2 = (int)$equipment_values_array[$count]; //used in this transaction
                        $total =  $num1 - $num2;

                        //return response()->json(['data' =>  $total]);

                        //updating inventory
                        $up_inventory = Clinic_equipment_inventory::find($this_inventory[0]->id);
                        $up_inventory->quantity =  $total;
                        $up_inventory->save();
                    } else {

                        $to_deduct = (int)$equipment_values_array[$count]; //used in this transaction 

                        foreach ($this_inventory as $key) {
                            if ($to_deduct != 0) {
                                if ($to_deduct > $key->quantity) {
                                    $to_deduct = $to_deduct - $key->quantity;

                                    //updating inventory || getting deducting every stock
                                    $this_up_inventory = Clinic_equipment_inventory::find($key->id);
                                    $this_up_inventory->quantity =  0;
                                    $this_up_inventory->save();

                                    //checking logs limit 5000
                                    if ($logs_count == 5000) {
                                        Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                                    }
                                    $logs = new Logs();
                                    $logs->message = "Your stock of " . $this_equipments->name . " with expiration date of " . date('M d, Y', strtotime($this_up_inventory->expiration)) . " is now depleted, be informed that you are now using the next stock in your inventory.";
                                    $logs->remark = "notif";
                                    $logs->date =  date("Y/m/d");
                                    $logs->time = date("h:i:sa");
                                    $logs->user_as_clinic_id = $clinic->id;
                                    $logs->save();
                                } else {
                                    $num1 = (int)$key->quantity; // inventory count
                                    $num2 = $to_deduct; //used in this transaction
                                    $total =  $num1 - $num2;

                                    //updating inventory
                                    $up_inventory = Clinic_equipment_inventory::find($key->id);
                                    $up_inventory->quantity =  $total;
                                    $up_inventory->save();

                                    $to_deduct = 0;
                                }
                            }
                        }
                    }

                    //updating root material's quantity
                    $for_updating_root_quantity = Clinic_equipment_inventory::where('clinic_equipments_id', '=',  $keys)
                        ->where('quantity', '>', 0)
                        ->orderBy('expiration', 'ASC')
                        ->get();
                    $total_quantity = 0;
                    foreach ($for_updating_root_quantity as $key) {
                        $total_quantity += $key->quantity;
                    }

                    $up_equipment = Clinic_equipments::find($keys);
                    $up_equipment->quantity =  $total_quantity;
                    $up_equipment->save();


                    for ($x = 0; $x <= $num2; $x++) {
                        $materials_summary[] = $this_equipments->name;
                    }

                    $count++;

                    if ($total_quantity >= 15 && $total_quantity <= 20) {
                        //checking logs limit 5000
                        if ($logs_count == 5000) {
                            Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                        }
                        $logs = new Logs();
                        $logs->message = $this_equipments->name . " is about to run out. Stock left: " . $total_quantity;
                        $logs->remark = "notif";
                        $logs->date =  date("Y/m/d");
                        $logs->time = date("h:i:sa");
                        $logs->user_as_clinic_id = $clinic->id;
                        $logs->save();
                    }

                    if ($total_quantity >= 5 && $total_quantity <= 10) {
                        //checking logs limit 5000
                        if ($logs_count == 5000) {
                            Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                        }
                        $logs = new Logs();
                        $logs->message = $this_equipments->name . " is about to run out. Stock left: " . $total_quantity;
                        $logs->remark = "notif";
                        $logs->date =  date("Y/m/d");
                        $logs->time = date("h:i:sa");
                        $logs->user_as_clinic_id = $clinic->id;
                        $logs->save();
                    }

                    if ($total_quantity <= 0) {
                        //checking logs limit 5000
                        if ($logs_count == 5000) {
                            Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
                        }
                        $logs = new Logs();
                        $logs->message = $this_equipments->name . " is about to run out. No stock left ";
                        $logs->remark = "danger";
                        $logs->date =  date("Y/m/d");
                        $logs->time = date("h:i:sa");
                        $logs->user_as_clinic_id = $clinic->id;
                        $logs->save();
                    }
                }
            }

            if ($request->z_cash_payment == "on" && $request->z_card_payment == "on") {
                $payment_summary = "Cash:" . $request->z_paid_in_cash . "," . $request->z_select_card . ":" . $request->z_paid_in_card;
                $payment_summary_history = "Paid using Cash and " . $request->z_select_card;
            }
            if ($request->z_cash_payment == "on" && $request->z_paid_in_card == 0) {
                $payment_summary = "Cash:" . $request->z_paid_in_cash . ",n/a:n/a";
                $payment_summary_history = "Paid using Cash only";
            }
            if ($request->z_card_payment == "on" && $request->z_paid_in_cash == 0) {
                $payment_summary = "n/a:n/a," . $request->z_select_card . ":" . $request->z_paid_in_card;
                $payment_summary_history = "Paid using " . $request->z_select_card;
            }


            $mat_sum = implode(",", $materials_summary);

            if ($request->payment_method == "fully paid") {
                $bill = new Billings();
                $bill->total_paid = $request->total_price_input;
                $bill->balance = 0;
                $bill->payment_summary = $payment_summary;
                $bill->price_summary = $request->pricing_summary;
                $bill->materials_summary = $mat_sum;
                $bill->receipt_orders_id = $id;
                $bill->user_as_clinic_id = $clinic->id;
                $bill->user_as_customer_id = $request->customer_id;
                $bill->billing_status_id = 1; //billing status 1 = fully paid
                $bill->save();

                //creating billing history
                $bill_history = new Billings_history();
                $bill_history->paid = $request->total_price_input;
                $bill_history->comment = "First Payment. " . $payment_summary_history;
                $bill_history->billings_id = $bill->id;
                $bill_history->save();

                //sending email notification
                $details = [
                    'clinic' => $clinic->name,
                    'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                    'contact' => $clinic->phone,
                    'title' => 'Your appointment is done',
                    'body' => 'Thank you for choosing ' . $clinic->name . ', pleased to see you again.',
                ];
            } else {
                $bill = new Billings();
                $bill->total_paid = $request->total_paid;
                $bill->balance = $request->balance;
                $bill->payment_summary = $payment_summary;
                $bill->price_summary = $request->pricing_summary;
                $bill->materials_summary = $mat_sum;
                $bill->receipt_orders_id = $id;
                $bill->user_as_clinic_id = $clinic->id;
                $bill->user_as_customer_id = $request->customer_id;
                $bill->billing_status_id = 2;
                $bill->save();

                //creating billing history
                $bill_history = new Billings_history();
                $bill_history->paid = $request->total_paid;
                $bill_history->billings_id = $bill->id;
                $bill_history->comment = "First Payment. " . $payment_summary_history;
                $bill_history->save();

                //sending email notification
                $details = [
                    'clinic' => $clinic->name,
                    'address' =>  $clinic_add->address_line_1 . " " . $clinic_add->address_line_2 . " " . $clinic_add->city,
                    'contact' => $clinic->phone,
                    'title' => 'Your appointment is done',
                    'body' => 'Please be noted that you have a balance in '  . $clinic->name . '. Expect that the clinic will contanct you.',
                ];
            }

            //Mail::to('ragunayon@gmail.com')->send(new EmailNotification($details)); //testing purposes email
            Mail::to($customer_root->email)->send(new EmailNotification($details));

            //checking logs limit 5000
            if ($logs_count == 5000) {
                Logs::where('user_as_clinic_id', '=',  $clinic->id)->first()->delete();
            }
            $logs = new Logs();
            $logs->message = "An appointment has been finished with Receipt Order No: " . $id;
            $logs->remark = "success";
            $logs->date =  date("Y/m/d");
            $logs->time = date("h:i:sa");
            $logs->user_as_clinic_id = $clinic->id;
            $logs->save();


            return response()->json(['data' => "oks na lods", 'ro_id' => $id]);
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

        // $package_service = [];
        //     if (isset($package)) {
        //         array_push($package_service, $package->name);
        //     }
        //     array_push($package_service, $k->name);
        //     "package_service" => $package_service,



        $package_service = [];

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();


        $receipts = Receipt_orders::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('id', '=',  $id)
            ->first();

        $patient = explode(',', $receipts->patient_details); //splitting string into sepratae string using the comma

        $appointments = Appointments::where('receipt_orders_id', '=', $receipts->id)
            ->first();

        $package = Packages::where('id', '=', $receipts->packages_id)
            ->where('user_as_clinic_id', '=',  $clinic->id)
            ->first();

        if (isset($package)) {
            array_push($package_service, $package->name);
        }

        $ro_services_id = Receipt_orders_has_clinic_services::where('receipt_orders_id', '=', $id)->get(['clinic_services_id']);

        $services = Clinic_services::where('user_as_clinic_id', '=', $clinic->id)
            ->whereIn('id', $ro_services_id)
            ->get();

        $services_summary = "";
        foreach ($services as $key) {
            $services_summary = $services_summary . ", " . $key->name;

            array_push($package_service, $key->name);
        }

        $customer = User_as_customer::where('id', '=', $receipts->user_as_customer_id)->first();
        $customer_add = User_address::where('id', '=', $customer->user_address_id)->first();
        $customer_root_data = User::where('id', '=',   $customer->users_id)->first();

        $bill_availed = Billings::where("receipt_orders_id", $id)->first();
        $biil_price_sum = explode(",",  $bill_availed->price_summary);
        foreach ($biil_price_sum as $key) {
            $sec_explode = explode(":",  $key);
            $package_service_summary[] = $sec_explode[0];
        }

        $complete_appointment_data = (object) array(
            "user_email" => $customer_root_data->email,
            "user_avatar" => $customer_root_data->avatar,
            "user_contact" => $customer->phone,
            "user_name" => $customer->fname . " " . $customer->lname,
            "user_gender" => $customer->gender,
            "user_age" => $customer->age,
            "user_address" => $customer_add->address_line_1 . " " . $customer_add->address_line_2 . " " . $customer_add->city,


            "app_id" => $appointments->id, //galing sa appointmnent table
            "app_created_at" =>  $appointments->created_at, //galing sa appointmnent table
            "time" =>  $appointments->time, //galing sa appointmnent table
            "app_appointed_at" =>  $appointments->appointed_at, //galing sa appointmnent table
            "app_status" =>  $appointments->appointment_status_id, //galing sa appointmnent table

            "package_service_summary" => implode(", ", $package_service_summary),


            "ro_id" => $receipts->id ?? "", //galing sareceipts table
            "ro_package_name" => $package->name ?? "", //galing sareceipts table
            "ro_services_name" => $services_summary ?? "", //galing sareceipts table
            "ro_customer_id" => $receipts->user_as_customer_id ?? "", //galing sareceipts table
            "package_service" => implode(", ", $package_service),
            "ro_patient_details" => $receipts->patient_details, //galing sareceipts table
            "ro_patient_address" => $receipts->patient_address, //galing sareceipts table

            "patient_name" => $patient[0] ?? "", //galing sareceipts table
            "patient_gender" => $patient[1] ?? "", //galing sareceipts table
            "patient_age" => $patient[2] ?? "", //galing sareceipts table
            "patient_contact" => $patient[3] ?? "", //galing sareceipts table
            "patient_address" => $receipts->patient_address, //galing sareceipts table
        );

        return response()->json(['data' => $complete_appointment_data]);
    }
}
