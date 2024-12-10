<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MessageTemplate;
use App\Models\WhatsappInstance;
use App\Models\Setting;
use App\Models\WhatsappMsgDelivery;
use Illuminate\Support\Facades\Hash;
use Log;
use Mail,Session,Validator,Auth;
use App\Models\ExcelFileDetail;
use App\Traits\SendMessage;
use App\Jobs\SendWhatsAppMsgJob;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class WhatsappInstanceController extends Controller
{

    use SendMessage;
    public function index()
    {
		$instances =  WhatsappInstance::get();
        return view('instance.index',compact('instances'));    
    }

    
    public function edit($id)
    {
		$instance =  WhatsappInstance::where('id',$id)->first();
        return view('instance.createEdit',compact('instance'));
    }

     public function create()
    {
		return view('instance.createEdit');
    }


     public function createUpdate(Request $request)
    {

         $validate = Validator::make(request()->all(),
        [
            'instance_id'=>'required|alpha_num',
            'instance_token'=>'required|alpha_num',
            'instance_expiry'=>'required',
            'start_value'=>'required|integer',
            'end_value'=>'required|integer',
            'end_value'=>'required_with:start_value|gt:start_value'
        
        ]
        );
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->messages()->first())->withInput();
        }
        
        if(isset($request->id)){
          $instance =   WhatsappInstance::find($request->id);
        }else{
	     	$instance =  new  WhatsappInstance();
        }
        
        $instance->instance_id = $request->instance_id;
        $instance->instance_token = $request->instance_token;
        $instance->instance_expiry = $request->instance_expiry;
        $instance->start_value = $request->start_value;
        $instance->end_value = $request->end_value;
        $instance->save();
        if($instance){
            return redirect()->route('whatsapp.instance.index')
            ->with('success','Action Performed sucessfully');
        }
    }

     public function delete($id)
    {
       $instance =  WhatsappInstance::where('id',$id)->first();
        if($instance){
            $instance->delete();
            return response()->json(['status'=>true,'message'=>'Instance Delted Successfully!']);
        }
            return response()->json(['status'=>false,'message'=>'Action Failed!']);
     }	
    
    public function getQrCode(){
        $params=array(
        'token' => 'a2fiks8hb3jrq15w'
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance61001/instance/qr?" .http_build_query($params),
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

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
           
                return view('instance.image',compact('response'));
          
            }
    }
    
  public function webhook(){
        $params=array(
            'token' => 'a2fiks8hb3jrq15w',
            'sendDelay' => '1',
            'webhook_url' => 'https://staging.fratres.net/webhook-listener',
            'webhook_message_received' => true,
            'webhook_message_create' => '',
            'webhook_message_ack' => true,
            'webhook_message_download_media' => ''
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.ultramsg.com/instance61001/instance/settings",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => http_build_query($params),
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            }
  }

  public function whatappBlasting(){
      $response ='error';
      $user_id =  auth()->guard(userGuard())->user()->id;
      $templates =  MessageTemplate::where('user_id',$user_id)->get();
      $getInstance =   WhatsappInstance::where('user_id',$user_id)->first();
      if($getInstance) {
         $updateStatus =  $this->logoutInstanceTwentyMinutes($getInstance);
         if($updateStatus){
             $getInstance = false;
         }
      }
      if(!$getInstance){
             $getinstances = WhatsappInstance::
             where('is_busy',0)->where('queue_status',0)->get();
             if($getinstances->count() > 0){
                foreach($getinstances as $instance){
                  // if instance free then return status false
                  $checkInstanceAvailableOrNot = $this->checkAgentPhoneNumber($instance,$updateDB = true,false,$recheck=false); 
                  if($checkInstanceAvailableOrNot){
                      // it means that instance is ready to pair
                      $response = $this->getQrCodeImage($instance);
                      if($response){
                        return view('steps.wizard',compact('response','templates'));
                      }
                  }
                }
              }
              $response = 'error';
              return view('steps.wizard',compact('response','templates'));
            }
            Session::put('instance',$getInstance);
            $response = 'already-exist';
            return view('steps.wizard',compact('response','templates'));
      }
     public function  getQrCodeImage($instance){
      // take barcode
      try{
          $url = "https://api.ultramsg.com/$instance->instance_id/instance/qr?" ;
          $params = array(
          'token' => $instance->instance_token
          );
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => $url.http_build_query($params),
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
            if(isset(json_decode($response)->error) || $err){
              $response = 'error';
              return false;
            }
	            Session::put('instance', $instance);
              $instance->update(['qrcode_status'=>1]);
              return $response;
            } catch (\Exception $e) {
                Log::info($e);
                return false;
            }
     }

    
  public function importFile(){
     return view('steps.importFile');
  }
