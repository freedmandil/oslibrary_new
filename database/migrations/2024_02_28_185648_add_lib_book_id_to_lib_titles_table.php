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
        Schema::table('lib_titles', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable();

            // Add foreign key constraint
            $table->foreign('book_id')
                ->references('id')
                ->on('lib_books')
                ->onDelete('set null'); // Define the appropriate action on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lib_titles', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['book_id']);

            // Drop the column
            $table->dropColumn('lib_book_id');
        });
    }
};
