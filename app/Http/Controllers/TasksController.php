<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Task;

class TasksController extends Controller
{
    //
    public function getAllTasks(){
        $tasks = DB::table('tasks')->where('system_deleted','=','0')->get();

        return view('todo',['tasks'=>$tasks]);
    }

    public function saveTask(Request $request){
        $task = new Task();
        $task->name = $request['task'];
        $task->priority = $request['priority'];
        $task->status = '0';


        if($task->save()){
            return Response::json(['message'=>'Task Added','task'=>$task],200);
        }
        else{
            return Response::json(['message'=>'Error'],400);
        }

    }

    public function deleteTask(Request $req){
        $id = $req['id'];

        $task = Task::find($id);
        $task->system_deleted = 1;
        if($task->save()){
            return Response::json(['message'=>'Task Successfully Deleted'],200);
        }
        else{
            return Response::json(['message'=>'Task wasnt deleted'],400);
        }
    }

    public function editStatus(Request $req){
        $id = $req['id'];
        $task = Task::find($id);

        $task->status = 1;

        if($task->save()){
            return Response::json(['message'=>'Status of task edited successfully','task'=>$task],200);
        }
    }
}
