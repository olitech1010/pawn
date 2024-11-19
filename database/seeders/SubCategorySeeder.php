<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $subCategories = [
            'Electronics' => [
                'Smartphones',
                'Laptops',
                'Tablets',
                'Cameras',
                'Gaming Consoles'
            ],
            'Jewelry' => [
                'Gold',
                'Silver',
                'Diamonds',
                'Precious Stones',
                'Necklaces'
            ],
            'Watches' => [
                'Luxury Watches',
                'Smart Watches',
                'Vintage Watches',
                'Sports Watches'
            ],
            'Musical Instruments' => [
                'Guitars',
                'Pianos',
                'Drums',
                'Violins'
            ],
            'Art' => [
                'Paintings',
                'Sculptures',
                'Photography',
                'Digital Art'
            ]
        ];

        foreach ($subCategories as $categoryName => $subs) {
            $category = Category::where('name', $categoryName)->first();
            foreach ($subs as $subName) {
                SubCategory::create([
                    'category_id' => $category->id,
                    'name' => $subName
                ]);
            }
        }
    }
}
