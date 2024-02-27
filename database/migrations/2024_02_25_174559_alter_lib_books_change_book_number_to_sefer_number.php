<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lib_books', function (Blueprint $table) {
            // Step 1: Rename 'shelf_number' to 'shelf_number_id'
            $table->renameColumn('book_number', 'sefer_number');
        });

        // Ensure that the change method is called in a separate Schema::table call
        // This is necessary as Laravel does not directly support changing and renaming in the same Schema::table call
        Schema::table('lib_books', function (Blueprint $table) {
            // Step 2: Change the 'shelf_number_id' column type if necessary and add the foreign key constraint
            $table->integer('sefer_number',false,true)->change();
        });
    }

    public function down()
    {
        Schema::table('lib_books', function (Blueprint $table) {
            // Drop the foreign key before renaming the column back
            $table->renameColumn('sefer_number', 'book_number');
            // Optionally, revert any column type changes if you made them during the up() method
        });
    }
};
