<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    /* Define the default state for the Loan factory.
       Generates realistic loan data including amount, interest rate, and duration. */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 1000, 10000), // Loan amount between 1000 and 10000
            'interest_rate' => $this->faker->randomFloat(2, 2, 10), // Interest rate between 2% and 10%
            'duration' => $this->faker->numberBetween(6, 24), // Loan duration in months (6 to 24)
            'lender_id' => User::factory(),
            'borrower_id' => User::factory(),
        ];
    }
}
