<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\RentalTemplate;
use Validator,Hash;


class RentalTemplateController extends Controller
{
    public function index(){

        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $templates =  RentalTemplate::where('user_id',$user_id)->get();
            $title = "Meesages";
            return view('rental.index',compact('templates', 'title'));
        }
       
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   RentalTemplate::where('id',$request->id)->where('user_id',$user_id)->first();
            if($deleteUser){
                if($deleteUser->is_default){
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
            $getData =   RentalTemplate::where('id',$id)->where('user_id',$user_id)->first();
            if($getData){
              return view('rental.create',compact('getData')); 
            }
            return redirect(request('backurl', route('rental.templates')))->with('error', 'Rental Template not found.');
        }
              return view('rental.create'); 

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
            $action =  RentalTemplate::where('id',$request->id)->first();
            }else{
              $getTemplate =   RentalTemplate::first();
              if(!$getTemplate){
                  $default_status = 1;
              }
                $action =    new  RentalTemplate();   
            }
        
            $action->name = $request->name;
            $action->description = $request->description;
            $action->user_id = $user_id;
            $action->is_default = $default_status;
            $action->save();
           
            if($action){
                return redirect()->route('rental.templates')->with('success', 'Action performed Successfully.');      
            }
                return redirect()->back()->with('error', 'Action Failed.');      
    }

    public function activeDeactiveRentalTemplate(Request $request){
       $bthdyTemplate =  RentalTemplate::find($request->id);
       if($bthdyTemplate){
            $bthdyTemplate->status = !$bthdyTemplate->status;
            $bthdyTemplate->save();
            return response()->json(['success'=>true,'status'=>$bthdyTemplate->status]);
       }
       return response()->json(['success'=>false]);
    }

     public function setTemplateDefault(Request $request){
       $bthdyTemplate =  RentalTemplate::find($request->id);
       if($bthdyTemplate){
            $updateTemplates =     RentalTemplate::whereNot('id',$request->id)->update(['is_default'=>0]);;
            $bthdyTemplate->update(['is_default'=>1]);
            return response()->json(['success'=>'Rental template set to default!']);
       }
       return response()->json(['error'=>'Action failed ! Please try again later .']);
    }

    

}