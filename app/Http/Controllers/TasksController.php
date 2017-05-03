<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Requests;
use App\Task;

class TasksController extends Controller
{
    //
    public function getAllTasks(){
        $tasks = DB::table('tasks')->get();

        return view('todo',['tasks'=>$tasks]);
    }

    public function saveTask(Request $request){
       // $task = new Task();
        return Response::json('awd',200);

        if($task->save()){
            return Response::json(['message'=>'Task Added','task'=>$task],200);
        }
        else{
            return Response::json(['message'=>'Error'],400);
        }

    }
}
