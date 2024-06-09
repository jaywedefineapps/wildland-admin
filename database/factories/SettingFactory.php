<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'app_name' => 'Admin',
            'support_email' => "test",
            'stripe_secret_key' => "test",
            'stripe_publish_key' => "test",
            'smtp_host' => "test",
            'smtp_username' => "test",
            'smtp_password' => "test",
            'smtp_port' => "test",
            'aws_access_key' => "test",
            'aws_secret_key' => "test",
            'aws_region' => "test",
            'aws_bucket_name' => "test",
            'twilio_account_id' => "test",
            'twilio_token' => "test",
            'twilio_from' => "test",
            'notification_url' => "test",
            'notification_key' => "test",
            'pagination_size' => "10",
            'app_version' => "1.0",
            'ios_app_version' => "1.0",
            'currency' => 1,
            'commision' => 2,
            'home_page_size' => 4,
            'transaction_charge' => 1,
        ];
    }
}
