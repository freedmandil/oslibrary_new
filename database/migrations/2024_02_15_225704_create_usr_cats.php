<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usr_cats', function (Blueprint $table) {
            $table->id();
            $table->string('category_name'); // e.g., Staff, Student
            $table->integer('loan_limit'); // Maximum number of simultaneous loans
            $table->integer('loan_period_days'); // Default loan period in days
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usr_cats');
    }
};
