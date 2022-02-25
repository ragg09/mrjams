<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
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
        echo "grrrrrrrrrAAA";
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2',
            'phone' => 'required|numeric|min:11',
            'telephone' => 'required|numeric',
            'address_line_1' => 'required|min:2',
            'address_line_2' => 'required|min:2',
            'city' => 'required|min:2',
            'zip_code' => 'required|numeric',
            'clinic_type_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else{
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
            $user->save();
            
            $clinic = new User_as_clinic();
            $clinic->name = request('name');
            $clinic->phone = request('phone');
            $clinic->telephone = request('telephone');
            $clinic->users_id = $user_table->id;
            $clinic->clinic_types_id =  request('clinic_type_id');
            $clinic->user_address_id = $address->id;
            $clinic->save();

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

            return response()->json(['message' => "check mo na db"]);
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
