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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('نام کاربر');
            $table->string('family')->nullable()->comment('نام خانوادگی');
            $table->string('organizationORcompanyName')->nullable()->comment('نام شرکت یا سازمان');
            $table->string('national_code')->nullable()->unique()->comment('کدملی');
            $table->string('username')->nullable()->comment('نام کاربری');;
            $table->string('mobile')->nullable()->comment('شماره موبایل کاربر');
            $table->string('tel')->nullable()->comment('شماره ثابت کاربر');
            $table->string('address')->nullable()->comment('آدرس کاربر');
            $table->string('email')->nullable()->unique()->comment('ایمیل کابر');
            $table->string('password')->nullable()->comment('کلمه عبور کاربر');
            $table->tinyInteger('is_active')->default(1)->comment('فعال یا عدم فعال بودن کاربر');
            $table->enum('type',['admin','customer'])->default('customer')->comment('نوع کاربر آیا کاربر ادمین است یا کشتری ساده');
            $table->enum('customer_type',['juridical_person','natural_person'])->nullable()->comment('کاربر شخص حقیقی است یا حقوقی');
            $table->string('registration_number')->nullable()->comment('شماره ثبت');
            $table->string('national_id')->nullable()->comment('شناسه ملی');
            $table->string('representative_name')->nullable()->comment('نام نماینده');
            $table->string('economic_code')->nullable()->comment('کد اقتصادی');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
