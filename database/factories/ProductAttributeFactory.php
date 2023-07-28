<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $color_values = ['black','red','grey','orange','green'];
        $size_values = ['XS','S','M','L','XL'];
        $val = null;
        $attribute = $this->faker->randomElement(['colors','size']);

        if($attribute =='colors') {
            $val = $this->faker->randomElement($color_values);
        }else {
            $val = $this->faker->randomElement($size_values);
        }
        return [
         'attribute' => $attribute,
         'value' => $val,
         'product_id' => Product::inRandomOrder()->first()->id ?? NULL,
        ];
    }
}
