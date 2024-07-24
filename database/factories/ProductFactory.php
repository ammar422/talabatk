<?php

namespace Database\Factories;

use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
        $vendor = Vendor::where('main_category_id',$mainCategory->id)->where('sub_category_id' , $subCategory->id)->inRandomOrder()->first();


        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'sub_category_id' => $subCategory->id,
            'main_category_id' => $mainCategory->id,
            'vendor_id' => $vendor->id,
            // 'brand_id' => null
        ];
    }
}
