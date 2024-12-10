<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\MessageTemplate;
use Validator,Hash;


class MessageTemplatesController extends Controller
{
    public function index(){

        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $templates =  MessageTemplate::where('user_id',$user_id)->get();
            $title = "Meesages";
            return view('templates.index',compact('templates', 'title'));
        }
       
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   MessageTemplate::where('id',$request->id)->where('user_id',$user_id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Message Template Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    public function edit($id = null){
        if(isset($id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $getData =   MessageTemplate::where('id',$id)->where('user_id',$user_id)->first();
            if($getData){
              return view('templates.create',compact('getData')); 
            }
            return redirect(request('backurl', route('message.templates')))->with('error', 'Message Template not found.');
        }
              return view('templates.create'); 

    }
    public function createUpdate(Request $request){
        
         $validate = Validator::make($request->all(),
        [
             'name' => 'required',
             'description'=>'required',
        ]
        );
        if($validate->fails()){
         
            return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        }
        
            $user_id =  auth()->guard(userGuard())->user()->id;    
            if(isset($request->id)){
            $action =  MessageTemplate::where('id',$request->id)->first();
            }else{
                $action =    new  MessageTemplate();   
            }
        
            $action->name = $request->name;
            $action->description = $request->description;
            $action->user_id = $user_id;
            $action->save();
           
            if($action){
                return redirect()->route('message.templates')->with('success', 'Action performed Successfully.');      
            }
                return redirect()->back()->with('error', 'Action Failed.');      
    }


    public function activeDeactiveMessageTemplate(Request $request){
       $msgTemplate =  MessageTemplate::find($request->id);
       if($msgTemplate){
            $msgTemplate->status = !$msgTemplate->status;
            $msgTemplate->save();
            return response()->json(['success'=>true,'status'=>$msgTemplate->status]);
       }
       return response()->json(['success'=>false]);
    }
}