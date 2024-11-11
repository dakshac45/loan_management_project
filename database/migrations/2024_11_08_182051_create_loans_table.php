<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations to create the loans table.
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('duration');

        // Check if the lender_id column already exists
        if (!Schema::hasColumn('loans', 'lender_id')) {
            $table->unsignedBigInteger('lender_id');
        }

        // Check if the borrower_id column already exists
        if (!Schema::hasColumn('loans', 'borrower_id')) {
            $table->unsignedBigInteger('borrower_id');
        }

        // Timestamps for created_at and updated_at
        $table->timestamps();
        });
    }

    // Reverse the migrations to drop the loans table.
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
