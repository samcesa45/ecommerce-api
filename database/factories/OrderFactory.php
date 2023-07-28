<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'customer_id' => Customer::inRandomOrder()->first()->id,
           'final_total_price' => $this->faker->randomFloat(2,40,60),
           'total_discount_pct' => $this->faker->numberBetween(1, 20),
           'status' => $this->faker->word,
           'created_at' => $this->faker->date('Y-m-d H:i:s'),
           'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
