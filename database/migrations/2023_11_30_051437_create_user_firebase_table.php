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
        Schema::create('user_firebase', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('device_id')->nullable();
            $table->string('device_name')->nullable();
            $table->string('fcm_token');
            $table->string('user_id');
            $table->enum('platform', ['android','ios']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_firebase');
    }
};
