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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Link to the cart
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Link to the product
            $table->integer('quantity')->default(1);
            $table->string('total_price')->nullable();
            $table->string('size')->nullable(); // Store size if applicable
            $table->json('colors')->nullable(); // Store colors as JSON
            $table->string('attribute')->nullable(); // Store any additional attributes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
