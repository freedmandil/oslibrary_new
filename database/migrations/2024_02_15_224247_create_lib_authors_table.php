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
        Schema::create('lib_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prefix')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('acronym')->nullable();
            $table->string('nickname')->nullable();
            $table->index('last_name', 'last_name_fulltext_index');
            $table->index('first_name', 'first_name_fulltext_index');
            $table->index('acronym', 'acronym_fulltext_index');
            $table->index('nickname', 'nickname_fulltext_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_authors');
    }
};
