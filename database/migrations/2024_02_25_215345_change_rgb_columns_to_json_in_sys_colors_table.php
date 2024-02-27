<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sys_colors', function (Blueprint $table) {
            // Change the columns to JSON type
            $table->json('color_fg_rgb')->change();
            $table->json('color_bg_rgb')->change();
            $table->json('color_txt_rgb')->change();
        });
    }

    public function down()
    {
        Schema::table('sys_colors', function (Blueprint $table) {
            // Optionally, revert the columns back to varchar(255) in the down method
            $table->string('color_fg_rgb', 255)->change();
            $table->string('color_bg_rgb', 255)->change();
            $table->string('color_txt_rgb', 255)->change();
        });
    }
};
