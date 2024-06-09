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
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('aws_access_key');
            $table->dropColumn('aws_secret_key');
            $table->dropColumn('aws_region');
            $table->dropColumn('aws_bucket_name');
            $table->dropColumn('twilio_account_id');
            $table->dropColumn('twilio_token');
            $table->dropColumn('twilio_from');
            $table->dropColumn('notification_url');
            $table->dropColumn('notification_key');
            $table->dropColumn('stripe_secret_key');
            $table->dropColumn('stripe_publish_key');
            $table->dropColumn('commision');
            $table->dropColumn('transaction_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('aws_access_key');
            $table->string('aws_secret_key');
            $table->string('aws_region');
            $table->string('aws_bucket_name');
            $table->string('twilio_account_id');
            $table->string('twilio_token');
            $table->string('twilio_from');
            $table->string('notification_url');
            $table->string('notification_key');
            $table->string('stripe_secret_key');
            $table->string('stripe_publish_key');
            $table->float('commision', 10, 2);
            $table->float('transaction_charge', 10, 2);
        });
    }
};
