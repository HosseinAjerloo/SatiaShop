<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('status_bank', ['requested', 'failed', 'finished'])->nullable();
            $table->decimal('total_price', 20, 3)->default(0);
            $table->decimal('discount_collection', 20, 3)->nullable()->default(0);
            $table->decimal('discount_price', 20, 3)->nullable()->default(0);
            $table->decimal('commission',20,3)->nullable()->default(0);
            $table->decimal('final_price', 20, 3)->default(0);
            $table->enum('status', ['paid', 'not_paid'])->nullable();
            $table->enum('reside_type', ['sell', 'recharge'])->nullable();
            $table->enum('type', ['reside', 'invoice'])->default('reside');
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
        Schema::dropIfExists('resids');
    }
};
