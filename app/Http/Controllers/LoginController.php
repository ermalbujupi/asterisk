<?php

namespace App\Http\Controllers;

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
            return redirect()->back()->with(['fail' => 'Error']);
        }
        else{
            return redirect()->route('index');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
