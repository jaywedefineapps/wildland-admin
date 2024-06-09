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
        Schema::create('user_cameras', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('address_id');
            $table->foreign('address_id')->references('id')->on('address')->onDelete('cascade');
            $table->integer('port');
            $table->string('ip_address');
            $table->string('device_name');
            $table->string('user_name');
            $table->string('password');
            $table->integer('channel_count');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cameras');
    }
};
