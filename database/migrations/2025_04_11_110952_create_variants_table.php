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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_name')->nullable(false);
            $table->unsignedBigInteger('variant_parent_id')->nullable();
            $table->foreign('variant_parent_id')->references('id')->on('variants')->onDelete('cascade');
            $table->enum('is_color', ['0', '1'])->default('0');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
