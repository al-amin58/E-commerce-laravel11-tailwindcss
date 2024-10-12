<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * $table->json('product_images');
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_category')->constrained('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('product_title');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 5, 2)->nullable();
            $table->string('discount_percentage')->nullable();
            $table->string('quantity');
            $table->string('sku');
            $table->text('short_description');
            $table->text('full_description');
            $table->string('thumbnail_image');
            $table->enum('status', ['active', 'inactive']);
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
