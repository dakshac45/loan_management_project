<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/* Seed the users table with 10 dummy users.
   Each user has a unique name and email with a hashed password. */

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
