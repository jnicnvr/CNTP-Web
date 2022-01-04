<?php

use App\Http\Controllers\PassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();
//onLoadTravelPass

Route::group(['prefix' => 'admin','middleware' => 'prevent-back-history','check-role'], function () {
    Auth::routes();
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/passed_travel', [PassController::class, 'onLoadEvaluatedPass'])->name('admin.passed_travel');
        Route::get('/travel_pass', [PassController::class, 'onLoadTravelPass'])->name('admin.travel_pass');
        Route::get('/booked_pass', [PassController::class, 'onLoadBookedPass'])->name('admin.booked_pass');
        Route::get('/dashboard', [PassController::class, 'onLoadDashboard'])->name('admin.dashboard');
        Route::resource('/profile', ProfileController::class, ['except' => ['create', 'edit', 'destroy']]);
        Route::resource('/user_logs', UserLogsController::class, ['except' => ['create', 'edit','show', 'destroy']]);
        Route::resource('/users', UsersController::class, ['except' => ['create', 'edit','show', 'destroy']]);
    });
        
});

Route::resource('/travel-pass-application', PassController::class, ['except' => ['create', 'edit','update', 'destroy']]);
Route::get('/faq', [PassController::class, 'showFAQ'])->name('faq');
