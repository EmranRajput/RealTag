<?php

namespace App\Console\Commands;
use Log;
use Carbon\Carbon;
use App\Models\WhatsappInstance;
use App\Models\RentalAgreement;
use App\Models\Invoice;

use Illuminate\Console\Command;

class GenerateInvoiceJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic generate invoices';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
                $currentDate = now();
                $today = $currentDate->format('Y-m-d');
                $getAgreements = RentalAgreement::where('agent_service', 1 )
                        ->where('end_date','>',$today)
                        ->with(['tenant'])
                        ->get();
                foreach($getAgreements as $agreement){
                        $checkInvoice = Invoice::where('agent_id',$agreement->agent_id)
                                                ->where('tenant_id',$agreement->tenant_id)
                                                ->first();
                        if($checkInvoice){
                            $currentMonth = $currentDate->format('m');
                            $created_At   = $checkInvoice->created_at;
                            $invoice_created_At = Carbon::parse($created_At);
                            $last_month   =    $invoice_created_At->format('m');
                            
                            if($currentMonth > $last_month ){
                            // generate new invoice
                            $this->generateInvoice($agreement);
                            }
                        }else{
                            $this->generateInvoice($agreement);   
                        } 
                }
        }catch(\Exception $e){
            Log::info($e);

        }
    

    }
    
    public function generateInvoice($agreement){
            try{
            $array = [];
            $service_tax = 5;
            $sub_total = $agreement->rental_amount;
            $tax =  ( $sub_total * $service_tax) / 100;
            $total = $service_tax + $sub_total;
            $invoice_number = $this->generateInvoiceNum($agreement);    
          
            $createInvoice =  new Invoice();
            $createInvoice->agent_id = $agreement->agent_id;
            $createInvoice->tenant_id = $agreement->tenant_id;
            $createInvoice->name = $agreement->tenant->name;
            $createInvoice->identity_number = $agreement->tenant->identity_number;
            $createInvoice->invoice_number = $invoice_number;
            $createInvoice->item_list =  json_encode($array);
            $createInvoice->sub_total =  $sub_total;
            $createInvoice->service_tax =  $tax;
            $createInvoice->total =  $total;
            $createInvoice->invoice_type =  'Miscellaneous';
            $createInvoice->created_by_cron =  1;
            $createInvoice->status =  0;
            $createInvoice->save();   
             }catch(\Exception $e){
            Log::info($e);

        }             
    }
    
    public function generateInvoiceNum($agreement)  {
        try{
         $prefix = 'RP-'; // You can customize the prefix
         $date = now()->format('mdY');
         $lastInvoice = Invoice::where('created_by_cron',1)->latest()->first();
            if ($lastInvoice) {
                $lastNumber = substr($lastInvoice->invoice_number, -1);
                $newNumber = str_pad($lastNumber + 1, 1, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '1';
            }
        return $prefix.$agreement->id.'-'. $date .'-'. $newNumber;
         }catch(\Exception $e){
            Log::info($e);

        }
    }

    
}