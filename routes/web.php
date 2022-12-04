<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/register',[UserController::class, 'registerPageView']);
Route::post('/register-patient',[UserController::class, 'registerPatient']);
Route::get('/otp',[UserController::class, 'otpPageView']);
Route::post('/otp-confirm',[UserController::class, 'otpConfirm']);
Route::get('/login',[UserController::class, 'loginPageView']);
Route::post('/login',[UserController::class, 'patientLogin']);

Route::get('/my-portal',[PatientController::class, 'patientPortal']);

Route::get('/portal-login', function () {
    return view('admin-portal/login');
});

Route::get('/admin-portal', function () {
    return view('admin-portal/index');
});