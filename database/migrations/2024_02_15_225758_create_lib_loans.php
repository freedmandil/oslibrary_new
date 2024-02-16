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
        Schema::create('lib_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); // Reference to the users table
            $table->unsignedBigInteger('book_id'); // Reference to the books table
            $table->dateTime('check_out_date');
            $table->dateTime('due_date');
            $table->dateTime('check_in_date')->nullable(); // Nullable because the book may not yet be returned
            $table->boolean('is_overdue')->default(false); // This can be dynamically determined but also stored for quick lookup
            $table->text('notes')->nullable(); // Any additional notes about the loan
            $table->integer('renewal_count')->default(0); // Tracks how many times a loan has been renewed

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('usr_users');
            $table->foreign('book_id')->references('id')->on('lib_books');

            // Indexes
            $table->index('user_id');
            $table->index('book_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_loans');
    }
};
