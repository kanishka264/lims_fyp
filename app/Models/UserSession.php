<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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

    public function addItemToCart($product_id){
        if(Session::get('cart_item') == null){
            $productArray = [];
            array_push($productArray,$product_id);
        }else{
            $productArray = Session::get('cart_item');
            array_push($productArray,$product_id);
        }

        session(['cart_item' => $productArray]);
        session()->save();

        return (Session::get('cart_item'));
    }
}
