<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = User::where('type','freelancer')->get()->toArray();
        $indexCat = array_rand($category);
        $cat = $category[$indexCat]['id'];
        return [
            'service_ids' => '08ce58d2-f4c2-44cf-b187-b974ba43d8be,2822cd37-750f-4da8-b1f2-a650c82435e7',
            'sub_category_id' => '14c32d56-4818-4897-b928-7fd6d7b2d015',
            'name' => Str::random(10),
            'price' => '120', // password
            'note' => Str::random(10),
            'user_id' => $cat
        ];
    }
}
