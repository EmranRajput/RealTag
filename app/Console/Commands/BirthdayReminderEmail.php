<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendBirthDayReminder;
use Carbon\Carbon;
use App\Models\birthdayEmailReminder;
// use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class BirthdayReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday-reminder-email';
    protected $description = 'Send birthday reminder email ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
        $today = now()->addDay()->format('m-d');
        $thisYear = now()->format('Y'); // Use 'Y' for a four-digit year
        Log::info('BirthdayReminderEmail command is running.'); // Add this line

        $agents = User::where('role', 2)->get();
        if ($agents->isNotEmpty()) {
            foreach ($agents as $agent) {
                $agentUsers = birthdayEmailReminder::where('agent_id', $agent->id)->where('status', 1)->get();
                if ($agentUsers->isNotEmpty()) {
                    foreach ($agentUsers as $agentUser) {
                        $birthdayBoy = User::where('status', 1)
                            ->where('id', $agentUser->user_id)
                            ->whereRaw("DATE_FORMAT(birth_date, '%m-%d') = ?", [$today])
                            ->first(); // Use first() instead of pluck for a single result
        
                        if ($birthdayBoy) {
                            $date = \Carbon\Carbon::parse($birthdayBoy->birth_date);
                            $year = $date->year;
                            $age = $thisYear - $year;
                            
                            $agentEmail = $agent->email;
                            $userEmail = $birthdayBoy->email;
                            $userName = $birthdayBoy->name;
                            $userAge = $age;
        
                            SendBirthDayReminder::dispatch($agentEmail, $userEmail, $userName, $userAge);
                        }
                    }
                }
            }
        }

    return Command::SUCCESS;
}

}
