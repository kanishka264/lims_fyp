<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LabTest extends Model
{
    use HasFactory;

    public function getTestingList(){
        $results = DB::table('lab_test_type')
            ->where('active', '=', 1)
            ->get();
        return $results;
    }

    public function getById($id){
        $results = DB::table('lab_test_type')
            ->where('id', '=', $id)
            ->first();
        return $results;
    }

    public function store($data){
        $results = DB::table('lab_test_type')->insert($data);
        return $results;
    }

    public function updateTest($data,$id){
        $results = DB::table('lab_test_type')->where('id',$id)->update($data);
        return $results;
    }
}
