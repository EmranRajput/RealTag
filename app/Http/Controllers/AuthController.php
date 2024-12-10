<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response, Session, Auth, DB, File, Storage, Hash, Validator, Carbon\Carbon, View, SimpleXMLElement, DOMDocument;
use App\Models\User;
use App\Models\Tanent;
use Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	use \App\Traits\TraitController;
    
    public function __construct() {
	}

    public function login(Request $request) {
        $currentUrl = $request->url();
        $tenent = false;
        if (strpos($currentUrl, 'tenent') !== false) {
            $tenent = true;
        }
    //    echo Hash::make('admin_123');
    //     die;
        return  view('auth.login', [
			'title' => 'Login',
            'tenent'=>$tenent,
        ]);
	}
    
    public function telentLogin(Request $request){
        $auth = auth()->guard('tenent');
		$error = '';
        $credentials = [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                       ];
        if ($user = Tanent::where('email', request('email'))->first()) {
            if($user->status){
                if (request('password') == $user->password) {
                    if($auth->loginUsingId($user->id)){
                          return redirect(request('backurl', route('app.dashboard.tenent')))->with('success', 'Login successful');
                    }     
                }else{
                    $error = "Password is invalid";
                }
            }else{
			    $error = 'Tenent is deactivated.';
            }
		} else {
			$error = 'Email is invalid.';
		}
		return redirect()->route('app.telent.login')->withInput()->with('error', $error);
    }
    
    public function loginSubmit() {
		$auth = auth()->guard(userGuard());
		$error = '';
		if ($user = User::where('email', request('email'))->first()) {
            if($user->status){
            // if($user->is_active){
                if ($user->isActive() && in_array($user->printRole(),User::roles())) {
                    if (Hash::check(request('password'), $user->password)) {
                        $auth->login($user, request('rememberme') ? true : false);
                        return redirect(request('backurl', route('app.dashboard')))->with('success', 'Login successful');
                    }else{
                        $error = "Password is invalid";
                    }
                } else {
                    $error = 'You account is inactive or not valid';
                }
            }else{
			    $error = 'Account is deactivated,please contact admin.';
            }
		} else {
			$error = 'Email is invalid.';
		}
		return redirect()->back()->withInput()->with('error', $error);
	}
	public function logout() {
		if (logId()) {
			auth()->guard(userGuard())->logout();
		}
		return redirect()->route('app.login'); //->with('success', trans('messages.logout'));
	}
    public function showForgetPasswordForm(){
        return view('auth.nw-forgot', [
			'title' => 'Reset Password',
		]);
    }
    public function submitForgetPasswordForm(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ],[
            'email.required'=>"Email is required",
            'email.email'=>"Must be email",
            'email.exists'=>"User not found check your email address"
        ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        }
        $token = Str::random(64);

        $data = [
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
           $role = User::ROLE_AGENT; 
           
        $condition = [
            'email' => $request->email,
        ];
        DB::table('password_resets')->updateOrInsert($condition, $data);
        Mail::send('email.forgot-password', 
        ['token' => $token,'role'=>$role], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function resetPassword(Request $request){
        return view('auth.reset-password', ['token' => $request->token]);
    }

    public function submitResetPasswordForm(Request $request)
      {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
              'password' => 'required|confirmed',
              'password_confirmation' => 'required'
        ],[
            'email.required'=>"Email is required",
            'email.email'=>"Must be email",
            'email.exists'=>"User not found check your email address",
            'password.required'=>'Password is required',
            'password_confirmation.required'=>'Confirm password is required',
            'password.confirmed'=>"password is not match with confirm passwrod"

        ]);
        if($validate->fails()){
            return redirect()->back()->withInput()->with('error', $validate->messages()->first());
        }
        $updatePassword = DB::table('password_resets')
                            ->where([
                            'email' => $request->email,
                            'token' => $request->token
                            ])
                            ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return redirect('/login')->with('success', 'Your password has been changed!');
      }
}