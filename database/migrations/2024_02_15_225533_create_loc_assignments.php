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
        Schema::create('loc_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('color_id');
            $table->string('ref_code', 5);
            $table->tinyInteger('display_code')->default(1);
            $table->integer('starting_number');
            $table->integer('ending_number');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('color_id')->references('color_id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loc_assignments');
    }
};
