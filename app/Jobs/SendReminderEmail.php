<?php

namespace App\Jobs;

use App\Mail\ReminderEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $agentId;
    protected $agentEmail;

   public function __construct($agentId, $agentEmail)
{
    $this->agentId = $agentId;
    $this->agentEmail = $agentEmail;
}
    public function handle()
    {
        
        // Logic to send the email
        // Mail::to($this->user->email)->send(new ReminderEmail($this->user));
   
        Log::info('Sending reminder email to user ' .  $this->agentId); // Add this line

        try {
            // Logic to send the email
            Mail::to($this->agentEmail)->send(new ReminderEmail($this->agentId));

            Log::info('Reminder email sent to user ' . $this->agentEmail); // Add this line
        } catch (\Exception $e) {
            Log::error('Error sending reminder email to user ' . $this->agentEmail . ': ' . $e->getMessage());
        }
 
    }
}
