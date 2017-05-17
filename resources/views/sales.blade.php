@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')

    <link rel="stylesheet" href="{{URL::asset('src/css/stock.css')}}" type="text/css">



@endsection

@section('page')
    Sales
@endsection
@section('content')
    <div class="row">
        <div class="col s12 m12 lg12">

            <div class="card-panel large ">


                <div class="card-content">
                    <div class="col s1">
                        <br>
                        <span id="refresh"><i class="fa  fa-lg fa-refresh"  title="Reload" style="color:#286090;cursor: pointer"></i></span>
                    </div>
                    <!--
                       <div class="col-md-1">
                       </div>-->
                    <div class="form-group col s2">
                        <label class="control-label">User:</label>
                        <select class="form-control input-sm" id="user_select">
                            <option value="0" selected>All</option>
                           </select>
                    </div>
                    <div class="form-group col s2">
                        <label class="control-label">Year:</label>
                        <select class="form-control input-sm" id="year_select">
                            <option disabled selected value="0">All</option><?php
                            $year = date("Y");
                            $year_temp= 2016;
                            while ($year_temp<=$year)
                            {
                                echo'<option value="'.$year_temp.'" >'.$year_temp.'</option>';
                                $year_temp++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col s2">
                        <label class="control-label">Month:</label>
                        <select class="form-control input-sm" id="month_select" disabled>
                            <option value="0" disabled selected>All</option>
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
                    </div>
                    <div class="form-group col s3">
                        <div class="">
                            <label class = "control-label" for="name">Date:</label>
                            <div class="input-group date form_datetime col-md-12"  data-date="{{ date("Y-m-d")}}" data-date-format="dd/mm/yyyy" data-link-field="delivery_time">
                                <input class="form-control input-sm" size=""  type="text" value="" readonly id="date_select">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="delivery_time" value="" /><br/>
                        </div>
                    </div>

                    <table id="stock_table" border="1" class="bordered striped stock_table">

                        <thead>
                        <tr class="primary-color">
                            <th>User</th>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date Sold</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($sellings as $sell)
                            <tr>
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
             </div>
         </div>
     </div>
</div>
@endsection

@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/stock.js')}}"></script>

@endsection
