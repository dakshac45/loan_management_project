<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// Seed the application's database. Calls UserSeeder and LoanSeeder to generate initial data.

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
        UserSeeder::class,
        LoanSeeder::class,
        ]);
    }

}
