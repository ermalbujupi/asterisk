$(function(){
  //Shtimi i produktion me onclick dhe validimi i fushave
   $('#save_product').on('click',function(){
      saveProduct();
   });

   $('tbody').on('click','.edit_product_trigger',function(){
     var id = $(this).attr('id');
     ajax("POST","/stock/get_product","product_id="+id,fillEditModal,"");
     $('#edit_product').val(id);
   });

    //Edit Product
   $('#edit_product').on('click',function(){
      var id = $(this).val();
      editProduct(id);
   });

    //Give id to the submit button
   $('tbody').on('click','.delete_product_trigger',function(){
     var id = $(this).attr('id');
     $('#delete_product').val(id);
   });
    //Delete Product
   $('#delete_product').on('click',function(){
     ajax("POST","/stock/delete_product","id="+this.value,productDeleted,"");
     $('#deleteProductModal').hide();
   });

    $('select').material_select();


    //Kody yt ermal
    $('#imei').on('keydown',function(event){
      if($(this).val().length>=16){
          if(event.keyCode !=8)
           event.preventDefault();
      }
   });

   $('#edit_imei').on('keydown',function(event){
       if($(this).val().length>=16){
           if(event.keyCode !=8 || event.keyCode != 9)
               event.preventDefault();
       }
   });

   $('#name_search').on('keyup',function(){

       var word  = $(this).val();

       if(word.trim() === ""){
            ajax("GET","/stock/get_all_products",productSearched,"")
       }

       ajax("POST","/stock/search_word","word="+word,productSearched,"")
   });



    $('#category').on('change',function(){
       if($('#category option:selected').val() == 1 || $('#category option:selected').val() == 2) {
           $('#quantity').prop('disabled',true);
           $('#quantity').val(1);
       }
        else{
           $('#quantity').prop('disabled',false);
           $('#quantity').val('');
           $('#imei').prop('disabled',true);
       }
    });

    $('#edit_category').on('change',function(){
        if($('#edit_category option:selected').val() == 1 || $('#edit_category option:selected').val() == 2) {
            $('#edit_quantity').prop('disabled',true);
            $('#edit_quantity').val(1);
        }
        else{
            $('#edit_quantity').prop('disabled',false);
            $('#edit_quantity').val('');
            $('#edit_imei').prop('disabled',true);
        }
    });
   //--Kody yt ermal

   //Shtimi i brand-it
   $('#save_brand').on('click',function(){

      var name = $('#brand_name').val();
      var info = $('#brand_info').val();

      if(name == ""){
        Materialize.toast('Please write brand name',3000,'red');
        return false;
      }

         ajax("POST","/stock/add_brand","name="+name+'&info='+info,brandAdded,"");
   });

   $('#save_category').on('click',function(){

      var name = $('#category_name').val();

      if(name == ""){
        Materialize.toast('Please write brand name',3000,'red');
        return false;
      }

         ajax("POST","/stock/add_category","name="+name,categoryAdded,"");
   });

    // Sell trigger
   $('tbody').on('click','.sell_product_trigger',function(){

       var id = $(this).attr('id');
       $('#sell_product').val(id);

       ajax("POST","/stock/get_product","product_id="+id,fillSellModal,"");
   });

   //Sell Product
    $('#sell_product').on('click',function(){
        var id = $(this).val();
        sellProduct(id);
    });


    //Search By Category

    $('#category_search').on('change',function(){
        var brandName = '';
        var categoryName =  $('#category_search option:selected').text();
        if($('#brand_search option:selected').val() != 0){
            brandName = $('#brand_search option:selected').text();
        }

        $('#loading_modal').modal('open');
        ajax("POST","/stock/search_category_brand","category="+categoryName+'&brand='+brandName,searchResultByCategoryOrBrand,'');
    });

    //Search By Brand
    $('#brand_search').on('change',function(){
        var categoryName = '';
        var brandName = $('#brand_search option:selected').text();
        if($('#category_search option:selected').val() != 0){
            categoryName = $('#category_search option:selected').text();
        }
        $('#loading_modal').modal('open');
        ajax("POST","/stock/search_category_brand","category="+categoryName+'&brand='+brandName,searchResultByCategoryOrBrand,'');
    });



});

function searchResultByCategoryOrBrand(params,success,responseObj){
    if(success){

        var products = responseObj.products;
        $('tbody tr').remove();
        for(var i =0 ; i< products.length ; i++){

            $('tbody').append(
                '<tr class="none-top-border">'
                +'<td>'+products[i].id+'</td>'
                +'<td>'+products[i].name+'</td>'
                +'<td>'+products[i].brand+'</td>'
                +'<td>'+products[i].category+'</td>'
                +'<td>'+products[i].price+'</td>'
                +'<td>'+products[i].quantity+'</td>'
                +'<td>'
                +'<a id="'+products[i].id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
                +'<a id="'+products[i].id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'
                +'</td>'
                +'</tr>');
        }
        $('#loading_modal').modal('close');
    }
}

