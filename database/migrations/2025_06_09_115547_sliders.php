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
        //
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('heading_text');
            $table->string('sub_heading_text');
            $table->string('image');
            $table->enum('link_type', ['product', 'category','link'])->default('product');
            $table->string('link');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('sliders');
    }
};
