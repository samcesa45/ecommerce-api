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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->integer('qty');
            $table->integer('qty_uom')->default(1);
            $table->decimal('final_unit_price',8,2);
            $table->integer('unit_discount_pct');
            $table->string('image_url');
            $table->string('status');
            $table->integer('rating_score')->default(0);
            $table->integer('final_total_rating')->default(0);
            $table->foreignUuid('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignUuid('brand_id')->nullable()->references('id')->on('brands')->onDelete('cascade');
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