function sellProduct(id){

   var category = $('#sell_category').val();
   var brand =  $('#sell_brand').val();
   var name = $('#sell_name').val();
   var price =  $('#sell_price').val();
   var quantity = $('#sell_quantity').val();

   if(price === ""){
       Materialize.toast('Please Write Price',3000,'red');
       return false;
   }

   if(quantity ===""){
       Materialize.toast("Please Write Quantity",3000,'red');
       return false;
   }

   ajax("POST","/stock/sell_product","id="+id+"&price="+price+"&quantity="+quantity,productSold,"");



}

function productSold(params,success,responseObj){

    var message = responseObj.message;

    if(success){
        Materialize.toast(message,3000,'green');
    }else{
        Materialize.toast(message,3000,'red');
    }
}

function fillSellModal(params,success,responseObj){

    if(success){

        var product = responseObj.product;

        $('#sell_category').val(product.category_id);
        $('#sell_brand').val(product.brand_id);
        $('#sell_name').val(product.name);
        $('#sell_price').val(product.price);
        $('#sell_quantity').val(product.quantity);

        if($('#sell_category option:selected').val() == 1 || $('#sell_category option:selected').val() == 2) {
             $('#sell_quantity').prop('disabled',true);
             $('#sell_quantity').val(1);
        }
        else{
             $('#sell_quantity').prop('disabled',false);
             $('#sell_quantity').val(product.quantity);
        }



        Materialize.updateTextFields();
    }
}

function categoryAdded(params,success,responseObj){

  if(success){
    var category = responseObj.category;

    $('#category').append('<option id="'+category.id+'">'+category.name+'</option>');
    Materialize.toast(responseObj.message,3000,'green');

  }else{
    Materialize.toast(responseObj.message,3000,'red');
  }
}


function brandAdded(params,success,responseObj){

  if(success){
    var brand = responseObj.brand;

    $('#brand').append('<option id="'+brand.id+'">'+brand.name+'</option>');
    Materialize.toast(responseObj.message,3000,'green');

  }else{
    Materialize.toast(responseObj.message,3000,'red');
  }
}

function productSearched(params,success,responseObj){

    if(success){

        var products = responseObj.products;

        $('tbody tr').remove();

        for(var i = 0 ; i< products.length ; i++){
            $('tbody').append(
                '<tr class="none-top-border">'
                +'<td>'+products[i].id+'</td>'
                +'<td>'+products[i].name+'</td>'
                +'<td>'+products[i].brand+'</td>'
                +'<td>'+products[i].category+'</td>'
                +'<td>'+products[i].price+'</td>'
                +'<td>'+products[i].quantity+'</td>'
                +'<td>'+products[i].imei+'</td>'
                +'<td>'
                +'<a id="'+products[i].id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
                +'<a id="'+products[i].id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'
                +'</td>'
                +'</tr>');
        }



    }
}



//metod per shtimin e produktit
function saveProduct()
{
    var category = $('#category option:selected').val();
    var brand = $('#brand option:selected').val();
    var name = $('#name').val();
    var price = $('#price').val();
    var quantity = $('#quantity').val();
    var imei = $('#imei').val();
    var description = $('#description').val();
    if(category == 0)
    {
        Materialize.toast('Please Choose Category',3000,'red');
        return false;
    }
    if (category !=3)
    {
        if(brand== null || brand==0)
        {
            Materialize.toast("Please Choose Brand",3000,'red');
            return false;
        }
        if(imei.length != 16){
            Materialize.toast("IMEI length should be 16",3000,'red');
            return false;
        }
    }

    if(name =="" || name.length <3 )
    {
        Materialize.toast("Please Write Name (Minimum 3 Characters)",3000,'red');
        return false;
    }
    if(price == "" || price.length ==0)
    {
          Materialize.toast("Please Write Price",3000,'red');
        return false;
    }
    if(isNaN(price))
    {
          Materialize.toast("Only numeric values allowed for Price",3000,'red');
        return false;
    }
    if(quantity == "" || quantity ==0)
    {
        Materialize.toast("Please Write Quantity (Minimum 1)",3000,'red');
        return false;
    }
    if(isNaN(quantity))
    {
        Materialize.toast("Only numeric values allowed for Quantity",3000,'red');
        return false;
    }
    if(category !=3)
    {
        if(imei=="" || imei==0)
        {
            Materialize.toast("Please Write IMEI",3000,'red');
            return false;
        }
    }

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
      url:'/stock/save_product',
      type:'POST',
      data:{
        name:name,
        category:category,
        brand:brand,
        imei:imei,
        quantity:quantity,
        price:price,
        description:description
      },
      success:function(responseObj){
        Materialize.toast(responseObj.message,3000,'green');

        var product = responseObj.product;
        var brand = responseObj.brand;
        var category = responseObj.category

        $('tbody').append(
        '<tr class="none-top-border">'
        +'<td>'+product.id+'</td>'
        +'<td>'+product.name+'</td>'
        +'<td>'+brand.name+'</td>'
        +'<td>'+category.name+'</td>'
        +'<td>'+product.price+'</td>'
        +'<td>'+product.quantity+'</td>'
        +'<td>'+product.imei+'</td>'
        +'<td>'
          +'<a id="'+product.id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
          +'<a id="'+product.id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'
        +'</td>'
        +'</tr>');





      },
      error:function(responseObj){
          Materialize.toast(responseObj.message,3000,'red');
      }
    });

    clearAddProduct();
    $('#addNewProduct').modal('hide');
}

    //clear all fields
    function clearAddProduct(){
        $('#category').val(0);
        $('#brand').val(0);
        $('#name').val("");
        $('#price').val("");
        $('#quantity').val("");
        $('#imei').val("");
        $('#description').val("");
    }

