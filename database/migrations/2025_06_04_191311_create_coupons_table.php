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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name')->unique();
            $table->string('coupon_code')->unique();
            $table->enum('value_type', ['in_percentage', 'in_amount'])->default('in_amount');
            $table->string('value');
            $table->integer('min_amount');
            // $table->integer('max_discount')->nullable();
            $table->date('start_date');
            $table->date('end_date');

            $table->unsignedInteger('use_limit')->default(1);


            $table->enum('for_new_member', ['0', '1'])->default('0');

            $table->enum('user_usage_type', ['once', 'multiple'])->default('once');

            $table->enum('coupon_validate_on', ['cart', 'product', 'category'])->default('cart');
            $table->json('coupon_validate_ids')->nullable();


            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
