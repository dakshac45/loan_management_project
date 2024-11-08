<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::apiResource('loans', LoanController::class);
});