<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_address;
use App\Models\User_as_customer;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
    }

    // public function about()
    // {
    //     //
    //     return view('customerViews.about');
    // }

    // public function about_p()
    // {
    //     //
    //     return view('publicViews.about_p');
    // }

    
    public function contact()
    {
        //
        return view('customerViews.contact');
    }

    public function profile()
    {
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Customer Data (Account)

        $user = User::where('email', '=',  Auth::user()->email)->first();
        $customer = User_as_customer::where('users_id', '=', $user->id)->first();

        $address = User_address::where('id', '=', $customer->user_address_id)->first();

        return view('customerViews.profile', ['customer'=>$customer, 'address'=>$address]);
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
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        // Update Customer Info
        //echo json_encode($request->all());

        $validator = Validator::make($request->all(),[
            'fname' => 'required|min:2',
            'lname' => 'required|min:2',
            'phone' => 'required|numeric|min:11',
            'age' => 'required|numeric|min:1',
            'addline1' => 'required|min:2',
            'city' => 'required|min:2',
            // 'zipcode' => 'required|numeric|min:1',
        
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else{


            $fname = $request->fname;
            // $mname = $request->mname;
            $lname = $request->lname;
            // $gender = $request->gender;
            $phone = $request->phone;
            $age = $request->age;

            $addline1 = $request->addline1;
            $addline2 = $request->addline2;
            $city = $request->city;
            $zipcode = $request->zipcode;

            $user_customer = User_as_customer::where('users_id', '=', $id)->first();
            $user_customer->fname = $fname;
            // $user_customer->mname = $mname;
            $user_customer->lname = $lname;
            // $user_customer->gender = $gender;
            $user_customer->phone = $phone;
            $user_customer->age = $age;
            $user_customer->save();

            $customer_add = User_address::where('id', '=', $user_customer->user_address_id)->first();
            $customer_add->address_line_1 = $addline1;
            $customer_add->address_line_2 = $addline2;
            $customer_add->city = $city;
            $customer_add->zip_code = $zipcode;
            $customer_add->save();


            return response()->json(['all'=>$user_customer, 'add'=>$customer_add]);

        }
        // return view('customerViews.profile'); //tama ba ung blade fileoo
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
