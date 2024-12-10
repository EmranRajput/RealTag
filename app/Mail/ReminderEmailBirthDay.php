<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendBirthDayReminder;

 class ReminderEmailBirthDay extends Mailable
    {
        use Queueable, SerializesModels;
    
     
        
        protected $userName;
    
        public function __construct($userName)
        {
            
            $this->userName = $userName;
            
        }
        public function build()
        {
            // $user_id =  auth()->guard(userGuard())->user()->id;
            $emailTemplate = DB::table('birthday_templates')
            ->where('default', 1)
            ->first();
            
           $finalString = str_replace('{Calvin}', $this->userName, $emailTemplate->description);
            
            if (!empty($emailTemplate)) {
                // SendBirthDayReminder::dispatch('','',$this->userName,'');
                return $this->view('email.sendBirthdayEmail')->with('agentEmail', $finalString);
            } else {
                // Handle the case when $emailTemplate is null, e.g., show an error message or perform some other action
                 return $this->view('email.sendBirthdayEmail');
            }
    
         //   return $this->view('email.sendEmail');
        }
    }

