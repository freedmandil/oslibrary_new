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
        Schema::table('sys_languages', function (Blueprint $table) {
            $table->string('lan_code', 2)->after('name_he'); // Assuming you want to place it after the name_he column.
        });
    }

    public function down()
    {
        Schema::table('sys_languages', function (Blueprint $table) {
            $table->dropColumn('lan_code');
        });
    }
};
