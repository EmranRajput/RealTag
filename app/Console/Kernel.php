<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\InstanceCron::class,
        Commands\LogoutInstancesCron::class,
        Commands\GenerateInvoiceJob::class,
        \App\Console\Commands\SendReminderEmails::class,
        \App\Console\Commands\BirthdayReminderEmail::class,
        Commands\RentalTenancyEnding::class,


    ];
    
    protected $scheduleFrequency = 1; // every minute

    
    
    protected function schedule(Schedule $schedule)
    {
            $schedule->command('send:rental-tenancy-ending')->everyMinute()->appendOutputTo(storage_path('logs/scheduler.log'));
            $schedule->command('send:birthday-reminder-email')->dailyAt('10:00')->appendOutputTo(storage_path('logs/scheduler.log'));
            // $schedule->command('send:birthday-reminder-email')->everyMinute()->appendOutputTo(storage_path('logs/scheduler.log'));
            $schedule->command('send:reminder-emails')->everyFiveMinutes()->appendOutputTo(storage_path('logs/scheduler.log'));
              
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