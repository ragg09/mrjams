<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use App\Models\User;

class CustomerRegister extends Controller
{

    public function __construct()
    {
        $this->middleware(['check_user', 'role_customer'])->except(['store']);
    }
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
    
        $validator = Validator::make($request->all(),[
            'fname' => 'required|min:4',
            'mname' => 'required|min:4',
            'lname' => 'required|min:4',
            'gender' => 'required|min:4',
            'phone' => 'required|numeric|min:11',
            'age' => 'required|numeric|min:1',
            'addline1' => 'required|min:2',
            'addline2' => 'required|min:2',
            'city' => 'required|min:2',
            'zip' => 'required|numeric|min:1',
        
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else{

            $user_table = User::where('email', '=',  Auth::user()->email)->first();
            
            $user =  User::find($user_table->id);
            $user->role =  request('role');
            $user->save();

            $address = new User_address();
            $address->address_line_1 = request('addline1');
            $address->address_line_2 = request('addline2');
            $address->city = request('city');
            $address->zip_code = request('zip');
            $address->latitude = null;
            $address->longitude = null;
            $address->save();

            $customer = new User_as_customer();
            $customer->fname = request('fname');
            $customer->mname = request('mname');
            $customer->lname = request('lname');
            $customer->gender = request('gender');
            $customer->phone = request('phone');
            $customer->age = request('age');
            $customer->users_id = $user_table->id;
            $customer->user_address_id = $address->id;
            $customer->save();

          
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
