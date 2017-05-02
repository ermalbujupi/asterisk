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
                <input type="text" id="add_new_task" class="validate" placeholder="Add New Task">
            </div>

            <div class="input-field col s3" style="padding-left:20px;">
                <select>
                    <option value="" disabled selected>Priority</option>
                    <option value="1">Low</option>
                    <option value="2">Normal</option>
                    <option value="3">High</option>
                </select>
            </div>

            <div class="input-field col s3" style="margin-left:20px;">
                <a class="btn waves-effect waves-light">Add Task</a>
            </div>

            <table border="1" class="highlight">
                <thead>
                <tr class="responsive">
                    <th>Task</th>
                    <th>Priority</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>Alvin</td>
                    <td>Eclair</td>
                    <td>$0.87</td>
                </tr>
                <tr>
                    <td>Alan</td>
                    <td>Jellybean</td>
                    <td>$3.76</td>
                </tr>
                <tr>
                    <td>Jonathan</td>
                    <td>Lollipop</td>
                    <td>$7.00</td>
                </tr>
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