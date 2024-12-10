<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Tanent;
use App\Models\Agreement;
use App\Models\RentalAgreement;
use App\Models\User;
use Mail,Session,Validator,Auth,Str;
use Carbon\Carbon;
use App\Helpers\FileHelper;
use Illuminate\Validation\Rule;
use App\Traits\TraitController;
use PDF;
use App\Models\Invoice;

class RentalAgreementController extends Controller
{
     use TraitController;
     
    public function index(Request $request){
    if (Auth::guard(userGuard())->check()) {
        $user_id = auth()->guard(userGuard())->user()->id;
        $agreementss = Agreement::where('status',1)->get();
        $query = RentalAgreement::whereRaw("FIND_IN_SET(?, rental_agreements.agent_id)", [$user_id])
            ->with(['tenant', 'landlord'])
            ->leftJoin('invoices', 'rental_agreements.id', '=', 'invoices.r_agreement_id')
            ->orderBy('rental_agreements.id', 'desc')
            ->select('rental_agreements.*', 'invoices.id as invoiceID','invoices.status as invoiceStatus'); // Select the columns you need
        
        if ($request->filled('dates')) {
            list($start_date, $end_date) = explode(',', $request->dates);
        
            $query->whereBetween("start_date", [$start_date, $end_date])
                  ->whereBetween("end_date", [$start_date, $end_date]);
        }
        
        if (isset($request->tenant_id)) {
            $query->where('tenant_id', $request->tenant_id);
        }
        
        if (isset($request->landlord_id)) {
            $query->where('landlord_id', $request->landlord_id);
        }
        
        if (isset($request->address)) {
            $query->where('address', 'LIKE', '%' . $request->address . '%');
        }
                        
            $agreements = $query->cursorPaginate(10);
            $query1 =   User::whereRaw("FIND_IN_SET(?, agent_id)", [$user_id]);
            $landlords = clone $query1;
            $tanents = clone $query1;
        
            $landlords =  $landlords->where('role',3)->get(); // landlord
            $tanents = $tanents->where('role',4)->get(); // tenants
            $title = "Rental Agreements";
            return view('rentalAgreememt.index',compact('agreements','agreementss', 'title','tanents','landlords'));
        }
    }

    
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   RentalAgreement::where('id',$request->id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Rental Agreement Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    
    public function show(Request $request){
        $agreementShow = RentalAgreement::find($request->id);
        $title_agreement =  Agreement::where('id',$agreementShow->agreement_id)->get(); // landlord

        $user_id =  auth()->guard(userGuard())->user()->id;
        $query1 =   User::find($user_id);
        $landlords = clone $query1;
        $tanents = clone $query1;
        $agent = clone $query1;
        
        $agent = $agent->where('id',$user_id)->get();
        $landlords =  $landlords->where('id',$agreementShow->landlord_id)->get(); // landlord
        $tanents = $tanents->where('id',$agreementShow->tenant_id)->get(); // tenants
        // dd($tanents);
        // die();
        $response = ['agreement'=>$agreementShow, 'agreementTemp'=>$title_agreement->toArray(),'tenant'=>$tanents->toArray(),'landlord'=>$landlords->toArray(),'agent'=>$agent->toArray()];
        
        // $response['tenant'] = array_values($response['tenant']);
        // $response['landlord'] = array_values($response['landlord']);
        // $response['agent'] = array_values($response['agent']);
        return response()->json(['success' => true,'data'=>$response]);
        // return view('rentalAgreememt.show',compact('agreementShow'));  
    }
    
    public function parse(Request $request){
        // $user_id =  auth()->guard(userGuard())->user()->id;
        $agreement = Agreement::find($request->agrement_id);
        preg_match_all('/#\w+/', $agreement->descriptions, $matches);
        $foundWords = $matches[0];
        $text = $agreement->descriptions;
        foreach ($foundWords as $word) {
            $normalizedSecurityDeposit = strtolower(str_replace("#", "", $word));
            $text = str_replace($word, $request->$normalizedSecurityDeposit, $text);
        }
        // echo $text;
        // die();
        $pdf = PDF::loadHTML($text);
        return $pdf->download('document.pdf');
       
    }
    

    public function edit($id = null){
          $getData   =  '';
          $agreements = Agreement::where('status',1)->get();
          $user_id = auth()->guard(userGuard())->user()->id;
          $query =   User::whereRaw("FIND_IN_SET(?, agent_id)", [$user_id]);
          $landlords = clone $query;
          $tanents = clone $query;
        
            $landlords =  $landlords->where('role',3)->get(); // landlord
            $tanents = $tanents->where('role',4)->get(); // tenants
            
            if(isset($id)){
                $getData =   RentalAgreement::where('id',$id)->first();
                if($getData){
                    return view('rentalAgreememt.create',compact('getData','tanents','landlords','agreements'));
                }
                    return redirect(request('backurl', route('agent.rental.agreements')))->with('error', 'Tenant not found.');
            }
         
          return view('rentalAgreememt.create',compact('getData','tanents','landlords','agreements'));
    }
    
    public function createUpdate(Request $request){
    
        $duration = 0;
        if(!$request->guest_tenant){
            $newData = [
                'guest_tenant' => null,
            ];
            $request->merge($newData);
        }

        if(!$request->guest_landlord){
            $newData = [
                'guest_landlord' => null,
            ];
            $request->merge($newData);
        }

        if(!$request->agent_service){
            $newData = [
                'agent_service' => 0,
            ];
            $request->merge($newData);
        }
       
        $validate = Validator::make($request->all(),
            [ 
                'tenant' =>  'required_if:guest_tenant,null',
                'landlord' =>  'required_if:guest_landlord,null',
                'address' => 'required',
                'agreement' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'security_deposit' => 'required',
                'utility_deposit' => 'required',
                'rental_amount'=>'required',
                'tenant_name' =>  'required_if:guest_tenant,yes', 
                'landlord_name' =>  'required_if:guest_landlord,yes', 
                'tenant_ic_number' =>  ['required_if:guest_tenant,yes'],
                'landlord_ic_number' => ['required_if:guest_landlord,yes'],
                'tenant_email' =>  ['required_if:guest_tenant,yes'],
                'landlord_email' =>  ['required_if:guest_landlord,yes'],
           ]);
           
            if($validate->fails()){
                return $this->resp(0, $validate->messages()->first(), [], 500);
            }
            
            $user_id =  auth()->guard(userGuard())->user()->id;
            $tenant = '';
            if($request->guest_tenant == 'yes'){
                $test = $this->checkValidation($type="tenant",$request);     
                if($test['error']){
                        return $this->resp('0', $test['message'], [], 500);
                }
                if($request->guest_landlord == 'yes'){
                    $test = $this->checkValidation($type="landlord",$request);     
                    if($test['error']){
                            return $this->resp('0', $test['message'], [], 500);
                    }
                }
               $tenant =   $this->createTenantLandlord($request,$user_id,$role = 4);
            }else{
               $tenant =   $request->tenant;
            }

             if($request->guest_landlord == 'yes'){
                $test = $this->checkValidation($type="landlord",$request);     
                if($test['error']){
                        return $this->resp('0', $test['message'], [], 500);
                }
               
                $landlord =  $this->createTenantLandlord($request,$user_id, $role = 3);
             }else{
                $landlord = $request->landlord;
             }

            $startDate = Carbon::parse($request->start_date) ;            
            $endDate   = Carbon::parse($request->end_date) ;         
                if(isset($request->id)){
                    $action = RentalAgreement::where('id',$request->id)->first();
                }else{
                    $action =  new RentalAgreement(); 
                }
                $duration =   $startDate->diffInMonths($endDate);
               
                $action->agent_id = $user_id;
                $action->tenant_id = $tenant; 
                $action->landlord_id = $landlord; 
                $action->agreement_id = $request->agreement; 
                $action->rental_amount = $request->rental_amount; 
                $action->address = $request->address; 
                $action->start_date = $startDate; 
                $action->end_date = $endDate; 
                $action->duration = $duration; 
                $action->security_deposit = $request->security_deposit; 
                $action->utility_deposit = $request->utility_deposit; 
                $action->agent_service = $request->agent_service ;
                $action->status = 1;
                $action->save(); 
                
                if($action){
                //  return $this->resp('1', 'Rental Agreement created successfully', [], 200);
                }
                
                // return $this->resp('0', 'Action Failed ! Please try again later.', [], 500);  
                return redirect()->back();
    }
           
        public function checkValidation($type,$request){

            if($type == 'tenant'){
                    $validator = Validator::make($request->all(), [
                        'tenant_email' => 'required|email|unique:users,email',
                        'tenant_ic_number' => 'required|unique:users,identity_number',

                    ],
                    [
                        'tenant_email.required' => 'The tenant email is required.',
                        'tenant_email.unique' => 'This tenant email is already in use.',
                        'tenant_ic_number.required' => 'The tenant IC number is required.',
                        'tenant_ic_number.unique' => 'This tenant IC number is already in use.'
                    ]
                );
            }else{
                $validator = Validator::make($request->all(), [
                        'landlord_email' => 'required|email|unique:users,email',
                        'landlord_ic_number' => 'required|unique:users,identity_number',
                    ],
                    [
                        'landlord_email.required' => 'The landlord email is required.',
                        'landlord_email.unique' => 'This landlord email is already in use.',
                        'tenant_ic_number.required' => 'The landlord IC number is required.',
                        'tenant_ic_number.unique' => 'This landlord IC number is already in use.'
                    ]
                );
            }
            
            if($validator->fails()){
                return $response = [
                    'error'=>true,
                    'message'=>$validator->messages()->first()
                ];
            }
           
            return $response = [
                    'error'=>false,
            ];
          

           
        }

            
    public function createTenantLandlord($request,$agent_id,$role){
        $password =  Str::random(8);
        $hashPassword =   Hash::make($password);
        $create =  new  User();
        if($role == 3){
            // landlord
        $create->name = $request->landlord_name;
        $create->email = $request->landlord_email;
        $create->identity_number = $request->landlord_ic_number;
        $create->role = 3;
        }else{
        $create->name = $request->tenant_name;
        $create->email = $request->tenant_email;
        $create->identity_number = $request->tenant_ic_number;
        $create->role = 4;
       }
      $create->is_guest  = 1;
      $create->agent_id  = $agent_id;
      $create->password =  $hashPassword;
      $create->gender = 1;
      $create->status = 1;
      $create->is_active = 1;
      $create->save();
        if($create){
            try{
                Mail::send('email.sendEmail',['password'=>$password,
                'email'=>$create->email], function($message) use($create){
                    $message->to($create->email);
                    $message->subject(siteName().'Register');
                });
            }catch(\Exception $ex){
                Log::error('Error Occured at sending email'.$ex->getMessage());
            }
            return $create->id;
        }
    }
    
    public function activeDeactiveTenant(Request $request){
       $msgTemplate =  RentalAgreement::find($request->id);
       if($msgTemplate){
            $msgTemplate->status = !$msgTemplate->status;
            $msgTemplate->save();
            return response()->json(['success'=>true,'status'=>$msgTemplate->status]);
       }
       return response()->json(['success'=>false]);
    }

     public function downloadReceipt($id){
        $user_id =  auth()->guard(userGuard())->user()->id;
        $data =   RentalAgreement::where('agent_id',$user_id)
                        ->where('id',$id)->with(['tenant','landlord'])->first();
        $pdf = PDF::loadView('receipt',['data' => $data->toArray()])->setPaper('a4','portrait');
        return $pdf->stream('sample.pdf');
    }
     public function createinvoice($id){
        $user_id =  auth()->guard(userGuard())->user()->id;
        $data =   RentalAgreement::where('id',$id)->with(['tenant', 'landlord'])->first();
        // echo "<pre>";
        // print_r($data);
        // die();
        $action =  new Invoice();
        $tax =  ($data->rental_amount* 1) / 100;
        $array[] =[
            'items' => $data->tenant->name.' with '.$data->landlord->name,
            'descriptions' => "Rental agreement for ". $data->tenant->name.' tenant and '.$data->landlord->name." landlord",
            'amounts' => $data->rental_amount ?? null,
        ];
        $total = $data->rental_amount;
        $item_list =  json_encode($array);
        $action->agent_id = $user_id;
        $action->r_agreement_id = $id;
        $action->name = $data->tenant->name.' with '.$data->landlord->name; 
        $action->identity_number = rand(1000, 9999); 
        $action->item_list = $item_list; 
        $action->sub_total = $data->rental_amount; 
        $action->service_tax = $tax; 
        $action->total = $total; 
        $action->invoice_type = "Rental Invoice"; 
        $action->status = 0;
        $action->save(); 
        
                if($action){
                     return back();
                }
                
                return $this->resp('0', 'Action Failed ! Please try again later.', [], 500); 
       
    }
    
     public function gotinvoice($id){
        $user_id =  auth()->guard(userGuard())->user()->id;
        $data =   RentalAgreement::where('rental_agreement_id',$user_id)
                        ->where('id',$id)->with(['tenant','landlord'])->first();
        $pdf = PDF::loadView('receipt',['data' => $data->toArray()])->setPaper('a4','portrait');
        return $pdf->stream('sample.pdf');
    }

}