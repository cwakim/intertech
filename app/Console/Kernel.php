<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Domain as Domain;
use App\Post as Post;
use App\Jobs\crawlJob as crawlJob;
use App\Jobs\sentimentJob as sentimentJob;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $domains = Domain::all();

        foreach ($domains as $domain)
        {
            foreach ($domain->pages as $page)
            {
                $schedule->job(new crawlJob($page))->cron($page->frequency);
            }
        }

        $schedule->job(new sentimentJob())->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
