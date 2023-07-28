<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? NULL,
            'product_id' => Product::inRandomOrder()->first()->id ?? NULL,
            'qty' =>$this->faker->randomDigitNotNull,
            'qty_uom' => $this->faker->randomDigitNotNull,
            'final_unit_price' => $this->faker->randomFloat(2,50,90),
            'unit_discount_pct'=> $this->faker->numberBetween(1,50),
            'status' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
