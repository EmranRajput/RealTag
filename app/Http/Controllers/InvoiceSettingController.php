<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;
use Validator,Hash;

class InvoiceSettingController extends Controller
{
    use \App\Traits\TraitController;
    
   public function submitInvoice(Request $request)
   {
       $id = logId();
        $validate = Validator::make(request()->all(),
        [
            //  'logo' => 'required',
             'company_name'=>'required',
             'company_address'=>'required',
             'agent_id'=>'required',
             'contact'=>'required',
             'sst_id'=>'required',
             'service_tax'=>'required|numeric',
             'description'=>'required',
             'company_fax'=>'required',
        ]
        );
        // if($validate->fails()){
        //     return $this->resp(0, $validate->messages()->first(), [], 500);
        // }
          try {
           
                 if($request->logo){
                    $file= $request->logo;
                    $filename= $file->getClientOriginalName();
                    $file-> move(public_path('asset/images'), $filename);
                }
                
               if (isset($request->inv_set_id) && $request->inv_set_id!=0) {
                    $action = InvoiceSetting::where('agent_id',$id)->first();
                } else {
                    $action = new InvoiceSetting();
                }
                
                if ($action) {
                    $action->company_name = $request->company_name;
                    $action->logo = $filename;
                    $action->agent_id = $id;
                    $action->company_address = $request->company_address;
                    $action->company_fax = $request->company_fax;
                    $action->contact = $request->contact;
                    $action->sst_id = $request->sst_id;
                    $action->service_tax = $request->service_tax;
                    $action->description = $request->description;
                
                    $action->save();
                
                    $urlWith = url('profile');
                    return redirect($urlWith);
                    
                }
                // else{
                //     return $this->resp(0, $validate->messages()->first(), [], 500);
                // }
                
            }
            catch (\Exception $e) {
                // return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }
        // return $this->resp(0, $validate->messages()->first(), [], 500);
        return redirect()->back();
    
    }
}
