<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\MessageTemplate;
use Log;
use Mail,Session,Validator,Auth;
use App\Models\ExcelFileDetail;
use App\Models\WhatsappInstance;
use App\Models\Setting;
use App\Models\WhatsappMsgDelivery;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

// use App\Traits\SendMessage;

class SendWhatsAppMsgJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
  {
    $this->details = $details;
  }
    
    public function handle()
      {
        
        $session  =   $this->details['number_array'];
        $template_id =  $this->details['template_id'];
        $user_id =  $this->details['user_id'];
        $file_id =  $this->details['file_id'];
        $phone = 1;
        $messageStatus = 1;
        $instance = WhatsappInstance::where('user_id',$user_id)->first();
        $excelfile =  ExcelFileDetail::where('user_id',$user_id)->orderBy('id','Desc')->first();
        if($session && count($session)){
         foreach ($session as $index => $row) {
             try {
                  $array = $this->details['header_array'];
                  if($row[$phone] !== '' || $row[$phone] !== null){
                     $msg_template = MessageTemplate::where('id',$template_id)->first();
                     $number =  $this->getWhatsappMsgDeliveries($row[$phone],$user_id,$file_id);
                     if($number){
                     if($msg_template){
                        $msg_description = $msg_template->description;
                        foreach($array as $key => $arr){
                            $match = '{'.$arr.'}';
                            $isMatch = preg_match($match,$msg_description);
                            if($isMatch){   
                            $msg_description = str_replace($match,$row[$key],$msg_description);  // search,replace,description			
                            }
                        }
                        $description =   $msg_description;
                        $params=array(
                        'token' => $instance->instance_token,
                        'to' => $row[$phone],
                        'body' => $description
                        );
                        $client = new Client();
                        $headers = [
                           'Content-Type' => 'application/x-www-form-urlencoded'
                        ];
                        $options = ['form_params' =>$params ];
                        $request = new Request('POST', 'https://api.ultramsg.com/'.$instance->instance_id.'/messages/chat', $headers);
                        $res = $client->sendAsync($request, $options)->wait();
                        $status =  json_decode($res->getBody());
                        if(isset($status->sent)){
                             $message =  $description;
                             Log::info($message);
                             $state  = 1;
                             $this->updateWhatsappStatus($state,$number,$message,$status->id,$instance);
                        }else{
                             $messageStatus = 0;
                             $message = 'Action Failed!';
                            if(isset($status->error)){
                                if(isset($status->error[0]->to)){
                                   $message = $status->error[0]->to;
                                }
                            }
                            $id = null;
                            $status = 2;
                            $this->updateWhatsappStatus($status,$number,$message,$id,$instance);
                         }
                        }
                   }
                }
                } catch (\Exception $e) {
                    Log::info($e);
                    $messageStatus = 0;
                }
                $randomNumber = rand((int)$instance->start_value, (int)$instance->end_value);
                sleep($randomNumber);
            }
           
            if($excelfile && $messageStatus == 1){
               $excelfile->update(['status'=>1]);
            }else{
                $excelfile->update(['status'=>2]);
            }
        }
    }
   
    public function updateWhatsappStatus($status,$number,$message,$id,$instance){
        $current_time = now();
        $number->update(['status'=>$status,'msg_response_id'=>$id,'message'=>$message]);
        $instance->update(['updated_at'=>$current_time]);
    }
    
    public function matchReplaceVariabl($row,$msg_description,$array){
       foreach($array as $key => $arr){
            $match = '{'.$arr.'}';
            $isMatch = preg_match($match,$msg_description);
            if($isMatch){   
            $msg_description = str_replace($match,$row[$key],$msg_description);  // search,replace,description			
            }
	    }
	return  $msg_description;
    }
    

    public function getWhatsappMsgDeliveries($number,$user_id,$file_id){
        try{
               $find =  WhatsappMsgDelivery::where('user_id',$user_id)
                    ->where('file_id',$file_id)->where('number',$number)->where('status',0)->first();
                if($find){
                    return $find;
                }
               
                return false ;
        } catch (\Exception $e) {
            Log::info('Error occurred at denerate whatsapp msg deliver'.$e);
            return false;
        }
    }
    
}