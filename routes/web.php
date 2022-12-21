<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BraintreeController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware;
use App\Http\Controllers\TestController;

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

Route::get('/test',function(){
    return view('report');
});


Route::get('/',[HomePageController::class, 'homePageView']);


Route::get('/register',[UserController::class, 'registerPageView']);

Route::post('/register-patient',[UserController::class, 'registerPatient']);

Route::get('/otp',[UserController::class, 'otpPageView']);

Route::post('/otp-confirm',[UserController::class, 'otpConfirm']);

Route::get('/login',[UserController::class, 'loginPageView']);

Route::post('/login',[UserController::class, 'patientLogin']);

Route::get('/my-portal',[PatientController::class, 'patientPortal']);

Route::post('/update-patient',[UserController::class, 'updatePatient']);

Route::post('/add-item-to-cart',[CartController::class,'addItem']);

Route::get('/cart',[CartController::class,'cartView']);

Route::get('/checkout',[CheckoutController::class, 'checkoutView']);

Route::post('/place-order',[OrderController::class, 'orderPlace']);

Route::any('/payment', [BraintreeController::class, 'token'])->middleware('auth');

Route::get('/payment-success',[OrderController::class, 'paymentSuccess']);

Route::get('/payment-fail',function(){
    return view('payment-fail');
});

Route::get('/barcode',function(){
    return view('tes');
});
// Route::any('/payment', [BraintreeController::class, 'token'])->name('token')->middleware('auth');


Route::get('/portal-login',[UserController::class, 'adminLoginPage'])->name('login');


Route::post('/login-admin',[UserController::class, 'adminLogin']);

Route::get('/admin-portal',[UserController::class,'adminDashboard'])->middleware('auth');

Route::get('/create-patient',[UserController::class, 'createPationPage']);
Route::get('/patients-list',[UserController::class, 'viewPationListPage']);

Route::get('/edit-patient-data',[UserController::class, 'editPatient']);

Route::post('/update-patient',[UserController::class, 'updateUser']);

Route::get('/create-receptionist',[UserController::class, 'createReceptionist']);

Route::post('/register-user',[UserController::class, 'registerUser']);
Route::get('/receptionist-list',[UserController::class, 'viewUserListPage']);

Route::get('/edit-reciptienist-data',[UserController::class, 'editUser']);

Route::post('/update-user',[UserController::class, 'updateUserAdmin']);

Route::get('/appointment-verify-pending-list',[OrderController::class, 'verificationPending']);

Route::get('/report-data',[OrderController::class, 'reportPageView']);

Route::post('/verify-report',[OrderController::class, 'verifyReport']);

Route::get('/appointment-verified-list',[OrderController::class, 'verificationApproved']);

Route::get('/appointment-reciving-pending-list',[OrderController::class, 'recivingPending']);

Route::get('/appointment-recived-list',[OrderController::class, 'recivedList']);

Route::get('/barchode-print',[PdfController::class, 'barcodePrint']);

Route::post('/change-appointment',[OrderController::class, 'changeAppintment']);

Route::get('/report-data',[OrderController::class, 'openReportData']);

Route::post('/result-update',[OrderController::class, 'resultsSave']);

Route::get('/report-print',[PdfController::class, 'reportPrint']);

Route::get('/logout',[UserController::class, 'logout']);

Route::get('/test-type-create',[TestController::class,'addView']);

Route::post('/register-test',[TestController::class,'add']);

Route::get('/test-type-list',[TestController::class,'view']);

Route::get('/edit-test',[TestController::class,'editView']);

Route::post('/update-test',[TestController::class,'update']);