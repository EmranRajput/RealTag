<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

 class ReminderEmail extends Mailable
    {
        use Queueable, SerializesModels;
    
     
        protected $user;

        public function __construct($user)
        {
           $this->user = $user;
        }
        public function build()
        {
            // $user_id =  auth()->guard(userGuard())->user()->id;
           $emailTemplate = DB::table('email_templates')
            ->where('agent_id', $this->user)
            ->where('status', 1)
            ->first();
            
          if ($emailTemplate) {
            SendReminderEmail::dispatch($this->user, $emailTemplate->description);
            return $this->view('email.sendEmail')->with('agentEmails', $emailTemplate->description);
        } else {
            // Handle the case when $emailTemplate is null, e.g., show an error message or perform some other action
             return $this->view('email.sendEmail');
        }
            
         //   return $this->view('email.sendEmail');
        }
    }

