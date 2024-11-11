<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanTest extends TestCase
{
    // Ensures each test starts with a fresh database
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_loan()
    {
        // Setup: Create a lender and borrower for the test
        $lender = User::factory()->create();
        $borrower = User::factory()->create();

        // Data for creating a loan
        $loanData = [
            'amount' => 1000,
            'interest_rate' => 5,
            'duration' => 12,
            'lender_id' => $lender->id,
            'borrower_id' => $borrower->id,
        ];

        // Execute: Send POST request to create loan
        $response = $this->postJson('api/loans', $loanData);

        // Verify: Assert response status and database entry
        $response->assertStatus(201);
        $this->assertDatabaseHas('loans', $loanData); // Verify loan exists in database
    }

    /** @test */
    public function it_can_show_a_loan()
    {
        $loan = Loan::factory()->create();

        // Send GET request to retrieve loan by ID
        $response = $this->getJson("api/loans/{$loan->id}");

        $response->assertStatus(200);
        $response->assertJson($loan->toArray()); // Verify loan data matches database record
    }

/** @test */
public function it_can_update_a_loan()
{
    $loan = Loan::factory()->create();

    $updatedData = [
        'amount' => 1500,
        'interest_rate' => 7,
        'duration' => 24,
        'lender_id' => $loan->lender_id,
        'borrower_id' => $loan->borrower_id,
    ];

    // Send PUT request to update loan, with lender ID in URL for verification
    $response = $this->putJson("api/loans/{$loan->id}/{$loan->lender_id}", $updatedData);

    $response->assertStatus(200);
    $this->assertDatabaseHas('loans', $updatedData); // Confirm loan was updated in database
}

/** @test */
public function it_can_delete_a_loan()
{
    $loan = Loan::factory()->create();

    // Send DELETE request to remove loan, with lender ID in URL for verification
    $response = $this->deleteJson("api/loans/{$loan->id}/{$loan->lender_id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('loans', ['id' => $loan->id]); // Verify loan is removed from database
}


}
