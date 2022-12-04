<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabTestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lab_test_type')->insert([
            'test_title' => "polymerase chain reaction",
            'test_code' => 'pcr',
            'test_field'=>'dedected',
            'active'=>1,
            'amount'=>3000,
            'report_template'=>'pcr',
            'image_name' => 'pcr.jpg'
        ]); 
    }
}
