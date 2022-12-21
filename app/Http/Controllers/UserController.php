<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Throwable;
use App\Models\User;
use App\Models\Common;
use App\Models\Orders;
use App\Models\SMS;
use App\Models\UserSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->common = new Common();
        $this->sms = new SMS();
        $this->session = new UserSession();
        $this->order =  new Orders();
    }

    public function registerPageView()
    {
        return view('register');
    }

    public function registerPatient(Request $request)
    {

        try {
            $otp = $this->common->getOtp();
            $userData = array(
                'first_name' => strtolower($request->post('first_name')),
                'last_name' => strtolower($request->post('last_name')),
                'email' => $request->post('email'),
                'user_role' => 'patient',
                'nic' => strtolower($request->post('nic')),
                'mobile' => trim($request->post('mobile'), "0"),
                'date_of_birth' => $request->post('dob'),
                'gender' => strtolower($request->post('gender')),
                'created_at' => date('Y-m-d H:i:s'),
                'password' =>  Hash::make($otp),
                'remember_token' => md5($otp)
            );

            $store = $this->user->insert($userData);
            if ($store) {
                $sendSms = $this->sms->send(trim($request->post('mobile'), "0"), $otp);
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully saved";
                $response[0]['mobile'] = trim($request->post('mobile'), "0");
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function otpPageView(Request $request)
    {
        $mobile = $_GET['mobile'];
        return view('otp');
    }

    public function otpConfirm(Request $request)
    {

        try {
            $mobile = $request->post('mobile');
            $otp = $request->post('otp');

            $verify = $this->user->verifyOtp($mobile, $otp);

            if ($verify) {
                $email = $verify->email;

                $request->request->add(['email' => $verify->email]);
                $request->request->add(['password' => $otp]);

                $validator = Validator::make($request->all() + ['email' => $email], [
                    'email' => 'required|email',
                    'otp' => 'required',
                ]);
                $credentials = $request->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    $set_login = $this->session->setPatient($verify);

                    $response[0]['response_code'] = 200;
                    $response[0]['response_text'] = "Success";
                } else {
                    $response[0]['response_code'] = 400;
                    $response[0]['response_text'] = "Something went wrong. Please try again";
                }
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;
    }

    public function loginPageView(Request $request)
    {
        return view('login');
    }

    public function patientLogin(Request $request)
    {
        try {
            $mobile_no = ltrim($request->post('mobile'), "0"); 
            $user = $this->user->getByMobile($mobile_no);
            if ($user) {

                $otp = $this->common->getOtp();
                $userData = array(
                    'remember_token' => md5($otp),
                    'password' => Hash::make($otp),
                    'updated_at' => date("Y-m-d H:i:s")
                );

                $id = $user->id;

                $store = $this->user->updateUser($userData, $id);

                if ($store) {
                    if(env('SMS_ON') == 1){
                        $sendSms = $this->sms->send($mobile_no, $otp);
                    }

                    
                    $response[0]['response_code'] = 200;
                    $response[0]['response_text'] = "Successfully saved";
                    $response[0]['mobile'] = $mobile_no;
                } else {
                    $response[0]['response_code'] = 400;
                    $response[0]['response_text'] = "Something went wrong. Please try again";
                }
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "No account found";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function updatePatient(Request $request)
    {

        try {
            $userData = array(
                'first_name' => strtolower($request->post('first_name')),
                'last_name' => strtolower($request->post('last_name')),
                'email' => $request->post('email'),
                'user_role' => 'patient',
                'nic' => strtolower($request->post('nic')),
                'mobile' => $request->post('mobile'),
                'date_of_birth' => $request->post('dob'),
                'gender' => strtolower($request->post('gender')),
                'updated_at' => date('Y-m-d H:i:s'),
            );


            $store = $this->user->updateUser($userData, $request->post('id'));
            if ($store) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully updated";
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function adminDashboard(Request $request){
        $total_patient_count = $this->user->getCountByUserType('patient');
        $pending_appoinment_count = $this->order->getActiveOrderCount();
        $total_revenue = $this->order->getTotalRevenue();
        $daily_sale = $this->order->getDailyRevenue();
       
        return view('admin-portal/index',['total_patient_count'=>$total_patient_count,'pending_appoinment_count'=>$pending_appoinment_count,'total_revenue'=>$total_revenue,'daily_sale'=>$daily_sale]);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            session(['user_role_type' => 'admin']);
            $response[0]['response_code'] = 200;
            $response[0]['response_text'] = "Success";
        } else {
            $response[0]['response_code'] = 400;
            $response[0]['response_text'] = "Something went wrong. Please try again!";
        }
        return $response;
    }

    public function adminLoginPage()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            return redirect('/admin-portal');
        } else {
            return view('admin-portal/login');
        }
    }

    public function createPationPage()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            return view('admin-portal/users/create-patient');
        } else {

            return redirect('/ portal-login');
        }
    }

    public function viewPationListPage()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $patientList = $this->user->getByUserCategory('patient');
            return view('admin-portal/users/view-patient', ['patientList' => $patientList]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function editPatient()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $patientData = $this->user->getById(request()->get('id'));
            return view('admin-portal/users/edit-patient', ['patientData' => $patientData]);
        } else {

            return redirect('/ portal-login');
        }
    }



    public function updateUser(Request $request)
    {

        try {
            $userData = array(
                'first_name' => strtolower($request->post('first_name')),
                'last_name' => strtolower($request->post('last_name')),
                'email' => $request->post('email'),
                'nic' => strtolower($request->post('nic')),
                'mobile' => trim($request->post('mobile'), "0"),
                'date_of_birth' => $request->post('dob'),
                'gender' => strtolower($request->post('gender')),
            );

            $store = $this->user->updateUser($userData, $request->post('id'));
            if ($store) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully saved";
                $response[0]['mobile'] = $request->post('mobile');
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function createReceptionist()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            
            return view('admin-portal/users/add-user');
        } else {

            return redirect('/ portal-login');
        }
    }

    
    public function registerUser(Request $request){
        try {
            $userData = array(
                'first_name' => strtolower($request->post('first_name')),
                'last_name' => strtolower($request->post('last_name')),
                'email' => $request->post('email'),
                'user_role' => 'receptionist',
                'mobile' => trim($request->post('mobile'), "0"),
                'created_at' => date('Y-m-d H:i:s'),
                'password' =>  Hash::make($request->post('password')),
            );

            $store = $this->user->insert($userData);
            if ($store) {
              
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully saved";
                
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function viewUserListPage(){

        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $userlist = $this->user->getByUserCategory('receptionist');
            return view('admin-portal/users/user-list',['userlist' => $userlist]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function editUser()
    {
        if (Auth::check() && session()->get('user_role_type') == 'admin') {
            $userData = $this->user->getById(request()->get('id'));
            return view('admin-portal/users/edit-user', ['userData' => $userData]);
        } else {

            return redirect('/ portal-login');
        }
    }

    public function updateUserAdmin(Request $request)
    {

        try {
            if($request->post('password') != ''){
                $userData = array(
                    'first_name' => strtolower($request->post('first_name')),
                    'last_name' => strtolower($request->post('last_name')),
                    'email' => $request->post('email'),
                    'mobile' => trim($request->post('mobile'), "0"),
                    'password' =>  Hash::make($request->post('password')),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }else{
                $userData = array(
                    'first_name' => strtolower($request->post('first_name')),
                    'last_name' => strtolower($request->post('last_name')),
                    'email' => $request->post('email'),
                    'mobile' => trim($request->post('mobile'), "0"),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }
            

            $store = $this->user->updateUser($userData, $request->post('id'));
            if ($store) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully saved";
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function logout(){
        Session::flush();

        Auth::logout();

        return redirect('portal-login');
    }
    
}
