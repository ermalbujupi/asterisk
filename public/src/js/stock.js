$(function(){
  //Shtimi i produktion me onclick dhe validimi i fushave
   $('#save_product').on('click',function(){
      saveProduct();
   });
   //Fill EditProduct Modal
   $('.edit_product_trigger').on('click',function(){
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
   $('.delete_product_trigger').on('click',function(){
     var id = $(this).attr('id');
     $('#delete_product').val(id);
   });
//Delete Product
   $('#delete_product').on('click',function(){
     ajax("POST","/stock/delete_product","id="+this.value,productDeleted,"");
     $('#deleteProductModal').hide();
   });

});



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
        location.reload();
      },
      error:function(responseObj){
          Materialize.toast(responseObj.message,3000,'red');
      }
    });

    clearAddProduct();
    $('#addNewProduct').modal('hide');
}

//clear all fields
function clearAddProduct()
{
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
    if(category !=3)
    {
        if(imei=="" || imei==0)
        {
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
        Materialize.toast(responseObj.message,3000,'green');
        location.reload();
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
