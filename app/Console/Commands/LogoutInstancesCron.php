<?php

namespace App\Console\Commands;
use App\Models\WhatsappInstance;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Log;
class LogoutInstancesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:logout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'the instances that are avctive more then 20 minutes will off';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       $getInstances =  WhatsappInstance::
                 
                //  where('is_busy',1)
                // ->where('queue_status',0)->
                where('updated_at', '<', now()->subMinutes(20))
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
                            $instance->update(['user_id'=>null,'phone_number'=>null,'is_busy'=>0,'queue_status'=>0,'qrcode_status'=>0]);
                        }
                    }catch(\Exception $e){
                        Log::info('Error occurred at logout busy instane Error:' . $e);
                    }
                        return 'success';

                }
            }
        
    }

    
}