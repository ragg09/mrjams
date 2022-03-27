<?php


use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserClinicAnalyticsController;
use App\Http\Controllers\Admin\TablesController;
use App\Http\Controllers\Admin\ClinicDetailsController;
use App\Http\Controllers\Admin\PatientDetailsController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ClinicTypesController;


use App\Http\Controllers\Clinic\TestingController;
use App\Http\Controllers\Clinic\ClinicSettingsController;
use App\Http\Controllers\Clinic\DashbaordController;
use App\Http\Controllers\Clinic\EquipmentsController;
use App\Http\Controllers\Clinic\LogsController;
use App\Http\Controllers\Clinic\ServicesController;
use App\Http\Controllers\Clinic\PackagesController;
use App\Http\Controllers\Clinic\AppointmentController as ClinicAppointment;
use App\Http\Controllers\Clinic\PatientController;
use App\Http\Controllers\Clinic\BillingController;
use App\Http\Controllers\Clinic\ReportController;
use App\Http\Controllers\Clinic\RatingController as ClinicRating;
use App\Http\Controllers\Clinic\PrintController;
use App\Http\Controllers\Clinic\SendEmailController;

use App\Http\Controllers\Customer\CustomerRegisterController;
use App\Http\Controllers\Customer\CustomerMap;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\ClinicListController;
use App\Http\Controllers\Customer\AppointmentController as CustomerAppointment;
use App\Http\Controllers\Customer\RelativeAppointmentController;
use App\Http\Controllers\Customer\MailController;
use App\Http\Controllers\Customer\RatingController;
use App\Http\Controllers\Customer\AnnouncementController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User_as_clinic;
use App\Models\Clinic_types;
use App\Models\User;
use App\Models\Logs;
use App\Models\User_as_customer;
use App\Models\Appointments;
use App\Models\Ratings as ModelRating;
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
        $Rating = ModelRating::where('users_id_ratee', '=', 1)->avg('rating');
        // $Rating = Rating::avg('rating')->where('user_id_rater' , "=" , '4');
        // $Rating = ModelRating::where('users_id_ratee' , "=" , '1')->get();
        round($Rating, 2);

        $latestClinic = User_as_clinic::orderBy('id', 'desc')->first();
        $latestCustomer = User_as_customer::orderBy('id', 'desc')->first();

        if ($RegUser) {
            return view('adminViews.index', ['regUser' => $RegUser, 'regClinic' => $RegClinic, 'appointment' => $Appointment, 'rating' => $Rating, 'latestClinic' => $latestClinic, 'latestCustomer' => $latestCustomer, 'status' => '1']);
        } else {

            return view('adminViews.index', ['status' => '0']);
        }

        // return view('adminViews.index');
    });

    Route::get('/testing', function () {
        return view('adminViews.kahitano');
    });

    Route::resource('analytics', UserClinicAnalyticsController::class);
    Route::resource('clinic', ClinicDetailsController::class);
    Route::resource('patient', PatientDetailsController::class);
    Route::resource('dashboard', AdminDashboard::class);
    Route::resource('message', MessageController::class);
    Route::resource('clinicTypes', ClinicTypesController::class);
});
//================================================================================================================
//clinic routes without middleware exceptions
Route::group(['prefix' => 'clinic', 'middleware' => ['auth', 'check_user', 'role_clinic'], 'as' => 'clinic.'], function () {
    Route::get('/', function () {
        $user = User::where('email', '=',  Auth::user()->email)->first();
        $clinic = User_as_clinic::where('users_id', '=',  $user->id)->first();
        $data = Logs::where('user_as_clinic_id', '=',  $clinic->id)
            ->where('remark', '!=',  "notif")
            ->where('remark', '!=',  "done_notif")
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('clinicViews.index', ['data' => $data]);
    })->name('dashobard');

    Route::resource('dashboard', DashbaordController::class);
    Route::resource('equipments', EquipmentsController::class);
    Route::resource('logs', LogsController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('packages', PackagesController::class);
    Route::resource('appointment', ClinicAppointment::class);
    Route::resource('patient', PatientController::class);
    Route::resource('billing', BillingController::class);
    Route::resource('report', ReportController::class);
    Route::resource('print', PrintController::class);
    Route::resource('rating', ClinicRating::class);
    Route::resource('email', SendEmailController::class);
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

    Route::resource('customerinfo', CustomerController::class);
    Route::resource('clinicList', ClinicListController::class);
    Route::resource('appointment', CustomerAppointment::class);
    Route::resource('relativeappoint', RelativeAppointmentController::class);
    Route::resource('mail', MailController::class);
    Route::resource('rate', RatingController::class);
    Route::resource('announcement', AnnouncementController::class);

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
    Route::resource('customerregister', CustomerRegisterController::class);
});
//================================================================================================================       
