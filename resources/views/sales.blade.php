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
                                <td>{{$product->name}}</td>
                                <td>{{$product->brand}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->imei}}</td>

                                <td class="btn_info">
                                    <a id="{{$product->id}}" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>
                                    <a id="{{$product->id}}" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>
                                    <a id="{{$product->id}}" href="#sellProductModal" class="btn btn-floating tooltipped waves-effect waves-light green action_button tooltipped sell_product_trigger" data-tooltip="Sell Product" data-position="top"><span class="fa fa-shopping-cart" aria-hidden="true"></span></a>
                                </td>
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
