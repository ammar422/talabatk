<?php

namespace Database\Factories;

use App\Models\DeliveryBoy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryBoyWallet>
 */
class DeliveryBoyWalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'deliveryBoy_id' => DeliveryBoy::inRandomOrder()->first()->id,
            'balance' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
