<?php

namespace App\Providers;

use App\Jobs\SendRebuyReminder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Schedule $schedule)
    {
        // Schedule the SendRebuyReminder job to run every hour
        $schedule->job(new SendRebuyReminder)->hourly();
    }
}
