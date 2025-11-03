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
            $table->string('name');
            // $table->string('user_name')->unique()->nullable();
            $table->string('company_name')->unique()->nullable();
            $table->string('staff_id')->unique()->nullable();
            $table->decimal('hourly_charges', 8, 2)->default(0.00);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('avatar')->default('default/avatar.png');
            $table->string('email')->unique();
            $table->timestamp('verified_at')->useCurrent()->nullable();
            $table->string('password');
            $table->enum('user_type',['super_admin', 'admin', 'staff'])->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
