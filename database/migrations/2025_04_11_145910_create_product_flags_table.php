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
        Schema::create('product_flags', function (Blueprint $table) {
            $table->id();
            $table->string('flag_name')->nullable(false);
            $table->string('batch_color')->nullable(false);
            $table->longText('product_id')->nullable(false);
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_flags');
    }
};
