<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
