<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat user admin untuk login
        User::create([
            'name' => 'Human',
            'email' => 'stockopname@platinumceramics.com',  // Ganti dengan email yang diinginkan
            'password' => Hash::make('password'),  // Ganti dengan password yang diinginkan
        ]);
    }
}
