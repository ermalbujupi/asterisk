<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\PasswordReset;
use Illuminate\Support\Facades\Hash;

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

        try{
            if(!Auth::attempt(['username' => $request['username'], 'password' => $request['password']]))
            {
                return Response::json(['message'=>'Email or Password Incorrect'],400);
            }
            else{
                return Response::json(['message'=>'OK'],200);
            }

        }catch(\Exception $exe){
            return Response::json(['message'=>'Couldn\'t establish connection to database'],400);
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

        if($user == null)
        {
            return Response::json(['message'=>'Error ! No User Registered with the provided E-Mail'],400);
        }
        else{
            $random_password = $this->generateRandomString(10);
            $id = $user->id;

            $user = User::find($id);


            Mail::send('emails.password_reset',['password'=>$random_password] , function ($message) use($user) {
                $message->to($user->email,$user->full_name);
                $message->subject("Asterisk Password Reset");});

                return Response::json(['message'=>'Email with generated password has been sent'],200);

        }

        $user->password = bcrypt($random_password);
        $user->save();
        return Response::json(['message'=>'Something went wrong, Please try again !'],400);
    }


    public function changePassword(Request $req){
        $actual_password = $req['actual_password'];
        $new_password = bcrypt($req['password']);

        $user = User::find(Auth::user()->id);


        if(!Hash::check($actual_password,$user->password)){
            return Response::json(['message'=>'Password incorrect'],400);

        }else{
            $user->password = $new_password;
            if($user->save()) {
                return Response::json(['message' => 'Password Changed Successfully'], 200);
            }
        }

    }



}
