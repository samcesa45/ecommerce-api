<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'telephone' => $this->faker->numberBetween(0, 100),
            'profile_image_url' => $this->faker->imageUrl(100, 100,'jpg'),
            'address' => $this->faker->word,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
