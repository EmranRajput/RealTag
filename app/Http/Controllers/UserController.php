<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvoiceSetting;
use Validator,Hash;
class UserController extends Controller
{
    use \App\Traits\TraitController;

    public function crudTitle($single = 0)
	{
		return $single ? 'User' : 'Users';
	}
	public function crudView($type)
	{
		return 'super-admin.' . $type;
	}

    public function updateProfileForm(){
        $id = logId();
        $result = InvoiceSetting::where('agent_id', $id)->first();
        // dd($result);
        return view('profile.profile',
                [
                    'title'=>'Profile',
                    'urlSave'=>routePut('app.profile.save'),
                    'paswordChange'=>routePut('app.password.save'),
                    'inv_setting'=>$result
                ]
            );
    }
    public function updateProfile(){
       
        $id = logId();
        $validate = Validator::make(request()->all(),
        [
            'ic_number' => 'required|numeric|min:12',
             'first_name'=>'required|alpha_num',
             'last_name'=>'required|alpha_num',
             'phone_number'=>'required|unique:users,phone_number,'.$id,
             'gender'=>'required',
             'bitrh_date'=>'required',
             'address'=>'required',
        ]
        );
        if($validate->fails()){
            return $this->resp(0, $validate->messages()->first(), [], 500);
        }
       
        $name = request()->first_name." ".request()->last_name;
        $dob= dbDate(request()->bitrh_date);
        $phoneNumber = request()->phone_number ;
        $address = request()->address ;
       
        $gender = request()->gender;
        $ic_number = request()->ic_number;
        $reminderEmail=request()->reminder;
        $reminder_birthday=request()->reminder_birthday;
    
        try {
            if(userLogin()){
                $single = User::find($id);
                $single->name = $name;
                $single->address = $address;
                $single->phone_number = $phoneNumber;
                $single->birth_date = $dob;
                $single->gender = $gender;
                $single->ic_number = $ic_number;
                if(request()->hasFile('profile_image')){
                    $file = request()->profile_image;
                    $single->putFile('profile_photo', $file, 'profile');
                }
                 $single->reminder_email_toggle = $reminderEmail;
                 $single->birthday_reminder_toggle = $reminder_birthday;
                 
                $single->save();
            }
        //      return $this->resp(1, getMsg('updated', ['name' => $this->crudTitle(1)])
                 
        //  );
        return redirect()->back();
        }  catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}
    }
    public function changePassword(){
        $validate = Validator::make(request()->all(),
        [
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            
        ]
        );
        if($validate->fails()){
            return $this->resp(0, $validate->messages()->first(), [], 500);
        }
        try {
            if(userLogin()){
                $user  = userLogin();
                $user->password = Hash::make(request()->password);
                $user->save();
                return $this->resp(1, getMsg('updated', ['name' => $this->crudTitle(1)]), [
                    'url' => routePut('app.profile'),
                ]);
            }
        } catch (\Throwable $th) {
            return $this->resp(0, exMessage($th), [], 500);
        }
        return $this->resp(0, $validate->messages()->first(), [], 500);
    }

    public function getUsers(Request $request){
         $query =  User::query();
         //search bar
        if(isset($request->search)){
            $query->whereRaw("(name like '%$request->search%' or email like '%$request->search%' or ic_number like '%$request->search%' or phone_number like '%$request->search%')");
        }
        //filter role
        if(isset($request->role)){
          $query->where('role', $request->role);
        }
        $users = $query->paginate(20);
        return view('users.index',compact('users','query'));
    }
    
    //User Profile show
      public function getUserProfile(Request $request){
        $users = User::find($request->id);
         return response()->json(['success' => true,'users'=>$users]);
        // return view('users.index',compact('users','query'));

    }


    public function activeDeactiveUser(Request $request){
       $user =  User::find($request->id);
       if($user){
            $user->is_active = !$user->is_active;
            $user->save();
            return response()->json(['success'=>true,'status'=>$user->is_active]);
       }
       return response()->json(['success'=>false]);

    }
}