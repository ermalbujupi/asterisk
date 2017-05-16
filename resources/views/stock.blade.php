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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr class="none-top-border">
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->brand}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
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


  <!-- Modal Structure -->

@endsection

@section('modals')
    <!--Add New Product -->
        <div id="addNewProductModal" class="modal modal-sm modal-fixed-footer">

            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-header blue">
                <h4 class="white-text">Add New Product</h4>
            </div>

            <div class="modal-content">

                <div class="col s12">

                    <div class="col s6">
                        <div class="col-md-9">
                            <select  name="category" id="category" class="browser-default">
                                <option value="0" disabled selected>Choose your Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col s2"><a href="#addNewCategoryModal"  data-position="top"  data-tooltip="Add New Category" class="btn-floating btn-sm waves-effect waves-light blue tooltipped"><i class="material-icons">add</i></a></div>
                    </div>

                    <div class="col s6">
                        <select name="brand" id="brand" class="browser-default col s9">
                            <option value="0" disabled selected>Choose your Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>

                        <div class="col s2"><a href="#addNewBrandModal"  data-position="top"  data-tooltip="Add New Brand" class="btn-floating btn-sm waves-effect waves-light blue tooltipped"><i class="material-icons">add</i></a></div>
                    </div>


                    <div class="col s12 ">
                        <br>
                      <div class="input-field col s12">
                        <input name="name"  id="name" type="text" class="validate" placeholder="">
                        <label for="first_name">Product Name</label>
                      </div>

                    <div class="input-field col s6">
                        <input id="price" name="price" type="number" step="any" class="validate" placeholder="">
                        <label for="last_name">Price</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="quantity" name="quantity" type="number" class="validate" placeholder="">
                        <label for="last_name">Quantity</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="imei" type="number" name="imei" minlength="16" maxlength="16"  placeholder="" data-length="16"   >
                        <label for="last_name">IMEI</label>
                    </div>
                    <div class="input-field col s12">
                      <textarea id="description" name="description" class="materialize-textarea" placeholder=""></textarea>
                      <label for="textarea1">Description</label>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal-footer">
                <button  type="submit" id="save_product" href="#!" class="modal-action waves-effect waves-green btn "> Save</button>
                  <a class="modal-action modal-close waves-effect waves-light btn">Cancel</a>
            </div>
        </div>




<!--/Add new Product Modal-->

<!--Edit Product Modal-->
<div id="editProductModal" class="modal modal-sm modal-fixed-footer">
  <div class="modal-header blue">
    <h4 class="white-text">Edit Product</h4>
  </div>
  <div class="modal-content">
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
                <input id="edit_imei" type="text" name="imei" class="validate">
                <label class="active" for="last_name">IMEI</label>
            </div>
            <div class="input-field col s12">
              <textarea id="edit_description" name="description" class="materialize-textarea" placeholder=""></textarea>
              <label for="textarea1">Description</label>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="submit" id="edit_product" href="#!" class="modal-action waves-effect waves-green btn "> Save</button>
        <a class="modal-action modal-close waves-effect waves-light btn">Cancel</a>
      </div>
    </div>
    </div>

<!--</form>-->

<!--Delete Product Modal-->
<div id="deleteProductModal" class="modal">
  <div class="modal-header blue">
    <h4 class="white-text">Delete Product</h4>
  </div>
  <div class="modal-content">
    <p>Are you sure you want to delete this product?</p>
  </div>
      <div class="modal-footer">
          <a class="modal-action modal-close waves-effect waves-light btn">No</a>
          <button  type="submit" id="delete_product" href="#!" class="modal-action modal-close waves-effect waves-green btn "> Yes</button>
      </div>
    </div>
  </div>
<!--/Delete Product Modal-->

<!-- Add New Category Modal -->
<div id="addNewCategoryModal" class="modal modal-md">
  <div class="modal-header blue">
    <h4 class="white-text">Add New Category</h4>
  </div>
  <div class="modal-content">
  <div class="row">
        <div class="input-field col s6">
          <input id="category_name" type="text" class="validate" placeholder="">
          <label for="first_name">Name</label>
        </div>
  </div>
  </div>
      <div class="modal-footer">
          <a id="save_category" class="modal-action  waves-effect waves-light btn">Save</a>
        <button  type="submit"  href="#!" class="modal-action modal-close waves-effect waves-green btn ">Close</button>
      </div>
</div>
<!--/Add New Category Modal -->

<!-- Add New Brand Modal -->
<div id="addNewBrandModal" class="modal">
  <div class="modal-header blue">
    <h4 class="white-text">Add New Brand</h4>
  </div>
  <div class="modal-content">
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
<!--/Add New Barnd Modal -->
<div id="sellProductModal" class="modal modal-sm modal-fixed-footer">
    <div class="modal-header blue">
        <h4 class="white-text">Sell Product</h4>
    </div>
    <div class="modal-content">
        <!--<form action="{{route('stock.save_product')}}" method="POST">-->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="row">
            <div class="col s6">
                <h6>Category</h6>
                <select disabled name="category" id="sell_category" class="browser-default">
                    <option value="0" disabled selected>Choose your Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col s6">
                <h6>Brand</h6>
                <select disabled name="brand" id="sell_brand" class="browser-default">
                    <option value="0" disabled selected>Choose your Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12"><br></div>
            <div class="col s12 ">
                <div class="input-field col s12">
                    <input name="edit_name" placeholder="" disabled  id="sell_name" type="text" class="validate">
                    <label class="active" for="first_name">Product Name</label>
                </div>


                <div class="input-field col s6">
                    <input id="sell_price" placeholder=""  name="price" type="number" >
                    <label class="active" for="last_name">Price</label>
                </div>
                <div class="input-field col s6">
                    <input id="sell_quantity" name="quantity" placeholder="" type="number" class="validate">
                    <label class="active" for="last_name">Quantity</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button  type="submit" id="sell_product" href="#!" class="modal-action waves-effect waves-green btn "> Save</button>
        <a class="modal-action modal-close waves-effect waves-light btn">Cancel</a>
    </div>
</div>


@endsection

@section('scripts')
  <script type="text/javascript" src="{{URL::asset('src/js/stock.js')}}"></script>

@endsection
