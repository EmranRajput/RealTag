<?php

namespace App\Http\Controllers;
// require 'vendor/autoload.php';
use App\Models\WhatsappInstance;
use App\Models\RentalAgreement;
use App\Models\Invoice;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Log;
use Carbon\Carbon;

// use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function sendMessage(){

        $params=array(
        
        'to' => '+923156021060',
        'body' => 'My name is khan. i am not terrorist'
        );

        $client = new Client();
        $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $options = ['form_params' =>$params ];
        $request = new Request('POST', 'https://api.ultramsg.com/instance61686/messages/chat', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        echo $res->getBody();
            }

            
            // https://api.ultramsg.com/instance61686/messages/chat?token=tw1itkum3bsmsa6h&to=+923017112233&body=WhatsApp+API+on+UltraMsg.com+works+good&priority=10


public function changeStauts(){
         $getInstance = WhatsappInstance::get();
        foreach($getInstance as $instance){
            try{
            $instance_id = $instance->instance_id;
            $client = new Client();
            $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $params=array(
            'token' => $instance->instance_token
            );
            $request = new Request('GET', 'https://api.ultramsg.com/'.$instance_id.'/messages/statistics?'.http_build_query($params), $headers);
            $res = $client->sendAsync($request)->wait();
            $resp =  json_decode($res->getBody());
            if(isset($resp->messages_statistics->queue)){
                if($resp->messages_statistics->queue == 0){
                     $instance->update(['queue_status'=>0]);
                    $this->logout($instance);
                }
            }
            return 'success';
        }catch(\Exception $e){
            dd($e);
            Log::info($e);

        }
        
        }
    }
            public function logout($instance){
                        try{
                        $params=array(
                        'token' => $instance->instance_token
                        );

                        $client = new Client();
                        $headers = [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                        ];
                        $options = ['form_params' =>$params ];
                        $request = new Request('POST', 'https://api.ultramsg.com/'.$instance->instance_id.'/instance/logout', $headers);
                        $res = $client->sendAsync($request, $options)->wait();

                    }catch(\Exception $e){
                        Log::info($e);
                    }
                }

                public function logoutBusy(){
                $date = date('d-m-y h:i:s'); 
                $getInstances =  WhatsappInstance::where('is_busy',1)
                 ->where('updated_at', '<', now()->subMinutes(20))
                ->get();
                    if($getInstances->count() > 0){
                        foreach($getInstances as $instance){
                            try{
                                $params=array(
                                'token' => $instance->instance_token
                                );
                                $client = new Client();
                                $headers = [
                                'Content-Type' => 'application/x-www-form-urlencoded'
                                ];
                                $options = ['form_params' =>$params ];
                                $request = new Request('POST', 'https://api.ultramsg.com/'.$instance->instance_id.'/instance/logout', $headers);
                                $res = $client->sendAsync($request, $options)->wait();
                                $resp =  json_decode($res->getBody());
                                if($resp->success){
                                   $instance->update(['user_id'=>null,'phone_number'=>null,'is_busy'=>0,'queue_status'=>0]);
                                }
                            }catch(\Exception $e){
                                Log::info('Error occurred at logout busy instane Error:' . $e);
                            }
                                return 'success';

                        }
                    }
                } 
       
    public function cron(){
      
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
        return 'success';

    }
    public function generateInvoice($agreement){
            
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
    }
    
    public function generateInvoiceNum($agreement)  {
        
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
    }
}