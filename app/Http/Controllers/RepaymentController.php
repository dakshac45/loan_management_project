<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{

    public function index()
    {
        $repayments = Repayment::all();
        return response()->json($repayments);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'loan_id' => 'required|exists:loans,id',
        ]);
        
        $loan = Loan::findOrFail($validated['loan_id']);       

    // Check if the new repayment amount exceeds the remaining loan balance
    if ($validated['amount'] > $loan->amount) {
        return response()->json([
            'message' => 'The repayment amount exceeds the remaining loan balance.',
        ], 422); // 422 Unprocessable Entity
    }

    // Create the repayment record in the database
    $repayment = $loan->repayments()->create([
        'amount' => $validated['amount'],
    ]);

    return response()->json($repayment, 201);
    }

}
