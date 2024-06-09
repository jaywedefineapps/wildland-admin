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
        Schema::create('otp_verify', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('verification_type');
            $table->string('user_type');
            $table->integer('otp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verify');
    }
};
