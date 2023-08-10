<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserRoleTableSeeder::class);
         \App\Models\Category::factory()->create();
         \App\Models\Brand::factory(10)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\Customer::factory(10)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\OrderItem::factory(10)->create();
        \App\Models\Cart::factory(10)->create();
        \App\Models\CartItem::factory(10)->create();

       
    }
}
