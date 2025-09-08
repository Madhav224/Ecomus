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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable(false);
            $table->string('product_slug')->unique()->nullable(false);
            $table->string('product_sku_code')->unique()->nullable(false);

            $table->unsignedBigInteger('product_categorie_id')->nullable();
            $table->foreign('product_categorie_id')->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->foreign('product_brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->string('product_short_description')->nullable();
            $table->longText('product_long_description')->nullable();
            $table->longText('product_details')->nullable();
            $table->longText('product_additional_details')->nullable();

            $table->string('product_thumbnail_image')->nullable();
            $table->longText('product_images')->nullable();

            $table->integer('product_mrp')->nullable(false);
            $table->integer('product_price')->nullable(false);
            $table->integer('product_discount')->nullable(false);

            $table->integer('product_stock')->nullable(false);
            $table->integer('views')->default(null);


            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
