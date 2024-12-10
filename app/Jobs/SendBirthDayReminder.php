<?php

namespace App\Jobs;

use App\Mail\ReminderEmailBirthDay;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;


class SendBirthDayReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $agentEmail;
    protected $userEmail;
    protected $userName;
    protected $userAge;

   public function __construct($agentEmail="", $userEmail="", $userName, $userAge="")
{
        // Log::info('Received data in the constructor: ' . json_encode($data));

            $this->agentEmail = $agentEmail;
            $this->userEmail = $userEmail;
            $this->userName = $userName;
            $this->userAge = $userAge;

}
    public function handle()
    {
        $agentEmail =$this->agentEmail ;
        $userEmail = $this->userEmail;
        $userName =  $this->userName;
        $userAge =  $this->userAge;
        Log::info('Sending reminder Birthday email to user ' .  $userEmail); // Add this line
        try {
            Mail::to($userEmail)->send(new ReminderEmailBirthDay($userName));
            Log::info('Reminder Birthday email sent to user ' . $userEmail); // Add this line
        } catch (\Exception $e) {
            Log::error('Error sending reminder Birthday email to user ' .$userEmail . ': ' . $e->getMessage());
        }
 
    }
}
