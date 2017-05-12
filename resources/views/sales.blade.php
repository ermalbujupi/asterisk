@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')

    <link rel="stylesheet" href="{{URL::asset('src/css/stock.css')}}" type="text/css">



@endsection

@section('page')
    Products
@endsection
@section('content')
    <div class="row">
        <div class="col s12 m12 lg12">

            <div class="card-panel large ">


                <div class="card-content">



                    <div class="left-align col s6">
                        <a href="#addNewProductModal"  data-position="top"  data-tooltip="Add New Product" class="btn-floating btn-sm waves-effect waves-light blue tooltipped"><i class="material-icons">add</i></a>
                    </div>
                    <div class="col s2">

                    </div>

                    <div class="right-align col s4" id="search">
                        <input type="text" class="col s12 "  id="name_search" placeholder="Search">
                    </div>



                    <table id="stock_table" border="1" class="bordered striped stock_table">

                        <thead>
                        <tr class="primary-color">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>IMEI</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellings as $product)
                            <tr class="none-top-border">
                                <td>{{$product->id}}</td>
                                <td>{{$product->product}}</td>
                                <td>{{$product->brand}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->price_sold}}</td>
                                <td>{{$product->quantity_sold}}</td>
                                <td>{{$product->description}}</td>
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
