<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Mail\ReminderEmail;
use Illuminate\Support\Carbon;
use App\Jobs\SendReminderEmail;
use App\Models\RentalAgreement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{

    protected $signature = 'send:reminder-emails';
    protected $description = 'Send reminder emails to users with due dates 2 and 7 days in the future';

    public function handle()
    {
        Log::info('SendReminderEmails command is running.'); // Add this line
            $usersWithReminderEmail = User::where('reminder_email_toggle', 1)->pluck('id');
            $dueDate = Carbon::now()->addDays(2);
            
            $agentIds = RentalAgreement::whereIn('agent_id', $usersWithReminderEmail)
              ->whereDate('end_date', '=',  $dueDate->toDateString())
                ->pluck('tenant_id');
            
            
                // Now, fetch the corresponding emails using the agent IDs
                $agentEmails = User::whereIn('id', $agentIds)->pluck('email', 'agent_id');
            
                foreach ($agentEmails as $agentId => $agentEmail) {
                    SendReminderEmail::dispatch($agentId, $agentEmail);
                }
       $this->info('Reminder emails sent successfully!');
        Log::info('SendReminderEmails command completed.'); // Add this line

    }
}
