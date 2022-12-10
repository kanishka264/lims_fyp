<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Admin",
            'last_name' => 'admin',
            'email'=>'admin@gmail.com',
            'user_role'=>'admin',
            'mobile'=>'',
            'password'=> Hash::make('123456')
        ]); 
    }
}