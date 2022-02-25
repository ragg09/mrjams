<?php

use App\Http\Controllers\admin\ClinicDetailsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PatientDetailsController;
use App\Http\Controllers\Admin\UserClinicAnalyticsController;

use App\Http\Controllers\Clinic\TestingController;
use App\Http\Controllers\Clinic\ClinicSettingsController;
use App\Http\Controllers\Clinic\DashbaordController;
use App\Http\Controllers\Clinic\EquipmentsController;
use App\Http\Controllers\Clinic\LogsController;
use App\Http\Controllers\Clinic\ServicesController;
use App\Http\Controllers\Clinic\PackagesController;
use App\Http\Controllers\Clinic\AppointmentController;
use App\Http\Controllers\Clinic\PatientController;
use App\Http\Controllers\Clinic\BillingController;
use App\Http\Controllers\Clinic\ReportController;

use App\Http\Controllers\Customer\CustomerRegister;
use App\Http\Controllers\Customer\CustomerMap;
use App\Http\Controllers\Customer\Customer;
use App\Http\Controllers\Customer\ClinicList;
use App\Http\Controllers\Customer\Appointment;
use App\Http\Controllers\Customer\RelativeAppointment;
use App\Http\Controllers\Customer\Mail;
use App\Http\Controllers\Customer\Rating;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\User;
use App\Models\Logs;
use App\Models\User_as_customer;
use App\Models\Appointments;
use App\Models\Rating as ModelRating;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Google Login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
//================================================================================================================
//public routes
Route::get('/', function () {
    return view('publicViews.index');
})->middleware('role_guest');

Route::group(['prefix' => 'public', 'middleware' => ['role_guest'], 'as' => 'public.'], function () {
    Route::resource('testing', TestingController::class); //testing purposes
});
//================================================================================================================
//role and registration routes
Route::group(['prefix' => 'role', 'middleware' => ['auth'], 'as' => 'role.'], function () {
    Route::get('/', function () {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        return view('role_registration.choose_role', ['data' => $user]);
    })->name('role');

    Route::get('/clinic', function () {
        $types = Clinic_types::all();
        return view('role_registration.register_clinic', ['types' => $types]);
    })->name('register_clinic');

    Route::get('/customer', function () {
        return view('role_registration.register_customer');
    })->name('register_customer');
});
//================================================================================================================
//admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role_admin'], 'as' => 'admin.'], function () {

    //Route::resource('analytics', UserClinicAnalyticsController::class);
    // 
    // return view('adminViews.index'); 

    Route::get('/', function () {
        $RegUser = User_as_customer::count();
        $RegClinic = User_as_clinic::count();
        $Appointment = Appointments::count();
        $Rating = ModelRating::avg('rating');
        round($Rating, 2);

        $latestClinic = User_as_clinic::orderBy('id', 'desc')->first();
        $latestCustomer = User_as_customer::orderBy('id', 'desc')->first();
        // echo($latestClinic);
        return view('adminViews.index', ['regUser' => $RegUser, 'regClinic' => $RegClinic, 'appointment' => $Appointment, 'rating' => $Rating, 'latestClinic' => $latestClinic, 'latestCustomer' => $latestCustomer]);
    });

    Route::get('/testing', function () {
        return view('adminViews.kahitano');
    });

    Route::resource('analytics', UserClinicAnalyticsController::class);
    Route::resource('clinic', ClinicDetailsController::class);
    Route::resource('patient', PatientDetailsController::class);
    Route::resource('dashboard', DashboardController::class);
});
//================================================================================================================
//clinic routes without middleware exceptions
Route::group(['prefix' => 'clinic', 'middleware' => ['auth', 'check_user', 'role_clinic'], 'as' => 'clinic.'], function () {
    Route::get('/', function () {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $data = Logs::where('user_as_clinic_id', '=',  $clinic->id)->orderBy('id', 'desc')->paginate(10);
        return view('clinicViews.index', ['data' => $data]);
    })->name('dashobard');

    Route::resource('dashboard', DashbaordController::class);
    Route::resource('equipments', EquipmentsController::class);
    Route::resource('logs', LogsController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('packages', PackagesController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('patient', PatientController::class);
    Route::resource('billing', BillingController::class);
    Route::resource('report', ReportController::class);
});
//clinic routes with middleware exceptions
//check_user, role_clinic middlewares are directly included in the contrller
//add these lines in controller
// public function __construct()
// {
//     $this->middleware(['check_user', 'role_clinic'])->except(['function_name']);
// }
Route::group(['prefix' => 'clinic', 'middleware' => ['auth'], 'as' => 'clinic.'], function () {
    Route::resource('settings', ClinicSettingsController::class);
});
//================================================================================================================
//customer routes
Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'check_user', 'role_customer'], 'as' => 'customer.'], function () {
    Route::get('/', function () {

        // $user = User::where('email', '=',  Auth::user()->email)->first();
        // $customer = User_as_customer::where('users_id', '=', $user->id)->get();

        // echo($customer);
        return view('customerViews.index_one');
    })->name('dashobard');

    Route::get('/about', function () {
        return view('customerViews.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('customerViews.contact');
    })->name('contact');

    // Route::get('/profile', function () {
    //     return view('customerViews.profile');
    // })->name('profile');

    // Route::get('/appointment/setAppointment', function () {
    //     return view('customerViews.appointment.setAppointment');
    // })->name('setAppointment');

    Route::resource('customerinfo', Customer::class);
    Route::resource('clinicList', ClinicList::class);
    Route::resource('appointment', Appointment::class);
    Route::resource('relativeappoint', RelativeAppointment::class);
    Route::resource('mail', Mail::class);
    Route::resource('rate', Rating::class);

    Route::resource('customermap', CustomerMap::class);
});
//customer routes with middleware exceptions
//check_user, role_customer middlewares are directly included in the controller
//add these lines in controller
// public function __construct()
// {
//     $this->middleware(['check_user', 'role_customer'])->except(['function_name']);
// }
Route::group(['prefix' => 'customer', 'middleware' => ['auth'], 'as' => 'customer.'], function () {
    //
    Route::resource('customerregister', CustomerRegister::class);
});
//================================================================================================================      
