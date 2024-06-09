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
        Schema::create('camera_screenshots', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('camera_id');
            $table->foreign('camera_id')->references('id')->on('user_cameras')->onDelete('cascade');
            $table->string('image');
            $table->integer('channel_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_screenshots');
    }
};
