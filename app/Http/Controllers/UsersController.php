<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers(){
      $users = DB::table('users')
      ->join('roles','roles.id','=','users.role')
      ->where('system_deleted','=','0')
      ->select('users.*','roles.name as role_name')
      ->get();

      $roles = Role::all();

        return view('users',['users'=>$users,'roles'=>$roles]);
    }

    public function getUser(Request $req){
       $id = $req['id'];
       $user = User::find($id);
       return Response::json(['message' => $user]);
   }

    public function saveUser(Request $request){

      $user = new User();
      $user->full_name = $request['full_name'];
      $temp = User::where('username','=',$request['username'])->first();
      if($temp == null)
      $user->username = $request['username'];
      else return Response::json(['message'=>'Username Already Taken ! Please Choose Another One'],400);
      $temp = User::where('email', $request['email'])->first();
      if($temp == null)
      $user->email = $request['email'];
      else return Response::json(['message'=>'E-mail Already Taken ! Please Choose Another One'],400);
      $user->password =bcrypt( $request['password']);
      $user->role = $request['privilege'];
      $user->system_deleted = "0";
      if($user->save()){

          return Response::json(['message' =>'User Added Successfully'],200);
      }else{
          return Response::json(['message'=>'Error Adding User'],400);
      }
  }

  public function editUser(Request $req){
        $id = $req['id'];
        $user = User::find($id);
        $user->full_name = $req['full_name'];
        $user->username = $req['username'];
        $user->email = $req['email'];
        $user->role = $req['privilege'];
        if($user->save()){
            return Response::json(['message' =>'User Edited Successfully'],200);
        }else{
            return Response::json(['message'=>'Error Editing User'],400);
        }
    }

    public function deleteUser(Request $req){
        $id = $req['id'];
        $user = User::find($id);
        $user->system_deleted = 1;
        if($user->save()){
            return Response::json(['message' =>'User Deleted Successfully'],200);
        }else{
            return Response::json(['message'=>'Error Deleting User'],400);
        }
    }

    public function getDateOfCreatedUsers(){

        $created = DB::table('users')->pluck('created_at');

        foreach($created as $date){
            
        }

        return Response::json(['dates'=>$created],200);
    }

    public function getCountByDate($year,$month){

        $count = DB::table('users')
            ->whereYear('users.created_at','=',$year)
            ->whereMonth('users.created_at','=',$month)
            ->count();

        return Response::json(['count'=>$count],200);
    }


}
