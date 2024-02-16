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
        Schema::disableForeignKeyConstraints();

        Schema::table('lib_books', function (Blueprint $table) {
            $table->dropForeign('lib_books_author_id_foreign');
            // The index name usually matches the foreign key name
            $table->dropIndex('lib_books_author_id_foreign');
            $table->dropColumn('author_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('lib_books', function (Blueprint $table) {
            $table->addColumn('author_id');
        });
    }
};
