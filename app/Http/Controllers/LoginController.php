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




    public function sendMailForPasswordReset(Request $request)
    {
        $email = $request['email'];
        $token = $request['token'];
        $user =  null;
        try{
            $user = User::where('email','=',$email)->first();
        }catch(\Exception $exe){
            return Response::json(['message'=>'Couldn\'t establish connection to database'],400);
        }


        if($user == null)
        {
            return Response::json(['message'=>'Error ! No User Registered with the provided E-Mail'],400);
        }
        else{
            $id = $user->id;


            try{
                $reset = new PasswordReset();
                $reset->user = $id;
                $reset->token = $token;
                $reset->save();

                Mail::send('emails.password_reset',['token'=> $token] , function ($message) use($user) {
                    $message->to($user->email,$user->full_name);
                    $message->subject("Asterisk Password Reset");
                });

            }catch(\Exception $exe){
                return Response::json(['message'=>$exe->getMessage()],400);
            }
            return Response::json(['message'=>'A link has been send to your email for reseting the password'],200);
        }



        return Response::json(['message'=>'Something went wrong, Please try again !'],400);
    }

    public function showResetForm($token =  null){
        if(!isset($token)){
            return redirect('login');
        }

        $reset = PasswordReset::where('token','=',$token)->first();

        if($reset !=  null){
            return view('password_reset',['user_id'=>$reset->user]);
        }else{
            return redirect('login');
        }


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

    public function changePasswordReset(Request $req){
        $password = $req['password'];
        $id = $req['user'];

        $user = User::find($id);
        $user->password = bcrypt($password);

        if($user->save()){
            $reset  = PasswordReset::where('user','=',$id)->first();
            $reset->delete();
            return Response::json(['message'=>'Pasword Reseted Successfully'],200);

        }else{
            return Request::json(['message'=>'Failed Reseting Password'],400);
        }
    }



}
