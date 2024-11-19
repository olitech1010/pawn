<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $statuses = ['Read', 'Unread'];

        foreach ($users as $user) {
            // Create 3-6 notifications for each user
            $numNotifications = rand(3, 6);

            for ($i = 0; $i < $numNotifications; $i++) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => fake()->sentence(4),
                    'message' => fake()->paragraph(),
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}
