<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
           'name'=>'admin',
           'email'=>'admin@gmail.com',
           'phone'=>'01700000000',
           'address'=>'Dhaka, Bangladesh',
           'role'=>'admin',
           'password'=>Hash::make('12345')
        ]);
        User::create([
           'name'=>'Customer',
           'email'=>'customer@gmail.com',
           'phone'=>'01700000000',
           'address'=>'Dhaka, Bangladesh',
           'password'=>Hash::make('12345')
        ]);
    }
}
