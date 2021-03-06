var productsGlobal = null;
var sales = [];

$(function(){
    //Shtimi i produktion me onclick dhe validimi i fushave
    $('#save_product').on('click',function(){
        saveProduct();
    });

    $('#stock_body').on('click','.edit_product_trigger',function(){
        var id = $(this).attr('id');
        ajax("POST","/stock/get_product","product_id="+id,fillEditModal,"");
        $('#edit_product').val(id);
    });

    //Edit Product
    $('#edit_product').on('click',function(){
        var id = $(this).val();
        editProduct(id);
    });

    //refresh button
    $('#refresh_button').on('click',function(){
        $('#loading_modal').modal('open');
        ajax('GET','/stock/get_all','',searchResultByCategoryOrBrand,'');

    });

    //Give id to the submit button
    $('#stock_body').on('click','.delete_product_trigger',function(){
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

//Search

    $('#name_search').on('keyup',function(e){

        $('#start').hide();
        $('#stock_table').show();

        var word  = $(this).val();
        var category = $('#category_search option:selected').val();
        var brand = $('#brand_search option:selected').val();

        if(word.length == 0){
            $('#stock_body tr').remove();
            $('#start').show();
            $('#stock_table').hide();
        }

        if(word.length == 2 && e.keyCode != 8){
            $('#loading_modal').modal('open');
            $('#name_search').prop('disabled',true);
            filterSearch(category,brand,word);
        }else{

            if(productsGlobal !=  null){
                $('#stock_body tr').remove();
                for(var i = 0 ; i< productsGlobal.length; i++){

                    word =  word.toLowerCase();
                    var name = productsGlobal[i].name.toLowerCase();

                    if(name.indexOf(word) != -1){

                        $('#stock_body').append(
                            '<tr class="none-top-border">'
                            +'<td>'+productsGlobal[i].id+'</td>'
                            +'<td>'+productsGlobal[i].name+'</td>'
                            +'<td>'+productsGlobal[i].brand+'</td>'
                            +'<td>'+productsGlobal[i].category+'</td>'
                            +'<td>'+productsGlobal[i].price+'</td>'
                            +'<td>'+productsGlobal[i].price_sold+'</td>'
                            +'<td>'+productsGlobal[i].quantity+'</td>'
                            +'<td>'
                            +'<a id="'+productsGlobal[i].id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
                            +'<a id="'+productsGlobal[i].id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'

                            +'</td>'
                            +'</tr>');
                    }
                }

                $('#loading_modal').modal('close');
            }

        }

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
    $('#stock_body').on('click','.sell_product_trigger',function(){

        var id = $(this).attr('id');
        $('#sell_product').val(id);

        ajax("POST","/stock/get_product","product_id="+id,fillSellModal,"");
    });

    //Sell Product
    $('#sell_product').on('click',function(){
        sellProduct();
    });

    $('#close_sell').on('click',function(){
        $('#prepare_sell .grand').remove();
        sales = [];
    });


    //Search By Category

    $('#category_search').on('change',function(){
        $('#start').hide();
        $('#stock_table').show();
        var brandId = 0;
        var categoryId =  $('#category_search option:selected').val();
        var word = $('#name_search').val();
        if($('#brand_search option:selected').val() != 0){
            brandId = $('#brand_search option:selected').val();
        }

        $('#loading_modal').modal('open');
        filterSearch(categoryId,brandId,word);
    });

    //Search By Brand
    $('#brand_search').on('change',function(){
        $('#start').hide();
        $('#stock_table').show();

        var categoryId = 0;
        var brandId = $('#brand_search option:selected').val();
        var word = $('#name_search').val();
        if($('#category_search option:selected ').val() != 0){
            categoryId = $('#category_search option:selected ').val();
        }
        $('#loading_modal').modal('open');
        filterSearch(categoryId,brandId,word);
    });



});

function filterSearch(category,brand,word){

    ajax("POST",'/stock/search_filter','category='+category+'&brand='+brand+'&word='+word,productSearched,'');
}

function searchResultByCategoryOrBrand(params,success,responseObj){
    if(success){

        products = responseObj.products;
        $('#stock_body tr').remove();
        for(var i =0 ; i< products.length ; i++){

            $('#stock_body').append(
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
                +'<a id="'+products[i].id+'" href="#sellProductModal" class="btn btn-floating tooltipped waves-effect waves-light green action_button tooltipped sell_product_trigger" data-tooltip="Sell Product" data-position="top"><span class="fa fa-shopping-cart" aria-hidden="true"></span></a>'
                +'</td>'
                +'</tr>');
        }
        $('#loading_modal').modal('close');
    }
}



function sellProduct(){

    var index  = 0;

    ajax('POST','/stock/sell_product','products='+sales,productSold,'');


}



function fillSellModal(params,success,responseObj){

    if(success){

        var product = responseObj.product;

        $('#sell_category').val(product.category_id);
        $('#sell_brand').val(product.brand_id);
        $('#sell_name').val(product.name);
        $('#sell_price').val(product.price);
        $('#sell_quantity').val(product.quantity);

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

        productsGlobal = responseObj.products;

        $('#stock_body tr').remove();

        for(var i = 0 ; i< productsGlobal.length ; i++){
            $('#stock_body').append(
                '<tr class="none-top-border">'
                +'<td>'+productsGlobal[i].id+'</td>'
                +'<td>'+productsGlobal[i].name+'</td>'
                +'<td>'+productsGlobal[i].brand+'</td>'
                +'<td>'+productsGlobal[i].category+'</td>'
                +'<td>'+productsGlobal[i].price+'</td>'
                +'<td>'+productsGlobal[i].price_sold+'</td>'
                +'<td>'+productsGlobal[i].quantity+'</td>'
                +'<td>'
                +'<a id="'+productsGlobal[i].id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
                +'<a id="'+productsGlobal[i].id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'

                +'</td>'
                +'</tr>');
        }
        $('#loading_modal').modal('close');
        $('#name_search').prop('disabled',false);
        $('#name_search').focus();

    }
}


//metod per shtimin e produktit
function saveProduct()
{
    var category = $('#category option:selected').val();
    var brand = $('#brand option:selected').val();
    var name = $('#name').val();
    var price = $('#price').val();
    var priceSell = $('#sell_price').val();
    var quantity = $('#quantity').val();
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
    if(isNaN(price) || price<0)
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

    if(priceSell == ""){
        Materialize.toast("Please write selling price",3000,'red');
        return false;
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
            quantity:quantity,
            price:price,
            sell_price:priceSell,
            description:description
        },
        success:function(responseObj){
            Materialize.toast(responseObj.message,3000,'green');
            $('#start').hide();
            $('#stock_table').show();
            var product = responseObj.product;
            var brand = responseObj.brand;
            var category = responseObj.category;

            var productExists = false;

            $('#stock_body tr').each(function(){

                if($(this).find('td:first-child').text() == product.id){
                    $(this).find('td:nth-child(6)').text(product.quantity);
                    productExists = true;
                }
            });

            if(!productExists){
                $('#stock_body').append(
                    '<tr class="none-top-border">'
                    +'<td>'+product.id+'</td>'
                    +'<td>'+product.name+'</td>'
                    +'<td>'+brand.name+'</td>'
                    +'<td>'+category.name+'</td>'
                    +'<td>'+product.price+'</td>'
                    +'<td>'+product.price_sold+'</td>'
                    +'<td>'+product.quantity+'</td>'
                    +'<td>'
                    +'<a id="'+product.id+'" href="#editProductModal"  data-target="modal1" class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_product_trigger" data-tooltip="Edit Product" data-position="top"><span class="fa fa-pencil"></span></a>'
                    +'<a id="'+product.id+'" href="#deleteProductModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_product_trigger" data-tooltip="Delete Product" data-position="top"><span class="fa fa-trash"></span></a>'

                    +'</td>'
                    +'</tr>');
            }
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

    ajax("POST","/stock/edit_product","id="+p_id+"&category="+category+"&brand="+brand+"&name="+name+"&price="+price+"&quantity="+quantity+"&description="+description,productEdited,"");
    $('#editProduct').modal('hide');
    location.reload(true);
}

function productEdited(params,success,responseObj){
    if(success)
    {
        var product = responseObj.product;
        var brand = responseObj.brand;
        var category = responseObj.category;

        $('#stock_body tr').each(function(){

            if($(this).find('td:first-child').text() == product.id){

                $(this).find('td:nth-child(2)').text(product.name);
                $(this).find('td:nth-child(3)').text(brand.name);
                $(this).find('td:nth-child(4)').text(category.name);
                $(this).find('td:nth-child(5)').text(product.price);
                $(this).find('td:nth-child(6)').text(product.quantity);
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
        Materialize.toast(responseObj.message,3000,'red');
    }
}
