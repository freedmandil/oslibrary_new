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
        Schema::table('lib_books', function (Blueprint $table) {
            $table->integer('volume')->nullable()->after('book_edition');
            $table->string('volume_name')->nullable()->after('volume');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lib_books', function (Blueprint $table) {
            $table->dropColumn('volume');
            $table->dropColumn('volume_name');
        });
    }
};
