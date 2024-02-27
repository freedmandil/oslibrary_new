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
    public function up()
    {
        Schema::table('usr_users', function (Blueprint $table) {
            // Add the language_id column
            $table->unsignedBigInteger('language_id')->nullable(); // Adjust 'some_column' as needed

            // Add foreign key constraint
            $table->foreign('language_id')->references('id')->on('sys_languages')
                ->onDelete('set null'); // Or 'cascade', 'restrict', etc., depending on your requirements
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usr_users', function (Blueprint $table) {
            // Remove the foreign key constraint
            $table->dropForeign(['language_id']);

            // Remove the language_id column
            $table->dropColumn('language_id');
        });
    }
};
