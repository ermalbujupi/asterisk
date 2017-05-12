@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('src/css/stock.css')}}" type="text/css">
@endsection

@section('page')
    Categories & Brands
@endsection
@section('content')
 <div class="row">

     <div class="col s6 m6 lg6">

         <div class="card-panel large ">


             <div class="card-content">



                 <div class="left-align">
                         <a href="#addNewCategoryModal"  data-position="top"  data-tooltip="Add New Category" class="btn-floating btn-sm waves-effect waves-light blue tooltipped"><i class="material-icons">add</i></a>

                 </div>
                 <div class="col s12"><br></div>

                 <table id="category_table" border="1" class="responsive-table striped stock_table">

                     <thead>
                     <tr class="primary-color">
                         <th>ID</th>
                         <th>Category Name</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody id="category_table_body">
                     @foreach($categories as $category)
                         <tr class="none-top-border">
                             <td>{{$category->id}}</td>
                             <td>{{$category->name}}</td>
                             <td class="btn_info">
                                 <a id="{{$category->id}}" href="#editCategoryModal" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_category_trigger" data-tooltip="Edit Category" data-position="top"><span class="fa fa-pencil"></span></a>
                                 <a id="{{$category->id}}" href="#deleteCategoryModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_category_trigger" data-tooltip="Delete Category" data-position="top"><span class="fa fa-trash"></span></a>
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <div class="col s6 m6 lg6">

         <div class="card-panel large ">


             <div class="card-content">



                 <div class="left-align">
                     <a href="#addNewBrandModal"  data-position="top"  data-tooltip="Add New Brand" class="btn-floating btn-sm waves-effect waves-light blue tooltipped"><i class="material-icons">add</i></a>
                 </div>
                 <div class="col s12"><br></div>

                 <table id="brand_table" border="1" class="bordered responsive-table striped stock_table">

                     <thead>
                     <tr class="primary-color">
                         <th>ID</th>
                         <th>Brand Name</th>
                         <th>Info</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody id="brand_table_body">
                     @foreach($brands as $brand)
                         <tr class="none-top-border">
                             <td>{{$brand->id}}</td>
                             <td>{{$brand->name}}</td>
                             <td>{{$brand->info}}</td>
                             <td class="btn_info">
                                 <a id="{{$brand->id}}" href="#editBrandModal"  class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_brand_trigger" data-tooltip="Edit Brand" data-position="top"><span class="fa fa-pencil"></span></a>
                                 <a id="{{$brand->id}}" href="#deleteBrandModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_brand_trigger" data-tooltip="Delete Brand" data-position="top"><span class="fa fa-trash"></span></a>
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
    <!-- Add new Category -->
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
    <!--/Add New Category -->

    <!--Edit Category -->
     <div id="editCategoryModal" class="modal modal-md">
         <div class="modal-header blue">
             <h4 class="white-text">Edit Category</h4>
         </div>
         <div class="modal-content">
             <div class="row">
                 <div class="input-field col s6">
                     <input id="edit_category_name" type="text" class="validate" placeholder="">
                     <label for="first_name">Name</label>
                 </div>
             </div>
         </div>
         <div class="modal-footer">
             <a id="edit_category" class="modal-action  waves-effect waves-light btn">Save</a>
             <button  type="submit"  href="#!" class="modal-action  waves-effect waves-green btn ">Close</button>
         </div>
     </div>
    <!--/Edit Category -->

 <!--Delete Category Modal-->
 <div id="deleteCategoryModal" class="modal">
     <div class="modal-header blue">
         <h4 class="white-text">Delete Category</h4>
     </div>
     <div class="modal-content">
         <p>Are you sure you want to delete this category</p>
     </div>
     <div class="modal-footer">
         <a class="modal-action modal-close waves-effect waves-light btn">No</a>
         <button  type="submit" id="delete_category"  class="modal-action waves-effect waves-green btn "> Yes</button>
     </div>
 </div>

 <!--/Delete Category Modal-->

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
<!--/ Add New Brand Modal-->

<!--Edit Brand Modal-->
 <div id="editBrandModal" class="modal">
     <div class="modal-header blue">
         <h4 class="white-text">Edit Brand</h4>
     </div>
     <div class="modal-content">
         <div class="row">
             <div class="input-field col s6">
                 <input id="edit_brand_name" type="text" class="validate" placeholder="">
                 <label for="first_name">Name</label>
             </div>
             <div class="input-field col s12">
                 <textarea id="edit_brand_info" name="description" class="materialize-textarea" placeholder=""></textarea>
                 <label>Info</label>
             </div>
         </div>
     </div>
     <div class="modal-footer">
         <button  type="submit" id="edit_brand" class="modal-action waves-effect waves-green btn "> Save</button>
         <a class="modal-action modal-close waves-effect waves-light btn">Close</a>
     </div>
 </div>
<!--/Edit Brand Modal-->

<!--Delete Brand Modal-->
 <div id="deleteBrandModal" class="modal">
     <div class="modal-header blue">
         <h4 class="white-text">Delete Brand</h4>
     </div>
     <div class="modal-content">
         <p>Are you sure you want to delete this brand</p>
     </div>
     <div class="modal-footer">
         <a class="modal-action modal-close waves-effect waves-light btn">No</a>
         <button  type="submit" id="delete_brand"  class="modal-action  waves-effect waves-green btn">Yes</button>
     </div>
 </div>

<!--/Delete Brand Modal-->



@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('src/js/categoriesbrands.js')}}"></script>
@endsection
