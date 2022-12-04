<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class UserSession extends Model
{
    use HasFactory;

    public function setPatient($data){
        $userdata = array(
            'id' => $data->id,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'mobile' => $data->mobile,
            'role' => $data->user_role
        );
        session(['user_data' => $userdata]);
    }
}
