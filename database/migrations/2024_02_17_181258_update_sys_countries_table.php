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
            Schema::table('sys_countries', function (Blueprint $table) {
                $table->string('abv')->after('name_en');
                $table->string('abv3')->after('abv');
                $table->string('abv3_alt')->after('abv3')->nullable(true);
                $table->string('code')->after('abv3_alt')->nullable(true);
                $table->string('slug')->after('code');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sys_countries', function (Blueprint $table) {
            //
        });
    }
};
