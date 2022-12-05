<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

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

Route::get('/',[HomePageController::class, 'homePageView']);

Route::get('/register',[UserController::class, 'registerPageView']);

Route::post('/register-patient',[UserController::class, 'registerPatient']);

Route::get('/otp',[UserController::class, 'otpPageView']);

Route::post('/otp-confirm',[UserController::class, 'otpConfirm']);

Route::get('/login',[UserController::class, 'loginPageView']);

Route::post('/login',[UserController::class, 'patientLogin']);

Route::get('/my-portal',[PatientController::class, 'patientPortal']);

Route::post('/add-item-to-cart',[CartController::class,'addItem']);

Route::get('/cart',[CartController::class,'cartView']);

Route::get('/checkout',[CheckoutController::class, 'checkoutView']);

Route::post('/place-order',[OrderController::class, 'orderPlace']);

Route::get('/portal-login', function () {
    return view('admin-portal/login');
});

Route::get('/admin-portal', function () {
    return view('admin-portal/index');
});