<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    use HasFactory;

    public function getOtp(){
        return 1234;
    }

    public function generateBarcode($id){
        $randomNo = rand(10000000000, 99999999999);
        $barcode = $randomNo.$id;
        return $barcode;
    }
}
