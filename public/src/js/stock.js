$(function(){
  //Shtimi i produktion me onclick dhe validimi i fushave
   $('#save_product').on('click',function(){
      saveProduct();
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
        alert('Please Choose Category');
        return false;
    }
    if (category !=3)
    {
        if(brand== null || brand==0)
        {
            alert("Please Choose Brand");
            return false;
        }
    }
    if(name =="" || name.length <3 )
    {
        alert("Please Write Name (Minimum 3 Characters)");
        return false;
    }
    if(price == "" || price.length ==0)
    {
        alert("Please Write Price");
        return false;
    }
    if(isNaN(price))
    {
        alert("Only numeric values allowed for Price");
        return false;
    }
    if(quantity == "" || quantity ==0)
    {
        alert("Please Write Quantity (Minimum 1)");
        return false;
    }
    if(isNaN(quantity))
    {
        alert("Only numeric values allowed for Quantity");
        return false;
    }
    if(category !=3)
    {
        if(imei=="" || imei==0)
        {
            alert.error("Please Write IMEI");
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
        alert(responseObj.message);
        location.reload();
      },
      error:function(responseObj){
        alert(responseObj.message);
      }
    });

    clearAddProduct();
    $('#addNewProduct').modal('hide');
}


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
