<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

/* Seed the loans table with 20 dummy loans.
   Associates each loan with random users as lender and borrower.*/

class LoanSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        for ($i = 1; $i <= 20; $i++) {
            Loan::create([
                'amount' => rand(1000, 10000),
                'interest_rate' => rand(1, 10),
                'duration' => rand(6, 60),
                'lender_id' => $users->random()->id,
                'borrower_id' => $users->random()->id,
            ]);
        }
    }
}
