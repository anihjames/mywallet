<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\registerFormRequest as RegisterFormRequest;
use App\Http\Requests\LoginRequest as LoginFormRequest;
use App\Http\Requests\resetPasswordRequest as ResetPasswordrequest;
use App\User;
use App\Models\Wallet;
use App\Models\VerifyUser;
use App\Notifications\userRegistered;
use Illuminate\Support\Facades\Cache;
// use App\Traits\sendingMails;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifyAdmin;
use App\Mail\VerifyMail;
use App\Mail\resetPassword;
use Carbon\Carbon;
use Auth;


class UserController extends Controller
{
    

    public function loginview()
    {
        return view('auth.login');
    }

    public function registerview()
    {
        return view('auth.register');
    }

    public function reset()
    {
        return view('auth.resetemail');
    }

    public function passwordresetForm() 
    {
        return view('auth.passwordrestform');
    }


    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }


    public function getref_code() {
        $characters='ABCDEFHJKLMNPQRSTUVWXYZ';  
       $pin=mt_rand(100000,999999).mt_rand(100000,999999).$characters[rand(0,strlen($characters)-3)];
       $ref_no=str_shuffle($pin);
 
       return $ref_no;
     }

    public function Login(LoginFormRequest $request)
    {
        
        if (Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])) {
            $user = Auth::user();
            Cache::put('user', $user);
            //session(['user_id' => $user_id]);
            return redirect('/home');
        }
        return redirect()->back()->with('danger', 'This credentails not found');
    }

    public function Register(RegisterFormRequest $request)
    {
        $wallet_key = $this->getref_code();
       $user = User::create([
           'fname'=> $request['first_name'],
           'lname'=> $request['last_name'],
           'phone'=> $request['mobile_number'],
           'email'=> $request['email'],
           'password'=> Hash::make($request['password']),
       ]);

       $wallet = Wallet::create([
            'user_id'=> $user->id,
            'wallet_key'=> sha1(time()),
       ]);
       


       $verifyUser = VerifyUser::create([
        'user_id' => $user->id,
        'token' => sha1(time())
       ]);

       //$newuser = $request->only('first_name', 'last_name','email');
       $admin = DB::table('users')->where('role', 'admin')->value('email');

       if($admin != '') {
        //send admin a notification
        Mail::to($admin)->send(new notifyAdmin($user));
        }
       
        //send mail to user for verification of user
        Mail::to($user->email)->send(new VerifyMail($user));

        return redirect('/auth/login')->with('Account created successfully');
         
    }

    public function Update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->fname = $request['first_name'];
        $user->lname = $request['last_name'];
        $user->email = $request['email'];
        $user->phone = $request['mobile_number'];
        $user->state = $request['state'];
        $user->country = $request['country'];
        $user->address = $request['address'];

        $user->save();

        return redirect()->back()->with('status', 'Profile Updated Successfully');
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser)) {
            $user = $verifyUser->user;
            if(!$user->verified_email) {
                $verifyUser->user->verified_email = 1;
                $verifyUser->user->save();
                $status = "Your email is verified. You can now Login";                
            }else {
                $status = "Your e-mail is already verified. You can now Login";
            }

        }else {
            return redirect('/auth/login')->with('warning', 'Sorry your email cannot be identified.');
        }
        return redirect('/auth/login')->with('status', $status);

    }


    /* 
        *change the token

        *resend the token to the user mail
    */
    public function resendcode()
    {
        
        $user = Cache::get('user');
        $newtoken = sha1(time());
        $createToken = VerifyUser::where('user_id', $user->id)->first();
        $createToken->token = $newtoken;
        
        $createToken->save();

        Mail::to($user->email)->send(new VerifyMail($user));
        
        return redirect('/auth/login')->with('Email send');

        
    }

    public function resetPassword($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser)) {
            return redirect('/auth/resetform');
        }

        return redirect()->route('login');
    }


    /* 
        *collect the user email to reset link to

    */
    public function passwordRecovery(Request $request)
    {
        $this->validate($request, [
            'email'=> 'email|required'
        ]);
        
        
        $newtoken = sha1(time());
        $verifyUser = VerifyUser::create([
            'user_id' => 0,
            'token' => sha1(time())
           ]);
        

        Mail::to($request['email'])->send(new resetPassword($verifyUser));
        
        return redirect('/auth/login')->with('Email send');
        

    }

    public function changePassword(ResetPasswordrequest $request)
    {
        //dd($request->all());
        $email = $request['email'];
        $checkforemail = User::where('email', $email)->first();
        if(isset($checkforemail)) {
            $checkforemail->password = Hash::make($request['password']);
            $checkforemail->save();
            return redirect('/auth/login');
        }
        return redirect()->back()->with('danger', 'Email not Found');

    }

    public function Logout()
    {
        Cache::forget('user');
        Auth::logout();
        return redirect('/auth/login');
    }
}

