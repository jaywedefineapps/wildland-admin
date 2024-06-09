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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('app_name');
            $table->string('support_email');
            $table->string('stripe_secret_key');
            $table->string('stripe_publish_key');
            $table->string('smtp_host');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('smtp_port');
            $table->string('aws_access_key');
            $table->string('aws_secret_key');
            $table->string('aws_region');
            $table->string('aws_bucket_name');
            $table->string('twilio_account_id');
            $table->string('twilio_token');
            $table->string('twilio_from');
            $table->string('notification_url');
            $table->string('notification_key');
            $table->integer('pagination_size');
            $table->string('app_version');
            $table->string('ios_app_version');
            $table->string('currency');
            $table->float('commision', 10, 2);
            $table->float('transaction_charge', 10, 2);
            $table->integer('home_page_size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
