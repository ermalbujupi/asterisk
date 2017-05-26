@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
    <link href="{{ URL::asset('src/datepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('page')
    Sales
@endsection
@section('content')
    <div class="row">
        <div class="col s12 m12 ">

            <div class="card-panel large ">
                <div class="card-content">
                    <div class="form-group col s1" id="refresh_button">
                        <br>
                        <a class="btn-floating waves-effect light-blue darken-4 tooltipped" data-position="top" data-tooltip="Refresh Table">
                            <i class="large material-icons">loop</i>
                        </a>
                    </div>

                    <div class="input-field col s2">
                        <select id="user_select">
                            <option value="0" selected>All</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                        </select>
                        <label>User</label>
                    </div>

                    <div class="input-field col s2">
                        <select id="year_select">
                            <option  selected value="0">All</option><?php
                            $year = date("Y");
                            $year_temp= 2016;

                            while ($year_temp<=$year)
                            {
                                echo'<option value="'.$year_temp.'" >'.$year_temp.'</option>';
                                $year_temp++;
                            }
                            ?>
                        </select>
                        <label >Year:</label>
                    </div>

                    <div class="input-field col s2">
                        <select  id="month_select">
                            <option value="0" >All</option>
                            <option value="1" >January</option>
                            <option value="2" >February</option>
                            <option value="3" >March</option>
                            <option value="4" >April</option>
                            <option value="5" >May</option>
                            <option value="6" >June</option>
                            <option value="7" >July</option>
                            <option value="8" >August</option>
                            <option value="9" >September</option>
                            <option value="10" >October</option>
                            <option value="11" >November</option>
                            <option value="12" >December</option>
                        </select>
                        <label >Month:</label>
                    </div>

                    <div class="form-group col s3">
                        <label class = "control-label" for="name">Date:</label>
                        <input  type="date" id="date" value="<?= date('Y-m-d'); ?>"/>
                        <input type="hidden" id="delivery_time" value="">
                    </div>

                    <table id="sell_table" border="1" class="bordered striped stock_table">

                        <thead>
                        <tr class="primary-color">
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price Sold</th>
                            <th>Date Sold</th>
                        </tr>

                        </thead>
                        <tbody id="sales_tbody">
                        @foreach($sellings as $sell)
                            <tr>
                                <td>{{$sell->id}}</td>
                                <td>{{$sell->user}}</td>
                                <td>{{$sell->product}}</td>
                                <td>{{$sell->brand}} </td>
                                <td>{{$sell->category}}</td>
                                <td>{{$sell->quantity_sold}}</td>
                                <td >{{$sell->price_sold}} &euro;</td>
                                <td>{{$sell->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <div><br></div>
                    <div class="right-align">
                        <button id="export_pdf" class="waves-effect waves-light btn red darken-4 tooltipped" data-position="top" data-tooltip="Export to PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                        <button id="export_xls" class="waves-effect waves-light btn green darken-4 tooltipped" data-position="top" data-tooltip="Export to Excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                    </div>
             </div>
         </div>
     </div>
</div>
@endsection

@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/sales.js')}}"></script>
@endsection
