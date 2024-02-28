<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('lib_books', function (Blueprint $table) {
            $table->dropForeign(['book_title_id']);

            $table->dropColumn('book_title_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('lib_books', function (Blueprint $table) {
            $table->unsignedBigInteger('book_title_id')->nullable()->after('id');
            // If there was a foreign key constraint, you should also add it back here
            $table->foreign('book_title_id')->references('id')->on('lib_titles');

        });

    }
};
