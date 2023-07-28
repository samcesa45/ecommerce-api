<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {

            //Array of parent categories
    $parentCategories = ['women','men','kids','boys','girls'];

    foreach($parentCategories as $parentName) {
    $parentCategoryId = Category::create([
    'name' => $parentName,
    'is_hidden' => $this->faker->boolean,
    'parent_id' =>  null,
    'created_at' => $this->faker->date('Y-m-d H:i:s'),
    'updated_at' => $this->faker->date('Y-m-d H:i:s'),
    ])->id;

    //Random number of child categories for each parent
    $numChildren = $this->faker->numberBetween(2,5);

    for($i = 0; $i < $numChildren; $i++) {
    //create the child category
    Category::create([
        'name'=> $this->faker->unique()->word,
        'parent_id' => $parentCategoryId,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
    'updated_at' => $this->faker->date('Y-m-d H:i:s'),

    ]);
    }
    
}
    return [
        'name'=>  $numChildren,
            'parent_id' => $parentCategoryId,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
    ];
 
    }
}
