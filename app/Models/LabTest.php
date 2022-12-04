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
}
