<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;

    public function getLastOrderId(){
        $results = DB::table('orders')
            ->orderBy('id', 'DESC')
            ->first();
        return $results;
    }

    public function saveOrder($data){
        $results = DB::table('orders')->insertGetId($data);
        return $results;
    }

    public function saveTestOrder($data){
        $results = DB::table('test_orders')->insertGetId($data);
        return $results;
    }

    public function updateTestOrder($data,$id){
        $results = DB::table('test_orders')->where('id',$id)->update($data);
        return $results;
    }

    public function updateOrder($data,$id){
        $results = DB::table('orders')->where('id',$id)->update($data);
        return $results;
    }
}