//Metod per mbushjen e fushave te modalit
function fillEditModal(params,success,responseObj)
{
    $('#edit_category').val(responseObj.product.category_id);
    $('#edit_brand').val(responseObj.product.brand_id);
    $('#edit_name').val(responseObj.product.name);
    $('#edit_price').val(responseObj.product.price);
    $('#edit_quantity').val(responseObj.product.quantity);
    $('#edit_imei').val(responseObj.product.imei);
    $('#edit_description').val(responseObj.product.description);

    Materialize.updateTextFields();
}

//Edit Product function
function editProduct(id){
    var p_id = id;
    var category = $('#edit_category').val();
    var brand = $('#edit_brand').val();
    var name = $('#edit_name').val();
    var price =  $('#edit_price').val();
    var quantity = $('#edit_quantity').val();
    var imei =  $('#edit_imei').val();
    var description = $('#edit_description').val();
    if(category == 0)
    {
        Materialize.toast('Please Choose Category',3000,'red');
        return false;
    }
    if (category !=3)
    {
        if(brand== null || brand==0)
        {
            Materialize.toast("Please Choose Brand",3000,'red');
            return false;
        }
    }
    if(name =="" || name.length <3 )
    {
        Materialize.toast("Please Write Name (Minimum 3 Characters)",3000,'red');
        return false;
    }
    if(price == "" || price.length ==0)
    {
        Materialize.toast("Please Write Price",3000,'red');
        return false;
    }
    if(isNaN(price))
    {
        Materialize.toast("Only numeric values allowed for Price",3000,'red');
        return false;
    }
    if(quantity == "" || quantity ==0)
    {
        Materialize.toast("Please Write Quantity (Minimum 1)",3000,'red');
        return false;
    }
    if(isNaN(quantity))
    {
        Materialize.toast("Only numeric values allowed for Quantity",3000,'red');
        return false;
    }
    if(category !=3){
        if(imei=="" || imei==0){
            Materialize.toast("Please Write IMEI",3000,'red');
            return false;
        }
    }
    ajax("POST","/stock/edit_product","id="+p_id+"&category="+category+"&brand="+brand+"&name="+name+"&price="+price+"&quantity="+quantity+"&imei="+imei+"&description="+description,productEdited,"");
    $('#editProduct').modal('hide');
    location.reload(true);
}

function productEdited(params,success,responseObj){
    if(success)
    {
      var product = responseObj.product;
      var brand = responseObj.brand;
      var category = responseObj.category;

       $('tbody tr').each(function(){

          if($(this).find('td:first-child').text() == product.id){

             $(this).find('td:nth-child(2)').text(product.name);
             $(this).find('td:nth-child(3)').text(brand.name);
             $(this).find('td:nth-child(4)').text(category.name);
             $(this).find('td:nth-child(5)').text(product.quantity);
             $(this).find('td:nth-child(6)').text(product.price);
             $(this).find('td:nth-child(7)').text(product.imei);
          }
       });
        Materialize.toast(responseObj.message,3000,'green');

    }
    else
        Materialize.toast(responseObj.message,3000,'green');
}


function productDeleted(params,success,responseObj){
    if(success){
      Materialize.toast(responseObj.message,3000,'green');
      location.reload();

    }else{
        alertify.error(responseObj.message,3000,'red');
    }
}
