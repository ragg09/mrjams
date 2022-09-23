<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Clinic_specialists;
use App\Models\Clinic_specialists_compensation;
use App\Models\Clinic_vaults;
use App\Models\Logs;
use App\Models\User;
use App\Models\User_as_clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vault = Clinic_vaults::find(2);

        // if (md5('password') == $vault->password) {
        //     return "Tama";
        // } else {
        //     return  "mali";
        // }

        if (session('vault-allowed')) {
            request()->session()->flash('vault-allowed', 'Session is still valid');

            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();

            $this_clinic_specialists = Clinic_specialists::where('user_as_clinic_id', $clinic->id)->get();

            // $compensations = Clinic_specialists_compensation::all();

            foreach ($this_clinic_specialists as $key) {
                $claimable = 0;
                $compensations = Clinic_specialists_compensation::where('clinic_specialists_id', $key->id)
                    ->where('claim', 0)
                    ->OrderBy('created_at', 'ASC')
                    ->get();

                if (count($compensations) > 0) {
                    foreach ($compensations as $k) {
                        $claimable += $k->compensation;
                    }

                    $complete_compensation_data[] = (object) array(
                        "id" => $key->id,
                        "name" => $key->fullname,
                        "claimable" => $claimable,
                        "from" => $compensations[0]->created_at,
                        "to" => $compensations[count($compensations) - 1]->created_at,

                    );
                }
            }

            //name, claimable, from, to,

            // dd($complete_compensation_data)->toArray();

            return view('clinicViews.vault.index', ['compensations' => $complete_compensation_data]);
        } else {
            return view('clinicViews.vault.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        request()->session()->flash('vault-allowed', 'Session is still valid');
        // return $request->all();

        $name = $request->name;
        $clinic = $request->clinic;
        $salary = $request->salary;

        return view('clinicViews.print.payslip', compact('name', 'clinic', 'salary'));
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


        if (isset($request->create_vault)) {
            //store new vault
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'

            ]);

            if ($validator->fails()) {
                return back()->with('success', 'Passwords must be the same and at least 8 characters');
            } else {

                Clinic_vaults::Create([
                    'user_as_clinic_id' => $clinic->id,
                    'password' => md5($request->password)
                ]);

                return redirect(route('clinic.owners-vault.index'));
            }
        } else {
            $vault = Clinic_vaults::where('user_as_clinic_id', $clinic->id)->first();

            if (md5($request->password) == $vault->password) {
                request()->session()->flash('vault-allowed', 'Session is still valid');
                return redirect(route('clinic.owners-vault.index'));
            } else {
                request()->session()->flash('wrong_pass', 'Vault Password Incorrect');
                return  redirect()->back();
            }
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

        request()->session()->flash('vault-allowed', 'Session is still valid');

        if ($id == "doctor-payslip-history") {
            $user = User::where('email', '=',  Auth::user()->email)->first();
            $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
            $specialists = Clinic_specialists::where('user_as_clinic_id', $clinic->id)->get();


            return view('clinicViews.vault.paylsip_history', compact('specialists'));
        }

        if (strpos($id, "_")) {
            $getid = explode("_", $id);
            $records = Clinic_specialists_compensation::where('clinic_specialists_id', $getid[0])->get();
            return response()->json($records);
        }

        $this_specialists = Clinic_specialists::find($id);
        $compensations = Clinic_specialists_compensation::where('clinic_specialists_id', $id)
            ->where('claim', 0)
            ->OrderBy('created_at', 'ASC')
            ->get();
        return view('clinicViews.vault.show', compact('this_specialists', 'compensations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        request()->session()->flash('vault-allowed', 'Session is still valid');
        $this_specialists = Clinic_specialists::find($id);
        return response()->json($this_specialists);
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

        $claimable = 0;
        $this_specialists = Clinic_specialists::find($id);

        $compensations = Clinic_specialists_compensation::where('clinic_specialists_id', $id)
            ->where('claim', 0)
            ->OrderBy('created_at', 'ASC')
            ->get();


        foreach ($compensations as $k) {
            $this_compensation = Clinic_specialists_compensation::find($k->id);
            $this_compensation->claim = 1;
            $this_compensation->save();

            $claimable += $k->compensation;
        }

        $data = (object) array(
            "name" => $this_specialists->fullname,
            "salary" => $claimable,
            "clinic" => $clinic->name,
        );

        //name, clinic name, salary

        request()->session()->flash('vault-allowed', 'Session is still valid');
        return response()->json($data);
    }
}
