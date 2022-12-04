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
                'mobile' => $request->post('mobile'),
                'date_of_birth' => $request->post('dob'),
                'gender' => strtolower($request->post('gender')),
                'created_at' => date('Y-m-d H:i:s'),
                'password' =>'',
                'remember_token' => md5($otp)
            );

            $store = $this->user->insert($userData);
            if ($store) {
                $sendSms = $this->sms->send($request->post('mobile'),$otp);
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Successfully saved";
                $response[0]['mobile'] = $request->post('mobile');
            }else{
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }

    public function otpPageView(Request $request){
        $mobile = $_GET['mobile'];
        return view('otp');
    }

    public function otpConfirm(Request $request){

        try{
            $mobile = $request->post('mobile');
            $otp = $request->post('otp');
    
            $verify = $this->user->verifyOtp($mobile,$otp);

            if($verify){
                
                $set_login = $this->session->setPatient($verify);
                 
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = "Success";
            }else{
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again";
            }

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        return $response;

    }

    public function loginPageView(Request $request){
        return view('login');
    }

    public function patientLogin(Request $request){
        try {
            $user = $this->user->getByMobile($request->post('mobile'));
            if($user){
               
                $otp = $this->common->getOtp();
                $userData = array(
                    'remember_token' => md5($otp),
                    'updated_at'=> date("Y-m-d H:i:s")
                );
    
                $id = $user->id;
    
                $store = $this->user->updateUser($userData,$id);

                if ($store) {
                    $sendSms = $this->sms->send($request->post('mobile'),$otp);
                    $response[0]['response_code'] = 200;
                    $response[0]['response_text'] = "Successfully saved";
                    $response[0]['mobile'] = $request->post('mobile');
                }else{
                    $response[0]['response_code'] = 400;
                    $response[0]['response_text'] = "Something went wrong. Please try again";
                }
            }else{
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "No account found";
            }
            
        } catch (Throwable $e) {
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }

        return $response;
    }
}
