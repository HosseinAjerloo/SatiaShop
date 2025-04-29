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
        Schema::create('reside_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reside_id')->constrained('resides')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('price',20,3)->nullable();
            $table->integer('amount')->default(1);
            $table->enum('type', ['service', 'goods'])->nullable();
            $table->enum('status', ['used', 'recharge','sell'])->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resid_items');
    }
};
