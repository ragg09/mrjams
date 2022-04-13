<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\Customer_logs;

class CustomerLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $customer = User_as_customer::where('users_id', '=',  $user->id)->first();

        if ($id == 0) {

            $notif = Customer_logs::where('user_as_customer_id', '=',  $customer->id)
                ->whereIn('remark', ["notif", "done_notif"])
                ->limit(15)
                ->orderBy('id', 'desc')
                ->get();

            $notif_count = Customer_logs::where('user_as_customer_id', '=',  $customer->id)
                ->where('remark', '=', "notif")
                ->get();

            return response()->json([
                'data' => $notif ?? "",
                'notif_count' =>  $notif_count ?? "",
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
        //
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=',  $user->id)->first();

        if ($id == 0) {
            $logs_id = Customer_logs::where('user_as_customer_id', '=',  $customer->id)
                ->where('remark', '=', "notif")
                ->get(["id"]);

            foreach ($logs_id  as $key) {
                $logs = Customer_logs::find($key->id);
                $logs->remark =  "done_notif";
                $logs->save();
            }

            return response()->json([
                'tester' => "success"
            ]);
        }
    }
}
