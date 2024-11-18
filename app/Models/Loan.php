<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // Define fillable attributes to allow mass assignment for these fields
    protected $fillable = ['amount', 'interest_rate', 'duration', 'lender_id', 'borrower_id'];

    // Define a relationship with the User model for the lender of the loan.
    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    // Define a relationship with the User model for the borrower of the loan.

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class, 'loan_id');
    }
}
