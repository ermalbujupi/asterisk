@extends('layouts.master')

@section('title')
    ASTERISK - To Do List
@endsection

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('src/css/stock.css')}}" type="text/css">
@endsection

@section('page')
    To Do List
@endsection

@section('content')
    <div class="row">

        <div class="card-panel large" style="height:auto;">

            <div class="input-field col s3" style="margin-left:60px;">
                <input type="text" id="task" name="task" class="validate" placeholder="Add New Task">
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>

            <div class="input-field col s3" style="padding-left:20px;">
                <select  id="priority">
                    <option value="0" disabled selected>Priority</option>
                    <option value="1">Low</option>
                    <option value="2">Normal</option>
                    <option value="3">High</option>
                </select>
            </div>

            <div class="input-field col s3" style="margin-left:20px;">
                <button type="submit" href="#!" id="save_task" class="btn waves-effect waves-light">Add Task</button>
            </div>

            <table border="1" class="highlight">
                <thead>
                <tr>
                    <th>Task</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th></th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tasks as $task)
                    <tr class="none-top-border">
                        <td>{{$task->name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>
                            @if(($task->status) === 0)
                                Active
                            @else
                                Done
                            @endif
                        </td>
                        <td class="status_buttons">
                            <input class="check_task" id="{{$task->id}}" <?= $task->status == 0?"unchecked":"checked" ?> type="checkbox" class="filled-in" >
                            <label for="{{$task->id}}"></label>

                        </td>
                        <td>
                            <a id="{{$task->id}}" href="#deleteTaskModal" class="btn btn-floating waves-effect waves-light red tooltipped action_button delete_task_trigger" data-tooltip="Delete Task" data-position="top"><span class="fa fa-trash"></span></a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')
    <!--Delete Task Modal -->
    <div id="deleteTaskModal" class="modal">
        <div class="modal-header blue">
            <h4 class="white-text">Delete Task</h4>
        </div>
        <div class="modal-content">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <p>Are you sure you want to delete this task?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-light btn">No</a>
            <button  type="submit" id="delete_task" href="#!" class="modal-action modal-close waves-effect waves-green btn "> Yes</button>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/todo.js')}}"></script>
@endsection