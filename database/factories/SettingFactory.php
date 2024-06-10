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
            'smtp_host' => "test",
            'smtp_username' => "test",
            'smtp_password' => "test",
            'smtp_port' => "test",
            'pagination_size' => "10",
            'app_version' => "1.0",
            'ios_app_version' => "1.0",
            'currency' => 1,
            'home_page_size' => 4,
        ];
    }
}