public function importExcelFile(Request $request)
{
    if (userLogin()) {
        try {
            $request->validate([
                'file' => 'required|mimes:csv',
                'template' => 'required',
            ]);

            if ($request->file->getClientOriginalExtension() == "csv") {
                $template_id = $request->template;
                $files = [];
                $file = file($request->file->getRealPath());
                $file_orignal_name = $request->file->getClientOriginalName();

                // Additional processing based on your needs
                createResourseDirecrotory('whatsAppFiles');
                $name = 'number_' . date('y-m-d-H-i-s') . '.csv';
                $fileName = public_path('whatsAppFiles/' . $name);
                file_put_contents($fileName, $file);

                // Load the CSV file using PhpSpreadsheet
                $spreadsheet = IOFactory::load($fileName);
                $worksheet = $spreadsheet->getActiveSheet();

                foreach ($worksheet->getColumnIterator('B') as $column) {
                    foreach ($column->getCellIterator() as $cell) {
                        $cellValue = $cell->getValue();
                        // Remove any characters, dots, or text
                        $cellValue = preg_replace('/[^0-9]/', '', $cellValue);
                        $cell->setValue($cellValue);
                    }
                }

                foreach ($worksheet->getRowIterator() as $row) {
                    $cellValue = $worksheet->getCell('B' . $row->getRowIndex())->getValue();
                    if ($row->getRowIndex() > 1 && ($cellValue === null || !is_numeric($cellValue))) {
                        $worksheet->removeRow($row->getRowIndex());
                    }
                }

                $spreadsheetWriter = new Csv($spreadsheet);
                $spreadsheetWriter->save($fileName);

                $file_id = 1;
                $arrayData = $this->convertInArray($fileName, $name, $template_id, $file_id);

                if ($arrayData) {
                    Session::put('number_array', $arrayData);
                    Session::put('template_id', $template_id);
                    return redirect()->back()->with([
                        'success' => 'You can send messages now',
                        'data' => $arrayData
                    ]);
                }

                return redirect()->back()->with('error', 'File uploading failed.');
            } else {
                return redirect()->back()->with('error', 'Only CSV files are allowed.');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    return redirect()->back()->with('error', 'Please login first as an agent.');
}


    public function convertInArray($csv_files,$name,$template_id,$file_id){
      try{
        ini_set('memory_limit', '-1'); //
        ini_set('max_execution_time', '0'); // for infinite time of execution
        set_time_limit(0);
        $phone = 1;
        $count = 0;
        $errors = [];
        $csv_data = array();
        $file_id = '';
        if (file_exists($csv_files) && is_readable($csv_files)) {
            if (($handle = fopen($csv_files, 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 1024)) !== FALSE) {
                    $csv_data[] = $data;
                }
            }
           
        }
         $save_contacts = [];
         foreach ($csv_data as $index => $row) {
             try {
                if ($count == 0) {
                  setHeadersInArray($row);
                }
                else{
                  $array = getHeadersFromArray();
                  if($row[$phone] !== '' || $row[$phone] !== null){
                     $save_contacts[] = $row ;
                  }
                }
                $count = $count + 1;
            } catch (\Exception $e) {
                $count = $count + 1;
               
            }
        }
        if($count > 0){
          $count = $count - 1;
        }
        $this->saveExcelFileName($name,$count);
        return $save_contacts;
        } catch (\Exception $e) {
                Log::info($e);
                return false;
            }
    }

      public function updateExcelFile($file,$count){
       $file->update(['count'=>$count]);
      }
      
     public function saveExcelFileName($fileName,$count){
        $user_id =  userLogin()->id;
        $save =   new ExcelFileDetail();
        $save->file_name = $fileName;
        $save->user_id = userLogin()->id;
        $save->status = 0;
        $save->save();
        if($save){
        Session::put('file_id',$save->id);
          return $save;
        }
         
      }
      
    public function getWhatsappMsgDeliveries($number,$user_id,$file_id){
        // try{
               $find =  WhatsappMsgDelivery::where('user_id',$user_id)
                    ->where('file_id',$file_id)->where('number',$number)->first();
              dd($find );
                    if($find){
                    return $find;
                }
               
                return false ;
        // } catch (\Exception $e) {
        //     Log::info('Error occurred at denerate whatsapp msg deliver'.$e);
        //     return false;
        // }
    }
    public function generateWhatsappMsgDeliveries($number,$user_id,$file_id){
        // try{
                $create =  new  WhatsappMsgDelivery();
                $create->file_id = $file_id;
                $create->user_id = $user_id;
                $create->number = $number;
                $create->status = 0;
                $create->save();
              return $create;
        // } catch (\Exception $e) {
        //     Log::info('Error occurred at denerate whatsapp msg deliver controller'.$e);
        // }
    }
    
    public function importSoftwareData($csv_files, $file_orignal_name,$template_id)
    {
        ini_set('memory_limit', '-1'); //
        ini_set('max_execution_time', '0'); // for infinite time of execution
        set_time_limit(0);
        $phone = 1;
        $count = 0;
        $errors = [];
        $csv_data = array();
        if (file_exists($csv_files) && is_readable($csv_files)) {
            if (($handle = fopen($csv_files, 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 1024)) !== FALSE) {
                    $csv_data[] = $data;
                }
            }
        }
        foreach ($csv_data as $index => $row) {
             try {
                if ($count == 0) {
                  setHeadersInArray($row);
                }
                else{
                  $array = getHeadersFromArray();
                  if($row[$phone] !== '' || $row[$phone] !== null){
                     $msg_template = MessageTemplate::where('id',$template_id)->first();
                      if($msg_template){
                        $msg_description = $msg_template->description;
                        $description =  matchReplaceVariable($row,$msg_description);
                        $this->sendWhatsAppMessage($row,$description );
                      }
                  }
                }
                $count = $count + 1;
            } catch (\Exception $e) {
                $count = $count + 1;
                Log::info($e);
             
                return false;
            }
        }
        $instance_id = 'instance61001';
        $this->changeInstanceStatus($instance_id);
        return true;
      }

      public function changeInstanceStatus($instance_id){
        WhatsappInstance::where('instance_id',$instance_id)->update(['queue_status'=>1]);
      }

     

    public function checkAgentStatus(){
      $response =  $this->checkInstanceStatus();
      if($response){
        
          return response()->json(['status'=>true]);
      }else{
          return response()->json(['status'=>false]);
      }
    }

    public function checkAgentNumber(Request $request){

      if(isset($request->number)){
        $number = $request->number;
        if($request->recheck){
          $recheck = true;
        }else{
          $recheck = false;
        }
      
         $response =  $this->checkAgentPhoneNumber(false,false,$number,$recheck);
        // $response = $this->checkPhoneNumberInDB($number);
      }else{
       $response =  $this->checkAgentPhoneNumber();
      }
     
      if($response){
          return response()->json(['status'=>true]);
      }else{
          return response()->json(['status'=>false]);
      }
    }
    
    public function updateCSVSession(Request $request){
       
       $session = Session::get('number_array');
     
       if($session &&  count($session) > 0){
          unset($session[$request->remove_id]);
          $session = Session::put('number_array',$session);
           return response()->json(['status'=>true]);
       }
    }
    public function sendCSVMsgs(){
        
        $user_id =  auth()->guard(userGuard())->user()->id;
        $findInstance =   WhatsappInstance::where('user_id',$user_id)->first();
        $phone = 1;
        if($findInstance){
          $session = Session::get('number_array');
          $template_id =  Session::get('template_id');
          $header_array =  Session::get('header_array');
          $file_id =  Session::get('file_id');
          $details =[
              'number_array'=>$session,
              'template_id'=>$template_id,
              'user_id'=>$user_id,
              'header_array'=>$header_array,
              'file_id'=>$file_id
          ];
          
            if($session && count($session)){
              foreach ($session as $index => $row) {
                // try {
                $this->generateWhatsappMsgDeliveries($row[$phone],$user_id,$file_id);
                // $number =  $this->getWhatsappMsgDeliveries($row[$phone],$user_id,$file_id);
// 
                // } catch (\Exception $e) {
                //     Log::info('error message at sendCsv mesage'.$e);
                // }
              }
            }
          $response =  $this->dispatch(new SendWhatsAppMsgJob($details));
          $session = Session::forget('number_array');
          $template_id =  Session::forget('template_id');
          $header_array =  Session::forget('header_array');
          $file_id =  Session::forget('file_id');
        
      return redirect()->back()->with(['success'=>'Message sending'
                     ,'message_sent'=>'Please be patient!we are sending messages']);  
      }else{
          $session = Session::forget('number_array');
          $template_id =  Session::forget('template_id');
          $header_array =  Session::forget('header_array');
          $file_id =  Session::forget('file_id');
          return redirect()->route('whatsapp.blasting');
      }  
       }
     
    public function whatappHistory(){
        $user_id =  auth()->guard(userGuard())->user()->id;
        $excelFiles =  ExcelFileDetail::withCount(['whatsAppMsgsSent','whatsAppMsgsFailed','whatsAppMsgsAll','whatsAppMsgsPending'])
        ->where('user_id',$user_id)->orderBy('id','Desc')->paginate(10);
        return view('history.index',compact('excelFiles'));
    }
    public function WhatsappFileContacts($id){
        $details =   WhatsappMsgDelivery::where('file_id',$id)->get();
        return view('history.details',compact('details'));     
    }

    public function resendMessage(Request $request){
      if(isset($request->id)){
        $find =   WhatsappMsgDelivery::where('id',$request->id)->first();
        if($find){
          $response =  $this->resendWhatsAppMessage($find);
          if( $response ){
            return response()->json(['status'=>true]);
          }         
        }
      }
      return response()->json(['status'=>false]);
    }
    
    public function instanceSleepTimer(){
        $data = '';
        $data = ['start_value'=>0,'end_value'=>5]; 
        $getTimer =  getSetting('sleep_timer');
        if($getTimer){
            $data = json_decode($getTimer->value,true);   
        }
      return view('sleep.create',compact('data'));
    }

    public function saveSleepTimer(Request $request){
       $validate = Validator::make(request()->all(),
        [
            'start_value'=>'required|integer',
            'end_value'=>'required|integer',
            'end_value'=>'required_with:start_value|gt:start_value'
        ]
        );
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->messages()->first())->withInput();
        } 

        $key = ['start_value'=>$request->start_value,'end_value'=>$request->end_value];
        $encode =  json_encode($key);
        $getTimer =  getSetting('sleep_timer');
        if($getTimer){
         $create = $getTimer;
        }else{
          $create  =  new Setting();
        }
        $create->key = 'sleep_timer';
        $create->value = $encode;
        $create->save();
            return redirect()->route('whatsapp.instance.sleep.timer')
              ->with('success','Action Performed sucessfully');

      return  $this->instanceSleepTimer();
    }
    public function instanceLogout($json = false){
      $user_id =  auth()->guard(userGuard())->user()->id;
      $getInstance =  WhatsappInstance::where('user_id',$user_id)->first();
      if($getInstance){
          $this->logoutIistance($getInstance);
      }
      if($json){
         return response()->json(['status'=>true]);
      }
      return redirect()->route('whatsapp.blasting');
             
      
    }

   
  }