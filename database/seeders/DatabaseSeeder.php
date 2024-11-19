<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            ItemSeeder::class,
            TransactionSeeder::class,
            NotificationSeeder::class,
            MarketplaceItemSeeder::class,
        ]);
    }
}
