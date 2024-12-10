<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RentalAgreement; // Adjust this import based on your actual model location
use App\Models\User; // Adjust this import based on your actual model location
use App\Mail\RentalTenancyMail; // Adjust this import based on your actual Mailable location
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RentalTenancyEnding extends Command
{
    protected $signature = 'send:rental-tenancy-ending';
    protected $description = 'Send reminders to agents one month before rental agreements expire.';

    public function handle()
    {
        $oneMonthFromNow = now()->addMonth();
        $expiryDate = $oneMonthFromNow->format('Y-m-d');
        $this->info('RentalTenancyEnding command is running.');
        
        $expiringAgreements = RentalAgreement::where('end_date', $expiryDate)->get();
        
        foreach($expiringAgreements as $contract) {
            
                $agent = User::where('id', $contract->agent_id)->first();
                Mail::to($agent->email)->send(new RentalTenancyMail($contract->id));
        }
        $this->info('Rental tenancy ending reminders sent successfully.');
        return Command::SUCCESS;
    }
}
