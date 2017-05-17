@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')

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
                            <option value="1">All2</option>
                        </select>
                        <label>User</label>
                    </div>

                    <div class="input-field col s2">
                        <select id="year_select">
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
                        <label >Year:</label>
                    </div>

                    <div class="input-field col s2">
                        <select  id="month_select" disabled>
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
                        <label >Month:</label>
                    </div>

                    <div class="form-group col s3">
                        <label class = "control-label" for="name">Date:</label>
                        <input type="date" class="datepicker" >
                        <input type="hidden" id="delivery_time" value="">
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
    <script type="text/javascript" src="{{URL::asset('src/js/sales.js')}}"></script>
@endsection
