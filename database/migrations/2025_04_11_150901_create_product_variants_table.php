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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->text('variant_parent_id')->nullable(false);
            // $table->foreign('variant_parent_id')->references('id')->on('variants')->onDelete('cascade');

            $table->longText('variant_combination')->nullable(false);
            $table->longText('variant_ids')->nullable(false);

            $table->string('product_variant_skucode')->nullable();
            $table->string('product_variant_youtube_link')->nullable();

            $table->string('product_variant_thumbnail_image')->nullable();
            $table->longText('product_variant_images')->nullable();

            $table->integer('product_variant_mrp')->nullable(false);
            $table->integer('product_variant_price')->nullable(false);
            $table->integer('product_variant_discount')->nullable(false);

            $table->integer('product_variant_stock')->nullable(false);

            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
