<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use HasFactory;

    // Define fillable attributes to allow mass assignment for these fields
    protected $fillable = ['amount', 'loan_id'];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

}
