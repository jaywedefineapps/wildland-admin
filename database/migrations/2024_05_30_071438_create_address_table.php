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
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('user_id');
            $table->string('type');
            $table->string('house_no');
            $table->string('address');
            $table->string('country_id');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('zipcode');
            $table->integer('is_default');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
