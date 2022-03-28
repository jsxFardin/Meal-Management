<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $email = Str::random(10) . '@gmail.com';
        DB::table('users')->insert([
            'name' => Str::random(10),
            'username' => $email,
            'email' => $email,
            'phone' => '01862843193',
            'status' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
