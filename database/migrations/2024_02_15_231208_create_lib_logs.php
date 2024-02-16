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
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('loc_assign_id');
            $table->string('barcode');
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('lib_books');
            $table->foreign('location_id')->references('id')->on('loc_locations');
            $table->foreign('loc_assign_id')->references('id')->on('loc_assignments');
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
