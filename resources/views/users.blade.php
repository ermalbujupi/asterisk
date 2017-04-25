@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
  <link rel="stylesheet" href="{{URL::asset('src/css/stock.css')}}" type="text/css">
@endsection

@section('page')
    Users
@endsection

@section('content')
<div class="row">
    <div class="col s12 m12 lg12">

    <div class="card-panel large ">


    <div class="card-content">
      <div class="right-align">
          <a class="waves-effect waves-light btn" href="#addNewUserModal">Add New User</a>
      </div>
        <table border="1" class="responsive-table striped users_table">

            <thead>
            <tr class="primary-color">
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr class="none-top-border">
                <td>{{$user->id}}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <a id="{{$user->id}}"   href="#editUserModal"   class="btn btn-floating blue tooltipped edit_user_trigger action_button" data-position="top" data-delay="50" data-tooltip="Edit User"><span class="fa fa-pencil"></span></a></li>
                    <a id="{{$user->id}}"  href="#deleteProductModal" class="btn btn-floating red tooltipped delete_user_trigger action_button" data-position="top" data-delay="50" data-tooltip="Delete User"><span class="fa fa-trash-o"></span></a></li>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection

@section('modals')
<!--Add New User Modal -->
<div id="addNewUserModal" class="modal modal-sm modal-fixed-footer">
  <div class="modal-content">
    <h4>Add New User</h4>
    <!--<form action="{{route('stock.save_product')}}" method="POST">-->
    <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->
        <div class="col s12">
            <div class="col s12 ">
              <div class="input-field col s12">
                <input  id="fullName" type="text" class="validate">
                <label for="first_name">Full Name</label>
              </div>


            <div class="input-field col s6">
                <input id="username" type="text" class="validate">
                <label for="last_name">Username</label>
            </div>
            <div class="input-field col s6">
                <input id="password"  type="password" class="validate">
                <label for="last_name">Password</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="text" class="validate">
                <label for="last_name">Email</label>
            </div>
            <div class="input-field col s6">
              <select name="privilege" id="privilege" class="browser-default">
                <option value="0" disabled selected>Choose Role</option>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Employee</option>
              </select>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="submit" id="save_user" href="#!" class="modal-action waves-effect waves-green btn "><i class="fa fa-check right"></i> Save</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>Cancel</a>
      </div>
    </div>
    </div>

<!--</form>-->
</div>
</div>
<!--/Add New User Modal-->

<!--Edit User Modal -->
<div id="editUserModal" class="modal modal-sm modal-fixed-footer">
  <div class="modal-content">
    <h4>Edit User</h4>
    <!--<form action="{{route('stock.save_product')}}" method="POST">-->
    <!--<meta name="csrf-token" content="{{ csrf_token() }}">-->
        <div class="row">
            <div class="col s12 ">
              <div class="input-field col s12">
                <input  id="edit_FullName" type="text" class="validate">
                <label class="active" for="first_name">Full Name</label>
              </div>


            <div class="input-field col s6">
                <input id="edit_username" type="text" class="validate">
                <label class="active" for="last_name">Username</label>
            </div>
            <div class="input-field col s12">
                <input id="edit_email" type="text" class="validate">
                <label class="active" for="last_name">Email</label>
            </div>
            <div class="input-field col s6">
              <select  id="edit_privilege" class="browser-default">
                <option value="0" disabled selected>Choose Role</option>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Employee</option>
              </select>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="submit" id="edit_user" href="#!" class="modal-action waves-effect waves-green btn "><i class="fa fa-check right"></i> Save</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>Cancel</a>
      </div>
    </div>
    </div>

<!--</form>-->
</div>
</div>
<!--/Edit  User Modal-->

<!-- Delete User Modal -->
<div id="deleteProductModal" class="modal">
  <div class="modal-content">
    <h4>Delete User</h4>

    <p>Are you sure you want to delete this user</p>
  </div>
      <div class="modal-footer">
        <button  type="submit" id="delete_user" href="#!" class="modal-action modal-close waves-effect waves-green btn "><i class="fa fa-check right"></i> Yes</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>No</a>
      </div>
    </div>
  </div>
  <!-- /Delet user modal-->

@endsection

@section('scripts')
  <script type="text/javascript" src="{{URL::asset('src/js/users.js')}}"></script>
@endsection
