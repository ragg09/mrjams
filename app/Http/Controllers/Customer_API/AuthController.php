<?php

namespace App\Http\Controllers\Customer_API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_address;
use App\Models\User_as_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Laravel\Sanctum\HasApiTokens;
use Exception;


class AuthController extends Controller
{
    use HasApiTokens;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function register (Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if($user){
            //LOGIN ======================================================================================
            // $this_user = User::where('id', '=', 
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                'message'=>"Login Successfully", 
                'user'=>$user,
                'token'=>$token
            ]);
        }
        
        else{
            //REGISTRATION =============================================================================
            $newuser = new User();
            $newuser->email = $request->email;
            $newuser->avatar = $request->avatar;
            // $newuser->role = "customer";
            $newuser->save();
            $this_user = User::where('id', '=', $newuser->id)->first();
            $token = $this_user->createToken("token")->plainTextToken;
            return response()->json(['message'=>"Registration Successfully", 'user'=>$newuser, 'token'=>$token]);
        }
    }

    public function login(Request $request)
    {
        
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

    }

    public function getUserID($email)
    {
        $user = User::orderBy('id')
        ->where('email', '=', $email)
        ->get();
        return response()->json($user);
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
            'fname' => 'required|min:2',
            'mname' => 'nullable',
            'lname' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'phone' => 'required|numeric|min:11',
            'gender' => 'required',
            'address_line_1' => 'required|min:2',
            'address_line_2' => 'nullable',
            'city' => 'required|min:2',
            'zip_code' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else{
            $user_table = User::where('email', '=',  $request->email)->first();
            
            $user =  User::find($user_table->id);
            $user->role = "customer";
            $user->save();

            $address = new User_address();
            $address->address_line_1 = request('address_line_1');
            $address->address_line_2 = request('address_line_2');
            $address->city = request('city');
            $address->zip_code = request('zip_code');
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

            return response()->json([
                'message' => "check mo na db",
                'user' => $user,
                'address' => $address,
                'customer' => $customer,
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
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:2',
            'mname' => 'nullable',
            'lname' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'phone' => 'required|numeric|min:11',
            'address_line_1' => 'required|min:2',
            'address_line_2' => 'required|min:2',
            'city' => 'required|min:2',
            'zip_code' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // Update Customer Info
            $fname = $request->fname;
            $mname = $request->mname;
            $lname = $request->lname;
            $gender = $request->gender;
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
