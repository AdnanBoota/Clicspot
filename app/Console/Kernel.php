<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Auth;
use App\User;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\Inspire',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->call(function () {
        $userId['userId'] = "1";
        $userId['templateName'] = "sdfs";
        Mail::send('email.emailTemplate', $userId, function ($message) {
        $message->to('bindeshpandya@hotmail.com', 'example_name')->subject('Welcome!');
        })->everyMinute();
       

//		$schedule->command('inspire')
//				 ->hourly();
        });
    }
}    