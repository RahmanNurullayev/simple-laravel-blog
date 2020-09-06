<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'Rehman Nurullayev',
            'email'=>'nurullayevrehman@gmail.com',
            'password'=>bcrypt(1234567)
             ]);
    }
}
