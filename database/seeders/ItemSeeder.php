<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $subCategories = SubCategory::all();
        $conditions = ['New', 'Like New', 'Good', 'Fair', 'Poor'];

        foreach ($users as $user) {
            // Create 3-5 items for each user
            $numItems = rand(3, 5);

            for ($i = 0; $i < $numItems; $i++) {
                Item::create([
                    'user_id' => $user->id,
                    'title' => fake()->words(3, true),
                    'description' => fake()->sentence(),
                    'category_id' => $subCategories->random()->category_id,
                    'sub_category_id' => $subCategories->random()->id,
                    'estimated_value' => fake()->randomFloat(2, 100, 10000),
                    'condition' => $conditions[array_rand($conditions)],
                    'photos' => [fake()->imageUrl()],
                ]);
            }
        }
    }
}
