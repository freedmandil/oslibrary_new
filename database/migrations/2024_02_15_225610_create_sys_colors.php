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
        Schema::create('sys_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_name');
            $table->string('color_fg_hex');
            $table->string('color_bg_hex');
            $table->string('color_txt_hex');
            $table->string('color_fg_rgb');
            $table->string('color_bg_rgb');
            $table->string('color_txt_rgb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_colors');
    }
};
