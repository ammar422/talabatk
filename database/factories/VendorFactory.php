<?php

namespace Database\Factories;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mainCategory = MainCategory::inRandomOrder()->first();
        $subCategory = SubCategory::where('main_category_id', $mainCategory->id)->inRandomOrder()->first();




        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->email(),
            'password' => bcrypt('123456789'),
            'main_category_id' => $mainCategory->id,
            'sub_category_id' => $subCategory->id
        ];
    }
}
