<?php

namespace App\Console\Commands;
use App\Models\WhatsappInstance;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Log;
class InstanceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       $getInstance = WhatsappInstance::where('queue_status',1)->get();
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
        }catch(\Exception $e){
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
            $options = ['form_params' => $params ];
            $request = new Request('POST', 'https://api.ultramsg.com/'.$instance->instance_id.'/instance/logout', $headers);
            $res = $client->sendAsync($request, $options)->wait();
             $resp =  json_decode($res->getBody());
                if($resp->success){
                    $instance->update(['user_id'=>null,'phone_number'=>null,'is_busy'=>0,'queue_status'=>0]);
                 
            }

        }catch(\Exception $e){
            Log::info($e);
        }
    }
}