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
                    <div class="left-align">
                        <div  class="col s2" style="padding-left: 0;: ">
                            <a href="#addNewProductModal"  data-position="top"  data-tooltip="Add New Product" class="btn-floating btn-sm waves-effect waves-light light-blue darken-4 tooltipped"><i class="material-icons">add</i></a>
                        </div>
                        <div class="col s7 push-s8">
                            <a href="#sellProductModal" style="display: none;" id="sell" class="waves-effect waves-light btn light-blue darken-4 ">Sell</a>
                        </div>

                    </div>

                    <div class="col s12">
                        <br>
                    </div>

                    <div class="col s1 " id="refresh_button">
                        <a class="btn-floating waves-effect light-blue darken-4 tooltipped" data-position="top" data-tooltip="Refresh Table">
                            <i class="large material-icons">loop</i>
                        </a>
                    </div>
                    <div class="input-field right-align col s3" id="category_search">
                        <select>
                            <option value="0" selected>All</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-field right-align col s3" id="brand_search">
                        <select>
                            <option value="0" selected>All</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="right-align col s4" id="search">
                        <input type="text" class="col s12 "  id="name_search" placeholder="Search for a product">
                    </div>

                    <table id="start" border="1" class="bordered  ">

                        <thead>
                        <tr class="primary-color">
                            <th>
                                @foreach($products as $product)
                                    <h5>Produktet per kategorine {{$product->category}} jane {{$product->nr}}</h5>
                                @endforeach
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="none-top-border">

                        </tr>
                        </tbody>
                    </table>

                    <table style="display: none;" id="stock_table" border="1" class="bordered  stock_table">

                        <thead>
                        <tr class="primary-color">
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Selling Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="stock_body">
                            <tr class="none-top-border">

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->

    @endsection

    @section('modals')
            <!--Add New Product -->
    <div id="addNewProductModal" class="modal">

        <div class="modal-content">
            <h4>Add New Product</h4>
            <!--<form action="{{route('stock.save_product')}}" method="POST">-->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="row">
                <div class="col s6">
                    <div class="col s12">
                        <h6>Category</h6>
                    </div>
                    <div class="col s10">
                        <select name="category" id="category" class="browser-default">
                            <option value="0" disabled selected>Choose your Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s2" style="padding-left: 0">
                        <a href="#addNewCategoryModal"  data-position="top"  data-tooltip="Add New Brand" class="btn-floating btn-sm waves-effect waves-light light-blue darken-4 tooltipped"><i class="material-icons">add</i></a>
                    </div>

                </div>

                <div class="col s6">
                    <div class="col s12">
                        <h6>Brand</h6>
                    </div>
                    <div class="col s10">
                        <select name="brand" id="brand" class="browser-default">
                            <option value="0" disabled selected>Choose your Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s2" style="padding-left: 0">
                        <a href="#addNewBrandModal"  data-position="top"  data-tooltip="Add New Brand" class="btn-floating btn-sm waves-effect waves-light light-blue darken-4 tooltipped"><i class="material-icons">add</i></a>
                    </div>

                </div>
                <div class="col s12"><br></div>
                <div class="col s12 ">
                    <div class="input-field col s12">
                        <input name="edit_name" placeholder=""  id="name" type="text" class="validate">
                        <label class="active" for="first_name">Product Name</label>
                    </div>


                    <div class="input-field col s6">
                        <input placeholder="" id="price" name="price" type="number" >
                        <label class="active" for="last_name">Price</label>
                    </div>

                    <div class="input-field col s6">
                        <input placeholder="" id="sell_price" name="price_sell" type="number">
                        <label class="active" for="price_sell">Selling Price</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="quantity" placeholder="" name="quantity" type="number" class="validate">
                        <label class="active" for="last_name">Quantity</label>
                    </div>

                    <div class="input-field col s12">
                        <textarea id="description" name="description"  class="materialize-textarea" placeholder=""></textarea>
                        <label for="textarea1">Description</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button  type="submit" id="save_product" href="#!" class="modal-action waves-effect light-blue darken-4 btn "> Save</button>
            <a class="modal-action modal-close waves-effect red darken-4 btn">Cancel</a>
        </div>
    </div>






    <!--/Add new Product Modal-->

    <!--Edit Product Modal-->
    <div id="editProductModal" class="modal modal-sm modal-fixed-footer">
        <div class="modal-content">
            <h4>Edit Product</h4>
            <!--<form action="{{route('stock.save_product')}}" method="POST">-->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="row">
                <div class="col s6">
                    <h6>Category</h6>
                    <select name="category" id="edit_category" class="browser-default">
                        <option value="0" disabled selected>Choose your Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col s6">
                    <h6>Brand</h6>
                    <select name="brand" id="edit_brand" class="browser-default">
                        <option value="0" disabled selected>Choose your Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col s12"><br></div>
                <div class="col s12 ">
                    <div class="input-field col s12">
                        <input name="edit_name"  id="edit_name" type="text" class="validate">
                        <label class="active" for="first_name">Product Name</label>
                    </div>


                    <div class="input-field col s6">
                        <input id="edit_price" name="price" type="number" >
                        <label class="active" for="last_name">Price</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="edit_quantity" name="quantity" type="number" class="validate">
                        <label class="active" for="last_name">Quantity</label>
                    </div>

                    <div class="input-field col s12">
                        <textarea id="edit_description" name="description" class="materialize-textarea" placeholder=""></textarea>
                        <label for="textarea1">Description</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect red darken-4 btn">Cancel</a>
            <button  type="submit" id="edit_product" href="#!" class="modal-action waves-effect light-blue darken-4 btn "> Save</button>
        </div>
    </div>


    <!--</form>-->

    <!--Delete Product Modal-->
    <div id="deleteProductModal" class="modal">

        <div class="modal-content">
            <h4>Delete Product</h4>
            <p>Are you sure you want to delete this product?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect red darken-4 btn">No</a>
            <button  type="submit" id="delete_product" href="#!" class="modal-action modal-close waves-effect light-blue darken-4 btn "> Yes</button>
        </div>
    </div>
    </div>
    <!--/Delete Product Modal-->

    <!-- Add New Category Modal -->
    <div id="addNewCategoryModal" class="modal modal-md">

        <div class="modal-content">
            <h4>Add New Category</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input id="category_name" type="text" class="validate" placeholder="">
                    <label for="first_name">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="save_category" class="modal-action  waves-effect light-blue darken-4 btn">Save</a>
            <button  type="submit"  href="#!" class="modal-action modal-close waves-effect red darken-4 btn ">Close</button>
        </div>
    </div>
    <!--/Add New Category Modal -->

    <!-- Add New Brand Modal -->
    <div id="addNewBrandModal" class="modal">

        <div class="modal-content">
            <h4>Sell Product</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input id="brand_name" type="text" class="validate" placeholder="">
                    <label for="first_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="brand_info" name="description" class="materialize-textarea" placeholder=""></textarea>
                    <label>Info</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button  type="submit" id="save_brand" class="modal-action waves-effect waves-green btn "> Save</button>
            <a class="modal-action modal-close waves-effect waves-light btn">Close</a>
        </div>
    </div>

    <!--/Sell Product Modal -->
    <div id="sellProductModal" class="modal modal-sm modal-fixed-footer">

        <div class="modal-content">
            <h4>Sell Products</h4>
            <div class="col s12"><br></div>
            <div class="row">

                <div class="card-panel large">
                    <div class="col s4">
                        <input type="text"   id="product_search" placeholder="Search for a product">
                    </div>
                    <div class="col s2">
                        <input type="text"   id="price" placeholder="Price">
                    </div>
                    <div class="col s2">
                        <input type="text"   id="price" placeholder="Quantity">
                    </div>
                    <h1>
                    </h1>
                </div>
                <div class="col s12">
                    <textarea id="sales_array" hidden></textarea>
                    <div class="right-align">
                        <h6><b>TOTAL VALUE:</b><span id="total"></span>&euro;</h6>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <a id="close_sell" class="modal-action modal-close waves-effect red darken-4 btn">Cancel</a>
            <button  type="submit" id="sell_product" href="#!" class="modal-action waves-effect light-blue darken-4 btn ">Sell</button>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/stock.js')}}"></script>

@endsection
