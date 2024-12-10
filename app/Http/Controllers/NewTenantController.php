<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Tanent;
use App\Models\User;
use Mail,Session,Validator,Auth,Str;
use App\Mail\TanentInviteMail;
use App\Traits\TraitController;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;

class NewTenantController extends Controller
{
     use TraitController;
     public function index(Request $request){
        if(Auth::guard(userGuard())->check()){
            $user_id =  auth()->guard(userGuard())->user()->id;
                   $query = User::leftJoin('birthday_email_reminders', 'users.id', '=', 'birthday_email_reminders.user_id')
            ->where('users.role', 4)
            ->whereRaw("FIND_IN_SET(?, users.agent_id)", [$user_id])
            ->orderBy('users.id', 'desc')
            ->select('users.*', 'birthday_email_reminders.status as bstatus');
            if(isset($request->search)){
               $query = $query
                    ->where(function ($querys) use ($request) {
                        $querys->where('phone_number', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('identity_number', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('name', 'LIKE', '%' . $request->search . '%');
                    });
            }
            $templates = $query->cursorPaginate(20);
            $title = "Meesages";
            return view('newTenant.index',compact('templates', 'title'));
        }
    }
    public function delete(Request $request){
        if(isset($request->id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $deleteUser =   User::where('id',$request->id)->where('agent_id',$user_id)->delete();
            if($deleteUser){
                return response()->json(['success'=>'Tenant Deleted Successfully!']);
            }
        }
                return response()->json(['error'=>'Some Error Occurred!']);
    }
    public function edit($id = null){
        if(isset($id)){
            $user_id =  auth()->guard(userGuard())->user()->id;
            $getData =   User::where('id',$id)->where('agent_id',$user_id)->first();
            if($getData){
              return view('newTenant.create',compact('getData')); 
            }
            return redirect(request('backurl', route('agent.tenants')))->with('error', 'Tenant not found.');
        }
          return view('newTenant.create');

    }
      public function createUpdate(Request $request){
        $id = '';
        $user_id =  auth()->guard(userGuard())->user()->id;
        $email = $request->email;
        $alreadyTenant = User::where('email',$email)->first();
        
        
        if($alreadyTenant){
            $agnt_id = $alreadyTenant->agent_id;
            $idsArray = explode(',', $agnt_id);
            if(in_array($user_id, $idsArray)){
                if(isset($request->id)){
                    $id = $request->id;
                    $validate = Validator::make($request->all(),
                    [
                        'full_name' => 'required',
                        'email' => 'required|unique:users,email,'. $id ,
                        'contact_number'=>'required|min:7|unique:users,phone_number,' . $id,
                        'passport_number'=>'required|min:7|unique:users,identity_number,'. $id,
                  
                    ]);
                }else{
                    $validate = Validator::make($request->all(),
                    [
                        'full_name' => 'required',
                        'email' => 'required|unique:users,email',
                        'contact_number'=>'required|min:7|unique:users,phone_number',
                        'passport_number'=>'required|min:7|unique:users,identity_number',
                    ]);
                }
               
                if($validate->fails()){
                    return $this->resp(0, $validate->messages()->first(), [], 500);
                }
            }else{
                $idsArray[] = $user_id;
                $newString = implode(',', $idsArray);
                $action = User::where('id',$alreadyTenant->id)->first();
                $action->agent_id = $newString;
                $action->save();
                if($action){
                    // if(!$id){
                    //     try{
                    //         Mail::send('email.inviteAgent',['email'=>$action->email,'password'=>'Password is your previous one.',
                    //         'inviterName'=>logName()], 
                    //         function($message) use($request){
                    //             $message->to($request->email);
                    //             $message->subject(siteName().' Invite');
                    //         });
                    //     }catch(\Exception $e){
                    //         Log::info('Email send issue at Inviting email:' . $e);
                    //     }
                    //     return $this->resp('1', 'Tenant created successfully', [], 200);
                    // }
                       return $this->resp('1', 'Tenant updated successfully', [], 200);   
                }
            }
        }else{
           if(isset($request->id)){
                $id = $request->id;
                $validate = Validator::make($request->all(),
                [
                    'full_name' => 'required',
                    'email' => 'required|unique:users,email,'. $id ,
                    'contact_number'=>'required|min:7|unique:users,phone_number,' . $id,
                    'passport_number'=>'required|min:7|unique:users,identity_number,'. $id,
              
                ]);
            }else{
                $validate = Validator::make($request->all(),
                [
                    'full_name' => 'required',
                    'email' => 'required|unique:users,email',
                    'contact_number'=>'required|min:7|unique:users,phone_number',
                    'passport_number'=>'required|min:7|unique:users,identity_number',
                ]);
            }
           
            if($validate->fails()){
                return $this->resp(0, $validate->messages()->first(), [], 500);
            }
            $user_id =  auth()->guard(userGuard())->user()->id;            
            if(isset($request->id)){
                $action = User::where('id',$request->id)->first();
            }else{
                $action =  new User(); 
                $password = Str::random(8);
                $hashPassword =   Hash::make($password);
                $action->password = $hashPassword; 
                $action->gender = 1; 
                $action->status = 0; 
                $action->is_active = 0; 
                $action->role = 4; 
            }
            $action->agent_id = $user_id;
            $action->name = $request->full_name;
            $action->email = $request->email;
            $action->identity_number = $request->passport_number;
            $action->phone_number = $request->contact_number;
            $action->save();
            if($action){
                if(!$id){
                    try{
                        Mail::send('email.inviteAgent',['email'=>$action->email,'password'=>$password,
                        'inviterName'=>logName()], 
                        function($message) use($request){
                        $message->to($request->email);
                        $message->subject(siteName().' Invite');
                        });
                    }catch(\Exception $e){
                        Log::info('Email send issue at Inviting email:' . $e);
                    }
                // return $this->resp('1', 'Tenant created successfully', [], 200);
                }
                //   return $this->resp('1', 'Tenant updated successfully', [], 200);   
            }
                //   return $this->resp('0', 'Action Failed ! Please try again later.', [], 500);   
        }
        return redirect()->back();    //temporary add redirect 
    }

    public function activeDeactiveTenant(Request $request){
       $msgTemplate =  User::find($request->id);
       if($msgTemplate){
            $msgTemplate->status = !$msgTemplate->status;
            $msgTemplate->save();
            return response()->json(['success'=>true,'status'=>$msgTemplate->status]);
       }
       return response()->json(['success'=>false]);
    }
     public function downloadContact(){
      
        $user_id = auth()->guard(userGuard())->user()->id;
        $users = User::where('role', 4)->where('status', 1)->whereRaw("FIND_IN_SET(?, users.agent_id)", [$user_id])->get(['name', 'phone_number']);
    
        $csv = Writer::createFromString('');
        $csv->insertOne(['Name', 'Phone Number']);
    
        $userData = [];
        foreach ($users as $user) {
            $userData[] = [$user->name, $user->phone_number];
        }
    
        $csv->insertAll($userData);
    
        $csvFileName = 'Tenant_contacts_' . now()->format('YmdHis') . '.csv';
    
        return response()->stream(
            function () use ($csv) {
                $csv->output();
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
            ]
        );

    }
    
}