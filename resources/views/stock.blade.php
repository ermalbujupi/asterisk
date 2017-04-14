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
          <div class="right-align">
              <a class="waves-effect waves-light btn" href="#addNewProductModal">Add New Product</a>
          </div>
            <table border="1" class="responsive-table striped ">

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
                @foreach($products as $product)
                <tr class="none-top-border">
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->brand}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->imei}}</td>
                    <td>
                        <div class="fixed-action-btn horizontal">
                            <a id="action" class="btn-floating btn-small teal">
                                <i class="fa fa-bars"></i>
                            </a>
                            <ul>
                                <li><a id="{{$product->id}}"   href="#editProductModal"  data-target="modal1" class="btn-floating tooltipped edit_product_trigger" data-position="top" data-delay="50" data-tooltip="Edit Product"><i class="fa fa-pencil"></i></a></li>
                                <!--<li><a id="" class="btn-floating yellow darken-1 tooltipped" data-position="top" data-delay="50" data-tooltip="Sell Product"><i class="fa fa-dollar"></i></a></li>-->
                                <li><a id="{{$product->id}}"  href="#deleteProductModal" class="btn-floating red tooltipped delete_product_trigger" data-position="top" data-delay="50" data-tooltip="Delete Product"><i class="fa fa-trash-o"></i></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>
        </div>


  <!-- Modal Structure -->

@endsection

@section('modals')
<!--Add New Product -->
<div id="addNewProductModal" class="modal modal-sm modal-fixed-footer">
  <div class="modal-content">
    <h4>Add New Product</h4>
    <!--<form action="{{route('stock.save_product')}}" method="POST">-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="input-field col s6">
          <select name="category" id="category" class="browser-default">
            <option value="0" disabled selected>Choose your Category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field col s6">
          <select name="brand" id="brand" class="browser-default">
            <option value="0" disabled selected>Choose your Brand</option>
            @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col s12">
            <div class="col s12 ">
              <div class="input-field col s12">
                <input name="name"  id="name" type="text" class="validate">
                <label for="first_name">Product Name</label>
              </div>


            <div class="input-field col s6">
                <input id="price" name="price" type="number" class="validate">
                <label for="last_name">Price</label>
            </div>
            <div class="input-field col s6">
                <input id="quantity" name="quantity" type="number" class="validate">
                <label for="last_name">Quantity</label>
            </div>
            <div class="input-field col s12">
                <input id="imei" type="text" name="imei" class="validate">
                <label for="last_name">IMEI</label>
            </div>
            <div class="input-field col s12">
              <textarea id="description" name="description" class="materialize-textarea"></textarea>
              <label for="textarea1">Description</label>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="submit" id="save_product" href="#!" class="modal-action waves-effect waves-green btn "><i class="fa fa-check right"></i> Save</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>Cancel</a>
      </div>
    </div>
    </div>

<!--</form>-->
</div>
</div>
<!--/Add new Product Modal-->

<!--Edit Product Modal-->
<div id="editProductModal" class="modal modal-sm modal-fixed-footer">
  <div class="modal-content">
    <h4>Edit Product</h4>
    <!--<form action="{{route('stock.save_product')}}" method="POST">-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="input-field col s6">
          <select name="edit_category" id="edit_category" class="browser-default">
            <option value="0" disabled selected>Choose your Category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field col s6">
          <select name="brand" id="edit_brand" class="browser-default">
            <option value="0" disabled selected>Choose your Brand</option>
            @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="row">
            <div class="col s12 ">
              <div class="input-field col s12">
                <input name="edit_name"  id="edit_name" type="text" class="validate">
                <label class="active" for="first_name">Product Name</label>
              </div>


            <div class="input-field col s6">
                <input id="edit_price" name="price" type="number" class="validate">
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
              <textarea id="edit_description" name="description" class="materialize-textarea"></textarea>
              <label class="active" for="textarea1">Description</label>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="submit" id="edit_product" href="#!" class="modal-action waves-effect waves-green btn "><i class="fa fa-check right"></i> Save</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>Cancel</a>
      </div>
    </div>
    </div>

<!--</form>-->
</div>
</div>
<!--Delete Product Modal-->
<div id="deleteProductModal" class="modal">
  <div class="modal-content">
    <h4>Delete Product</h4>

    <p>Are you sure you want to delete this product</p>
  </div>
      <div class="modal-footer">
        <button  type="submit" id="delete_product" href="#!" class="modal-action modal-close waves-effect waves-green btn "><i class="fa fa-check right"></i> Yes</button>
          <a class="modal-action modal-close waves-effect waves-light btn"><i class="fa fa-ban right"></i>No</a>
      </div>
    </div>
  </div>
<!--Delete Product Modal-->

<!--/Delete Product Modal-->
@endsection

@section('scripts')
  <script type="text/javascript">

  </script>
  <script type="text/javascript" src="{{URL::asset('src/js/stock.js')}}"></script>
@endsection
