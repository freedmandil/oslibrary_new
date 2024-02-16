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
        Schema::create('lbl_labels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            $table->unsignedBigInteger('bg_color_id');
            $table->unsignedBigInteger('txt_color_id');
            $table->string('label_type');
            $table->dateTime('label_created_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lbl_labels');
    }
};
