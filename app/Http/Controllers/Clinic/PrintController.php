<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Billings;
use App\Models\Receipt_orders;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "SORNA";
        return view('clinicViews.print.receipt', compact(['title']));
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
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $clinic_address = User_address::where('id', '=',  $clinic->user_address_id)->first();

        if (strpos($id, "receipt")) {
            $getid = explode("_", $id);

            $ro = Receipt_orders::where('id', '=',  $getid[0])->first();

            $customer = User_as_customer::where('id', '=',  $ro->user_as_customer_id)->first();
            $customer_root = User::where('id', '=',  $customer->users_id)->first();

            $appointment = Appointments::where('receipt_orders_id', '=',  $id)->first();

            $bill = Billings::where('receipt_orders_id', '=',  $id)->first();

            $service = explode(",", $bill->price_summary);

            foreach ($service as $key) {
                $this_data = explode(":", $key);

                $service_summary[] = (object) array(
                    'name' => $this_data[0],
                    'amount' => $this_data[1],
                );
            }

            // echo json_encode($service_summary);

            return view(
                'clinicViews.print.receipt',
                compact([
                    'clinic',
                    'user',
                    'clinic_address',
                    'ro',
                    'customer',
                    'customer_root',
                    'appointment',
                    'bill',
                    'service_summary'
                ])
            );
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
        //
    }
}
