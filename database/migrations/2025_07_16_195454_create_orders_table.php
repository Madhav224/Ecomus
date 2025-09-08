<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('order_status')->nullable();
            $table->foreign('order_status')->references('id')->on('order_statuses');

            $table->enum('payment_type', ['cod', 'razorpay', 'paypal'])->default('cod');
            $table->enum('payment_status', ['pending', 'failed', 'complete'])->default('pending');


            $table->integer('sub_amount');
            $table->integer('discount_amount')->nullable();
            $table->integer('tax_amount')->nullable();
            $table->integer('total_amount');

            $table->string('status_message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
