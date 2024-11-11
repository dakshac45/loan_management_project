<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    /* Display the specified loan based on its ID. 
    Returns a JSON response with loan details or 404 if not found. */

    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        return response()->json($loan);
    }   

    // Retrieve and display a list of all loan records.

    public function index()
    {
        $loans = Loan::all();
        return response()->json($loans);
    }

    /*Store a new loan record in the database. 
    Validates the incoming request and returns the created loan as JSON. */

    public function store(Request $request)
    {
        // Validate the incoming request datas
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'duration' => 'required|integer',
            'lender_id' => 'required|exists:users,id',
            'borrower_id' => 'required|exists:users,id',
        ]);

        // Create the loan record in the database with lender_id and borrower_id
        $loan = Loan::create([
            'amount' => $validated['amount'],
            'interest_rate' => $validated['interest_rate'],
            'duration' => $validated['duration'],
            'lender_id' => $validated['lender_id'],
            'borrower_id' => $validated['borrower_id'],
        ]);
        
        return response()->json($loan, 201);
    }

    /* Update an existing loan based on its ID.
       Validates lender and request data, ensuring only the lender can update.*/

    public function update(Request $request, string $id, $lender_id)
    {
        // Check if the lender exists in the database
        $lender = User::find($lender_id);
        if (!$lender) {
            return response()->json(['error' => 'User does not exist'], 404);
        }

        $loan = Loan::findOrFail($id);

        // Ensure only the lender who created the loan can update it
        if ($loan->lender_id != $lender_id) {
            return response()->json(['error' => 'Unauthorized - Only the lender  of the loan can edit this loan'], 403);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'duration' => 'required|integer',
            'lender_id' => 'required|exists:users,id',
            'borrower_id' => 'required|exists:users,id',
        ]);

        $loan->update($validated);

        return response()->json($loan);
    }

    /* Delete a specific loan by its ID.
       Ensures only the lender who created the loan can delete it.*/

    public function destroy(string $id, $lender_id)
    {
        // Check if the lender exists in the database, return 404 if not
        $lender = User::find($lender_id);
        if (!$lender) {
            return response()->json(['error' => 'User does not exist'], 404);
        }

        $loan = Loan::findOrFail($id);

        // Ensure only the lender who created the loan can delete it
        if ($loan->lender_id != $lender_id) {
            return response()->json(['error' => 'Unauthorized - Only the lender of the loan can delete this loan'], 403);
        }

        $loan->delete();

        return response()->json(['message' => 'Loan deleted successfully.']);
    }
}
