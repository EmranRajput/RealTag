<?php
namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Log,Session;

use App\Models\MessageTemplate;
use App\Models\WhatsappInstance;
trait SendMessage{

    public function sendWhatsAppMessage($row,$content,$instance){
        
         try{
             $params=array(
                'token' => $instance->instance_token,
                'to' => $row[1],
                'body' => $content
                );

                $client = new Client();
                $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
                ];
                $options = ['form_params' =>$params ];
                $request = new Request('POST', 'https://api.ultramsg.com/'.$instance->instance_id.'/messages/chat', $headers);
                $res = $client->sendAsync($request, $options)->wait();
                $status =  json_decode($res->getBody());
                if($status->sent){
                    return true;
                }else{
                    return false;
                }
        }catch(\Exception $ex){
          Log::info($ex);
           return false;
        }            
    }


    public function checkInstanceStatus($instance = false){
        if(!$instance){
           $instance = Session::get('instance');
        }
        try{
            $client = new Client();
            $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $params=array(
            'token' => $instance->instance_token
            );
            $request = new Request('GET', 'https://api.ultramsg.com/'.$instance->instance_id.'/instance/status?'.http_build_query($params), $headers);
            $res = $client->sendAsync($request)->wait();
            $resp =  json_decode($res->getBody());
            if(isset($resp->status->accountStatus->status) && $resp->status->accountStatus->status == 'authenticated'){
            return true;
            }else{
            return false;
            }
            }catch(\Exception $e){
                Log::info($e);
                return false;          
            }
        }       
        
        public function checkAgentPhoneNumber($instance = false,$updateDB = false,$number = false,$recheck = false){
          
            if(!$instance ){
                $instance = Session::get('instance');
            }
          try{
           $params=array(
            'token' => $instance->instance_token
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/$instance->instance_id/instance/me?" .http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if (isset(json_decode($response)->error) || $err) {
                // $instance->update(['phone_number'=>'','is_busy'=>0,'user_id'=>'']);
                return true;
            }else{
                
                $res = json_decode($response);
                //  if $updateDB is false then it will update db.it is ult 
             
                if(!$updateDB){
                    if(!$recheck){
                      WhatsappInstance::where('id',$instance->id)->update(['phone_number'=>$res->id,'is_busy'=>1]);
                        if($number){
                            $findNumber =   getWhatsAppInstances($number);
                            if($findNumber){
                                $user_id =  auth()->guard(userGuard())->user()->id;
                                $findNumber->update(['user_id'=>$user_id]);
                            }else{
                                return true;
                            }
                        }
                    }else{
                        
                    $findNumber =   getWhatsAppInstances($number);
                    if(!$findNumber){
                        return true;
                    }
                    }
                    
                }

                $old_arr = Session::get('whatsApp_number');
                if($old_arr){
                    $updated = [
                       'name'=> $res->name,
                       'phone_number'=> $res->id,
                    ];
                    $old_arr[] = $updated;
                    Session::put('whatsApp_number',$old_arr);
                }else{
                     $updated[] = [
                    'name'=> $res->name,
                    'phone_number'=> $res->id,
                    ];            
                    Session::put('whatsApp_number',$updated);
                }
                return false;
            }
        }catch(\Exception $re){
            Log::info($re);
            return false;
        }

        }

        public function storePhoneNumber($response){
            dd($response);
        }
        
        public function checkPhoneNumberInDB($number){
          $instance =   getWhatsAppInstances($number);
          if($instance){
            return false;
          }else{
            return true;
          }
        }
        
        public function logoutInstanceTwentyMinutes($instance){
            if($instance->updated_at  < now()->subMinutes(20)){
                $this->logoutIistance($instance);
                return true;        
            }
            return false;        
        }


        public function logoutIistance($instance){
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
                                // return 'success';
        }
        public function resendWhatsAppMessage($obj){
            try{
            $params=array(
                'token' => 'a2fiks8hb3jrq15w',
                'id' => $obj->id
                );

                $client = new Client();
                $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
                ];
                $options = ['form_params' =>$params ];
                $request = new Request('POST', 'https://api.ultramsg.com/instance61001/messages/resendById', $headers);
                $res = $client->sendAsync($request, $options)->wait();
                $status =  json_decode($res->getBody());
                if(isset($status) && $status->sent){
                   $this->updateWhatsappStatus($number,$status->id);
                   return true;
                }
                } catch (\Exception $e) {
                    Log::info($e);
                    return false;
                }
        }
        
        public function updateWhatsappStatus($number,$id){
                $number->update(['status'=>1,'msg_response_id'=>$id]);
        }

         public function logout($instance){
    //   try{
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
              $status =  json_decode($res->getBody());
              dd($status);
                if($status->sent){
                    return true;
                }else{
                    return false;
                }
              return true;
        //   }catch(\Exception $e){
        //       Log::info($e);
        //     return true;

        //   }
    }
}