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
class PatientController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->common = new Common();
        $this->sms = new SMS();
        $this->session = new UserSession();
    }

    public function patientPortal(){
        dd(request()->session()->get('user_data'));
    }

    //
}
