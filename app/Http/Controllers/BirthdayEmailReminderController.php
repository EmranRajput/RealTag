<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\birthdayEmailReminder;
use Illuminate\Http\Request;

class BirthdayEmailReminderController extends Controller
{
 public function birthdayRemiderUpdate(request $request){

    $user_id = $request->user_id;
    // die();
    $agent_id = auth()->guard(userGuard())->user()->id;
    
     $users = birthdayEmailReminder::where('agent_id',$agent_id)->where('user_id',$user_id)->get();
     
        if ($users->count() > 0) {
            foreach($users as $alreadyAdded){
                 if ($alreadyAdded->status == 1) {
                    // If already active, deactivate it
                    $alreadyAdded->status = 0;
                    $alreadyAdded->save();
                    return response()->json(['success' => true, 'status' => 0]);
                }else{
                    $alreadyAdded->status = 1;
                    $alreadyAdded->save();
                    return response()->json(['success' => true, 'status' =>1]);
                }
            }

        }else{
            $new = new birthdayEmailReminder;
            $new->agent_id = $agent_id;
            $new->user_id = $user_id;
            $new->status = 1; // Assuming 1 represents the activated status
            $new->save();
            return response()->json(['success' => true, 'status' => $new->status]);
        }
        return response()->json(['success' => false]);
 }
}
