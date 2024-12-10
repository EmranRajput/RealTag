<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agreement;
use App\Models\Constant;
use App\Helpers\DataTableHelper;
use App\Traits\TraitController;
use App\Helpers\FileHelper;


use Mail,Session,Validator;

class AgreementController extends Controller
{
    use TraitController;
    public function index(Request $request){

            $user_id =  auth()->guard(userGuard())->user()->id;
            $query =    Agreement::query();
            if(isset($request->search)){
                $query->whereRaw("(title like '%$request->search%')");
            }
            $agreements = $query->paginate(20);
            $title = "Agreements";
            return view('agreements.index',compact('agreements','title'));
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $deleteUser =   Agreement::where('id',$request->id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Agreement Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    public function edit($id = null){
        $constants = Constant::all();
        if(isset($id)){
            $getData =   Agreement::where('id',$id)->first();
            if($getData){
              return view('agreements.create', compact('getData', 'constants') ); 
            }
            return redirect(request('backurl', route('user.agreements')))->with('error', 'Agreement not found.');
        }
              return view('agreements.create', compact('constants')); 

    }
    public function createUpdate(Request $request){
         $validate = Validator::make($request->all(),
        [
             'title'=>'required',
             'descriptions'=>'required',
            
        ]
        );
        if($validate->fails()){
                return $this->resp(0, $validate->messages()->first(), [], 500);
            // return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        }
      
            if(isset($request->id)){
                $action =  Agreement::where('id',$request->id)->first();
                $status = $action->status;
            }else{
                $action = new Agreement();  
                $status = 1; 
            }
            $action->descriptions = $request->descriptions;
            $action->title = $request->title;
            $action->status = $status;
            $action->save();
            if($action){
                //  return $this->resp('1', 'Action performed Successfully', [], 200);
                return redirect()->route('user.agreements')->with('success', 'Action performed Successfully.');      
            }
                //  return $this->resp('0', 'Action Failed ! Plwase try again later .', [], 200);
            
            return redirect()->back()->with('error', 'Action Failed.');      
    }
    
      public function activeDeactiveUser(Request $request){
       $agreement =  Agreement::find($request->id);
       if($agreement){
            $agreement->status = !$agreement->status;
            $agreement->save();
            return response()->json(['success'=>true,'status'=>$agreement->status]);
       }
       return response()->json(['success'=>false]);

    }
}