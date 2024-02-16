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
        Schema::create('sys_states', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name_en');
            $table->string('short_en', 2);
            $table->integer('country_id', 2);
            $table->foreign('country_id')->references('id')->on('sys_countries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_state');
    }
};