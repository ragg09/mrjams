<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer_API\AuthController;
use App\Http\Controllers\Customer_API\MClinicList;
use App\Http\Controllers\Customer_API\MCustomerMap;
use App\Http\Controllers\Customer_API\MMailController;
use App\Http\Controllers\Customer_API\MAppointmentController;
use App\Http\Controllers\Customer_API\MCustomerLogsController;
use App\Http\Controllers\Customer_API\MCustomerController;
use App\Http\Controllers\Customer_API\MAnnouncementController;
use App\Http\Controllers\Customer_API\MRatingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('mcustomermap', MCustomerMap::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::POST('/register', [AuthController::class, 'register']);
    Route::resource('user', AuthController::class);
});

Route::group(['prefix' => 'mcustomer', 'middleware' => ['auth:sanctum'], 'as' => 'mcustomer.'], function () {
    Route::resource('mcliniclist', MClinicList::class);
    Route::resource('mmailappointment', MMailController::class);
    Route::resource('mappointment', MAppointmentController::class);
    Route::resource('mcustomerLogs', MCustomerLogsController::class);
    Route::resource('mcustomermap', MCustomerMap::class);
    Route::resource('mprofile', MCustomerController::class);
    Route::resource('mannouncement', MAnnouncementController::class);
    Route::resource('mrating', MRatingController::class);
});
