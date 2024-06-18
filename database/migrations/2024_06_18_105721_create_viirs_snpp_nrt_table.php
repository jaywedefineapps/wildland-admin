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
        Schema::create('viirs_snpp_nrt', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('bright_ti4');
            $table->string('scan');
            $table->string('track');
            $table->string('acq_date');
            $table->string('acq_time');
            $table->string('satellite');
            $table->string('instrument');
            $table->string('confidence');
            $table->string('version');
            $table->string('bright_ti5');
            $table->string('frp');
            $table->string('daynight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viirs_snpp_nrt');
    }
};
