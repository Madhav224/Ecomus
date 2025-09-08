<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();

            $table->string('phone_no')->unique();
            // $table->timestamp('phone_verified_at')->nullable();

            $table->unsignedBigInteger('user_city_id')->nullable();
            $table->foreign('user_city_id')->references('id')->on('module_cities')->onDelete('set null');

            $table->unsignedBigInteger('user_state_id')->nullable();
            $table->foreign('user_state_id')->references('id')->on('module_states')->onDelete('set null');

            $table->unsignedBigInteger('user_country_id')->nullable();
            $table->foreign('user_country_id')->references('id')->on('module_countries')->onDelete('set null');

            $table->integer('pincode')->nullable();

            $table->rememberToken();
            // $table->enum('phone_verified', ['verified', 'not_verified'])->default('not_verified');
            $table->enum('email_verified', ['verified', 'not_verified'])->default('not_verified');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->string('status_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
