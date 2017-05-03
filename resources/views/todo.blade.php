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

        <div class="card-panel large" style="height:400px;">

            <div class="input-field col s3" style="margin-left:60px;">
                <input type="text" id="task" name="task" class="validate" placeholder="Add New Task">
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>

            <div class="input-field col s3" style="padding-left:20px;">
                <select name="priority" id="priority">
                    <option value="" disabled selected>Priority</option>
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
                </tr>
                </thead>

                <tbody>
                @foreach($tasks as $task)
                    <tr class="none-top-border">
                        <td>{{$task->name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>{{$task->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/todo.js')}}"></script>
@endsection