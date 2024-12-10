<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Traits\TraitController;


class EmailTemplatesController extends Controller
{
    use TraitController;
    public function index(){

        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $templates =  EmailTemplate::where('agent_id',$user_id)->get();
            $title = "Email";
            return view('emailtemplate.index',compact('templates', 'title'));
        }
       
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   EmailTemplate::where('id',$request->id)->where('agent_id',$user_id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Message Template Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    public function edit($id = null){
        if(isset($id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $getData =   EmailTemplate::where('id',$id)->where('agent_id',$user_id)->first();
            if($getData){
              return view('emailtemplate.create',compact('getData')); 
            }
            return redirect(request('backurl', route('email.templates')))->with('error', 'Message Template not found.');
        }
              return view('emailtemplate.create'); 

    }
    public function createUpdate(Request $request){
        
        //  $validate = Validator::make($request->all(),
        // [
        //      'name' => 'required',
        //      'description'=>'required',
        // ]
        // );
        // if($validate->fails()){
         
        //     return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        // }
        
        //     $user_id =  auth()->guard(userGuard())->user()->id;    
        //     if(isset($request->id)){
        //     $action =  EmailTemplate::where('id',$request->id)->first();
        //     }else{
            $user_id =  auth()->guard(userGuard())->user()->id;    
            if(isset($request->id)){
            $action =  EmailTemplate::where('id',$request->id)->first();
            }else{
                $action =    new  EmailTemplate();   
            }
        
            $action->name = $request->name;
            $action->description =  $request->input('description');
            $action->agent_id = $user_id;
            $action->category = $request->input('emailType');
            $action->save();
            return redirect()->back();
           
            //  if($action){
            //      return $this->resp('1', 'Email template created successfully', [], 200);
            //     }
                
            //     return $this->resp('0', 'Action Failed ! Please try again later.', [], 500);     
    }


    public function activeDeactiveMessageTemplate(Request $request){
       $msgTemplate = EmailTemplate::find($request->id);

        if ($msgTemplate) {
            // Check if the selected template is already active
            if ($msgTemplate->status == 1) {
                // If already active, deactivate it
                $msgTemplate->status = 0;
                $msgTemplate->save();
    
                return response()->json(['success' => true, 'status' => $msgTemplate->status]);
            }
    
            // Check if any other template with the same category is active for the same agent
            $isAnyActiveTemplate = EmailTemplate::where('category', $msgTemplate->category)
                ->where('agent_id', $msgTemplate->agent_id)
                ->where('status', 1) // 1 represents activated status
                ->where('id', '!=', $msgTemplate->id) // Exclude the current template from the check
                ->exists();
    
            if (!$isAnyActiveTemplate) {
                // Deactivate other templates with the same category for the same agent
                EmailTemplate::where('category', $msgTemplate->category)
                    ->where('agent_id', $msgTemplate->agent_id)
                    ->where('id', '!=', $msgTemplate->id)
                    ->update(['status' => 0]);
    
                // Activate the selected template
                $msgTemplate->status = 1; // Assuming 1 represents the activated status
                $msgTemplate->save();
    
                return response()->json(['success' => true, 'status' => $msgTemplate->status]);
            } else {
                \Log::info('Another template is already active for this agent and category.');
                return response()->json(['success' => false, 'message' => 'Another template is already active for this agent and category.']);
            }
        }
    
        return response()->json(['success' => false]);
    }
}
