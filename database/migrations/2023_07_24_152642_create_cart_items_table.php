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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('qty')->default(0);
            $table->string('qty_uom');
            $table->decimal('final_unit_price',8,2)->default(0.0);
            $table->decimal('unit_discount_pct',8,2)->default(0.0);
            $table->string('status');
            $table->foreignUuid('cart_id')->reference('id')->on('carts')->onDelete('cascade');
            $table->foreignUuid('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
