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




                    <div class="col s2">

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
