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
        Schema::create('lib_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id');
            $table->bigInteger('location_id');
            $table->bigInteger('locassign_id');
            $table->string('barcode');
            $table->dateTime('timestamp');
            $table->foreign('book_id')->references('id')->on('lib_books');
            $table->foreign('locassign_id')->references('id')->on('loc_locations');
            $table->foreign('location_id')->references('id')->on('loc_assignments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_logs');
    }
};
