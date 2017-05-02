<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\PasswordReset;

class LoginController extends Controller
{

    public function getLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['username' => $request['username'], 'password' => $request['password']]))
        {
            return Response::json(['message'=>'Email or Password Incorrect'],400);
        }
        else{
            return Response::json(['message'=>'OK'],200);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function sendMailForPasswordReset(Request $request)
    {
        $email = $request['email'];
        $user = User::where('email','=',$email)->first();
      
        $id = $user->id;

        if($user ==null)
        {
            return Response::json(['message'=>'Error ! No User Registered with the provided E-Mail'],400);
        }

        $password_reset = new PasswordReset();
        $password_reset->password_code =  $this->generateRandomString(10);

        Mail::send('emails.password_reset',['password'=>$password_reset->password_code] , function ($message) use($user) {
            $message->to($user->email,$user->full_name);
            $message->subject("Asterisk Password Reset");
        });
        return Response::json(['message'=>'OK'],200);
    }
}
