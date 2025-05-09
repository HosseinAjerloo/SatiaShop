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
        Schema::create('transmissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('finance_id')->nullable()->constrained('finance_transactions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('payee_account_name')->nullable();
            $table->string('payee_account')->nullable();
            $table->string('payer_account')->nullable();
            $table->decimal('payment_amount',10,1)->nullable();
            $table->string('payment_batch_num')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transmissions');
    }
};
