<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\Logs;

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
        return view('clinicViews.logs.index', ['data' => $data]);
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

        if ($id == 0) {

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
