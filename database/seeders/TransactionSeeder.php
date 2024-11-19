<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $items = Item::all();
        $types = ['Storage Fee', 'Rebuy Fee', 'Marketplace Sale'];
        $statuses = ['Pending', 'Completed', 'Failed'];

        foreach ($users as $user) {
            // Create 2-4 transactions for each user
            $numTransactions = rand(2, 4);

            for ($i = 0; $i < $numTransactions; $i++) {
                Transaction::create([
                    'user_id' => $user->id,
                    'item_id' => $items->random()->id,
                    'amount' => fake()->randomFloat(2, 50, 5000),
                    'transaction_type' => $types[array_rand($types)],
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}
