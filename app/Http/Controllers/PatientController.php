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
use App\Models\Orders;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class PatientController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->common = new Common();
        $this->sms = new SMS();
        $this->session = new UserSession();
        $this->order = new Orders();
    }

    public function patientPortal(){
        if(Auth::check()){
            $userData = request()->session()->get('user_data');
            $loggedUser = $this->user->getById($userData['id']);
            $orderHistory = $this->order->getTestOrdersByUserId($userData['id']);
            return view('patient-portal.my-account',['loggedUser'=>$loggedUser,'orderHistory'=>$orderHistory]);
        }else{
            return redirect('/login');
        }
        

    }


    //
}
