<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invoice;
use App\Helpers\DataTableHelper;
use App\Traits\TraitController;
use App\Helpers\FileHelper;
use Mail,Session,Auth,Str;
use Validator,Hash;
use PDF;
use App\Http\Controllers\InvoiceSettingController;
use App\Models\InvoiceSetting;
class InvoiceController extends Controller
{
    use TraitController;

    public function index(Request $request){
        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $query =  Invoice::where('agent_id',$user_id)->orderBy('id','desc');
            if(isset($request->search)){
           $query->where(function ($querys) use ($request) {
                        $querys->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('invoice_type', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('created_at', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('identity_number', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('invoice_number', 'LIKE', '%' . $request->search . '%');
                    });
            }
            $invoices = $query->cursorPaginate(20);
            $title = "Invoices";
            return view('invoices.index',compact('invoices', 'title'));
        }
    }

    
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   Invoice::where('id',$request->id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Invoice Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    
    public function edit($id = null){
          $getData   =  '';
          $item_lists = [];
          $user_id = auth()->guard(userGuard())->user()->id;
            if(isset($id)){
                $getData =   Invoice::where('id',$id)->first();
                if($getData){
                    $item_lists =    json_decode( $getData->item_list);
                    
                    // return view('invoices.create',compact('getData','item_lists')); 
                    return response()->json(['success'=>'1','data'=>json_encode(compact('getData','item_lists'))]);
                }
                // return redirect(request('backurl', route('invoices.index')))->with('error', 'Invoice not found.');
                return response()->json(['success'=>'0']);
            }
            return response()->json(['success'=>'1']);
         
        //   return view('invoices.create',compact('item_lists'));
    }
    
    public function createUpdate(Request $request){
        $validate = Validator::make($request->all(),
            [ 
                'name' =>  'required',
                'identity_number' =>  'required',
                'invoice_type' => 'required',
                'service_tax'=>'required|numeric',
                'items'=>'required',
                'descriptions'=>'required',
                
            ]);
           
            if($validate->fails()){
                return $this->resp(0, $validate->messages()->first(), [], 500);
            }
            
            $user_id =  auth()->guard(userGuard())->user()->id;

            if(isset($request->id)){
                $action = Invoice::where('id',$request->id)->first();
            }else{
                $action =  new Invoice(); 
            }
                $item_list= '';
                $sub_total = 0;
                $total = 0;
                $amount = 0;
                $array = [];
                $inputs = $request->only(['items', 'descriptions', 'amounts']);
                foreach ($inputs['items'] as $key => $item) {
                    $array[] =[
                        'items' => $item,
                        'descriptions' => $inputs['descriptions'][$key] ?? null,
                        'amounts' => $inputs['amounts'][$key] ?? null,
                    ];
                    $sub_total += $inputs['amounts'][$key];
                }
                
                $tax =  ( $sub_total * $request->service_tax) / 100;
                $total = $tax + $sub_total;
                $item_list =  json_encode($array);
                $action->agent_id = $user_id;
                $action->name = $request->name; 
                $action->identity_number = $request->identity_number; 
                $action->item_list = $item_list; 
                $action->sub_total = $sub_total; 
                $action->service_tax = $request->service_tax; 
                $action->total = $total; 
                $action->invoice_type = $request->invoice_type; 
                $action->status = 0;
                $action->save(); 
                
                // if($action){
                    //  return $this->resp('1', 'Invoice created successfully', [], 200);
                // }
                
                // return $this->resp('0', 'Action Failed ! Please try again later.', [], 500);
                return redirect()->back();  //temporary add
    }


    

    public function createTenantLandlord($request,$agent_id,$role){
        $password =  Str::random(8);
        $hashPassword =   Hash::make($password);
        $create =  new  User();
        if($role == 3){
            // landlord
        $create->name = $request->landlord_name;
        $create->email = $request->landlord_ic_number.'@rms.com';
        $create->identity_number = $request->landlord_ic_number;
       
        $create->role = 3;
        }else{
        $create->name = $request->tenant_name;
        $create->email = $request->tenant_ic_number.'@rms.com';
        $create->identity_number = $request->tenant_ic_number;
        $create->role = 4;
      
        }
      $create->is_guest  = 1;
      $create->agent_id  = $agent_id;
      $create->password =  $password;
      $create->gender = 1;
      $create->status = 1;
      $create->is_active = 1;
      $create->save();
        if($create){
            return $create->id;
        }
    }
   
    public function changeStatus(Request $request){
       $invoivce =  Invoice::where('id',$request->id)->where('agent_id',auth()->guard(userGuard())->user()->id)->first();
       if($invoivce){
            $invoivce->status = $request->status;
            $invoivce->save();
            return response()->json(['success'=>'Action perfomed Successfully! Status Changed','api_status'=>true]);
       }
       return response()->json(['success'=>false,'error'=>'Action Failed!Status not changed.']);
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

     public function downloadReceipt($id,$type){
      
        $user_id =  auth()->guard(userGuard())->user()->id;
        $invSetting = InvoiceSetting::all()->first();
       
        $data = Invoice::leftJoin('rental_agreements', 'rental_agreements.id', '=', 'invoices.r_agreement_id')
                ->where('invoices.agent_id', $user_id)
                ->where('invoices.id', $id)
                ->first(['invoices.*', 'rental_agreements.id as rental_id']);
        $pdf = PDF::loadView('receipt',['data' => $data->toArray() ,'type'=>$type, 'invsetting'=>$invSetting->toArray()])->setPaper('a4','portrait');
        // return loadview()
        // return view('receipt',['data' => $data->toArray() ,'type'=>$type, 'invsetting'=>$invSetting->toArray()]);
        return $pdf->download('RP-'.$data->rental_id.'-'.now()->format('mY').'-'.substr($data->invoice_number, -4).'.pdf');
        

        // $phpWord = new \PhpOffice\PhpWord\PhpWord();
        // $section = $phpWord->addSection();
        // $text = $section->addText('hamz akhan');
        // $text = $section->addText('hamza@gmail.com ');
        // $text = $section->addText('23423423',array('name'=>'Arial','size' => 20,'bold' => true));
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save('office.docx');
        // return response()->download(public_path('office.docx'));
    }
}