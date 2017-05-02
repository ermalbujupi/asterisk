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

        <div class="card-panel large">

            <div class="left-align col s6">
                <a href="#addNewTaskModal" data-position="top" data-tooltip="Add New Task" class="btn waves-effect waves-light">New Task</a>
            </div>
            <div class="col s2">

            </div>
        </div>
    </div>
@endsection

@section('modals')
    <!--Add New Task -->
    <div id="addNewTaskModal" class="modal ">

        <div class="modal-header blue">
            <h4 class="white-text">Add New Task</h4>
        </div>

        <div class="modal-content">

            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="" id="task_name" type="text" class="validate">
                            <label for="task_name">Name of Task</label>
                        </div>

                        <div class="input-field col s8">
                            <textarea id="description" class="materialize-textarea"></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="input-field col s6">
                            <select>
                                <option value="" disabled selected>Choose priority</option>
                                <option value="1">Low</option>
                                <option value="2">Normal</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                        <div class="col s6">
                            <br>
                        </div>
                        <input type="date" class="datepicker col s2" placeholder="Pick Date">

                        <div class="input-field col s12">
                            <input placeholder="" id="task_duration" type="text" class="validate">
                            <label for="task_name">Task Duration in Hours</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-footer">
            <button  type="submit" id="save_brand" class="modal-action waves-effect waves-green btn "> Save</button>
            <a class="modal-action modal-close waves-effect waves-light btn">Close</a>
        </div>


    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/todo.js')}}"></script>
@endsection