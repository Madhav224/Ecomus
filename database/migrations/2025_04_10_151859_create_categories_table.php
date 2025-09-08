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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_name')->nullable(false);
            $table->string('categorie_slug')->unique()->nullable(false);
            $table->string('categorie_description')->nullable();
            $table->unsignedBigInteger('categorie_parent_id')->nullable();
            $table->foreign('categorie_parent_id')->references('id')->on('categories')->onDelete('set null');
            $table->integer('categorie_sort_order')->default(0);
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
