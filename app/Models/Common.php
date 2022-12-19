<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Common extends Model
{
    use HasFactory;

    public function getOtp()
    {
        $randomNo = rand(1000, 9999);
        return $randomNo;
    }

    public function generateBarcode($id)
    {
        $randomNo = rand(10000000000, 99999999999);
        $barcode = $randomNo . $id;
        return $barcode;
    }

    public function age($bithdate)
    {
        return Carbon::parse($bithdate)->age;
    }
    static function getLoggedUser(){
        $userId = Auth::user()->id;
        $user = new User();
        $user_data = $user->getById($userId);
        return  $user_data;
    }
}
