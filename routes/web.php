<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;


//Default route
Route::get('/', function () {
    return view('welcome');
});

// Route to view all loans (public access)
Route::get('api/loans', [LoanController::class, 'index']);

// Route to view a specific loan by ID (public access)
Route::get('api/loans/{id}', [LoanController::class, 'show']);

// Route to create a new loan (public access)
Route::post('api/loans', [LoanController::class, 'store']);

// Route to update an existing loan, with lender ID verification
Route::put('api/loans/{loan}/{lender_id}', [LoanController::class, 'update']);

// Route to delete an existing loan, with lender ID verification
Route::delete('api/loans/{loan}/{lender_id}', [LoanController::class, 'destroy']);