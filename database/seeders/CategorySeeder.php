<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Jewelry', 'description' => 'Precious metals and stones'],
            ['name' => 'Watches', 'description' => 'Luxury and regular timepieces'],
            ['name' => 'Musical Instruments', 'description' => 'All types of musical instruments'],
            ['name' => 'Art', 'description' => 'Paintings, sculptures, and collectibles'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
