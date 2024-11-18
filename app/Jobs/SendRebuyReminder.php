<?php

namespace App\Jobs;

use App\Models\Item;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRebuyReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // The number of minutes before the rebuy deadline to send a reminder
    protected $reminderThreshold = 24 * 60; // 24 hours

    public function __construct()
    {
        // Initialize any properties here if necessary
    }

    public function handle()
    {
        // Get items with rebuy deadlines that are within the threshold (e.g., within 24 hours)
        $items = Item::where('status', 'Rebuying')
            ->where('rebuy_deadline', '>=', Carbon::now())
            ->where('rebuy_deadline', '<=', Carbon::now()->addMinutes($this->reminderThreshold))
            ->get();

        foreach ($items as $item) {
            $user = $item->user;  // Get the user who owns the item

            // Send notification to the user
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Rebuy Deadline Approaching',
                'message' => 'Your item "' . $item->title . '" is approaching its rebuy deadline. Please take action.',
                'status' => 'Unread',
            ]);
        }
    }
}
