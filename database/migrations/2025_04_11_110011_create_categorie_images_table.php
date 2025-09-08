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
        Schema::create('categorie_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id')->nullable(false);
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->enum('categorie_image_type',['mobile','desktop','banner'])->default('desktop')->nullable(false);
            $table->string('categorie_image_path')->nullable(false);
            $table->integer('sort_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_images');
    }
};
