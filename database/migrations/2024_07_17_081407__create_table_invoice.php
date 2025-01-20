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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('operator_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('status_bank', ['requested', 'failed', 'finished'])->nullable();
            $table->decimal('final_amount', 20, 3)->default(0);
            $table->decimal('discount_collection', 20, 3)->default(0);
            $table->enum('status', ['paid', 'not_paid'])->nullable();
            $table->enum('type_of_business', ['buy', 'sales'])->nullable();
            $table->text('description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
