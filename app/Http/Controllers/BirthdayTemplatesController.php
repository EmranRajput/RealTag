<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\BirthdayTemplate;
use Validator,Hash;
use Illuminate\Support\Facades\DB;


class BirthdayTemplatesController extends Controller
{
    public function index(){

        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $templates =  BirthdayTemplate::where('user_id',$user_id)->get();
            $title = "Meesages";
            return view('birthday.index',compact('templates', 'title'));
        }
       
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   BirthdayTemplate::where('id',$request->id)->where('user_id',$user_id)->first();
            if($deleteUser){
                if($deleteUser->default){
                    return response()->json(['error'=>'You can not delete default template!']);
                }
                $deleteUser->delete();
                return response()->json(['success'=>'Message Template Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    public function edit($id = null){
        if(isset($id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $getData =   BirthdayTemplate::where('id',$id)->where('user_id',$user_id)->first();
            if($getData){
              return view('birthday.create',compact('getData')); 
            }
            return redirect(request('backurl', route('birthday.templates')))->with('error', 'Birthday Template not found.');
        }
              return view('birthday.create'); 

    }
    public function createUpdate(Request $request){
        $default_status = 0;
        
        $validate = Validator::make($request->all(),
        [
             'name' => 'required',
             'description'=>'required',
        ]);
        if($validate->fails()){
         
            return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        }
        
          $user_id =  auth()->guard(userGuard())->user()->id;    
            if(isset($request->id)){
            $action =  BirthdayTemplate::where('id',$request->id)->first();
            }else{
              $getTemplate =   BirthdayTemplate::first();
              if(!$getTemplate){
                  $default_status = 1;
              }
                $action =    new  BirthdayTemplate();   
            }
        
            $action->name = $request->name;
            $action->description = $request->description;
            $action->user_id = $user_id;
            $action->is_default = $default_status;
            $action->save();
           
            if($action){
                return redirect()->route('birthday.templates')->with('success', 'Action performed Successfully.');      
            }
                return redirect()->back()->with('error', 'Action Failed.');      
    }

    public function activeDeactiveBirthdayTemplate(Request $request){
       $bthdyTemplate =  BirthdayTemplate::find($request->id);
       if($bthdyTemplate){
            $bthdyTemplate->status = !$bthdyTemplate->status;
            $bthdyTemplate->save();
            return response()->json(['success'=>true,'status'=>$bthdyTemplate->status]);
       }
       return response()->json(['success'=>false]);
    }

     public function setTemplateDefault(Request $request){
       $bthdyTemplatee =  BirthdayTemplate::find($request->id);
       
       if($bthdyTemplatee){
            if(!$bthdyTemplatee->status!=1){
                return response()->json(['error'=>'Action failed ! Can not set default the deactive template .']);
            }
            
            $updateTemplates =     BirthdayTemplate::whereNot('id',$request->id)->update(['is_default'=>0]);
           $updateTemplates =     BirthdayTemplate::where('id',$request->id)->update(['is_default'=>1]);
            // $bthdyTemplatee->update(['is_default' => 1]);
            return response()->json(['success'=>'Birthday template set to default!']);
       }else{
            return response()->json(['error'=>'AAAAction failed ! Please try again later .']);
       }
    }

    

}