<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
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

     protected $model = Product::class;
    public function definition(): array
  
    {
        $color_values = ['black','red','grey','orange','green'];
        $size_values = ['xs','s','m','l','xl'];
        return [
            'name'=> $this->faker->unique()->name,
            'description' => $this->faker->sentence(5),
            'qty' => $this->faker->randomDigitNotNull,
            'qty_uom' => $this->faker->randomDigitNotNull,
            'final_unit_price' => $this->faker->randomFloat(1,20,80),
            'unit_discount_pct' => $this->faker->numberBetween(20, 100),
            'status' => $this->faker->word,
            'color' => $this->faker->randomElement($color_values),
            'size' => $this->faker->randomElement($size_values),
            'image_url'=> $this->faker->imageUrl(100,100),
            'category_id'=> Category::inRandomOrder()->first()->id,
            'brand_id'=>Brand::inRandomOrder()->first()->id ?? NULL,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
