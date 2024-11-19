<?php

namespace Database\Seeders;

use App\Models\MarketplaceItem;
use App\Models\Item;
use Illuminate\Database\Seeder;

class MarketplaceItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = Item::all();
        $statuses = ['Available', 'Sold'];

        foreach ($items as $item) {
            // 50% chance for an item to be listed in marketplace
            if (rand(0, 1)) {
                MarketplaceItem::create([
                    'item_id' => $item->id,
                    'price' => fake()->randomFloat(2, 100, 20000),
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}
