<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RentalAgreement;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RentalTenancyMail extends Mailable
{
    use Queueable, SerializesModels;

        use SerializesModels;

    // public $agent;
    public $agreement_id;

    public function __construct($agreement_id)
    {
        $this->agreement_id = $agreement_id;
    }

    public function build()
    {
        $emailTemplate = DB::table('rental_templates')
            ->where('default', 1)
            ->first();
            
         $agrement =  RentalAgreement::where('id',  $this->agreement_id)->first();
         $rentalAgreementsWithUsers = DB::table('rental_agreements')
            ->leftJoin('users as agents', 'rental_agreements.agent_id', '=', 'agents.id')
            ->leftJoin('users as landlords', 'rental_agreements.landlord_id', '=', 'landlords.id')
            ->select('rental_agreements.*', 'agents.name as agent_name', 'landlords.name as landlord_name')
            ->first();
            
           $firstString = str_replace('{agent_name}', "<b><i>".$rentalAgreementsWithUsers->agent_name."</i></b>", $emailTemplate->description);
           $secondString = str_replace('{address}', "<b><i>".$agrement->address."</i></b>", $firstString);
           $thirdString = str_replace('{end_date}', "<b><i>".$agrement->end_date."</i></b>", $secondString);
           $finalString = str_replace('{landlord_name}', "<b><i>".$rentalAgreementsWithUsers->landlord_name."</i></b>", $thirdString);
           
        return $this->subject('Contract Expiry Reminder')
                    ->view('email.sendTenancyRentalEnding')->with('description', $finalString);
    }
}