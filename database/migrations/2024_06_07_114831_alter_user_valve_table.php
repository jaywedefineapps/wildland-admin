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
        Schema::table('user_valve', function (Blueprint $table) {
            $table->string('address_id')->nullable();
            $table->integer('is_visible')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_valve', function (Blueprint $table) {
            $table->dropColumn('address_id');
            $table->dropColumn('is_visible');
        });
    }
};
