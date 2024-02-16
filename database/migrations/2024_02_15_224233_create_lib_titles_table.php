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
        Schema::create('lib_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_title');
            $table->string('book_subtitle')->nullable();
            $table->string('book_sub_subtitle')->nullable();
            // Full index for fast match searching
            $table->index('book_title', 'book_title_fulltext_index');
            $table->index('book_subtitle', 'book_subtitle_fulltext_index');
            $table->index('book_sub_subtitle', 'book_sub_subtitle_fulltext_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_titles');
    }
};
