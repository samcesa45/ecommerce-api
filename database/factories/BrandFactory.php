<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['adidas','adidas Originals','Blend','Boutique Moshino','Champion','Diesel','Jack & Jones','Naf Naf','Red Valentino','s.Oliver'])
        ];
    }
}
