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
        Schema::disableForeignKeyConstraints();

        Schema::create('usr_users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('alt_name')->nullable();
            $table->string('email2')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('zip_post_code')->nullable();
            $table->rememberToken();
            $table->integer('cat_id');
            $table->integer('access_level')->nullable();
            $table->dateTime('date_created')->nullable();
            $table->string('contact_status')->nullable();
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('usr_cats');
            $table->foreign('state_id')->references('id')->on('sys_states');
            $table->foreign('country_id')->references('id')->on('sys_countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
