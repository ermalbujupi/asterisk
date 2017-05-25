var productsGlobal = null;
var sales = [];

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

    $('.filled-in').on('click',function(){
        var countChecked = 0;
        var countUnChecked = 0;
        var count = 0;
        $('.filled-in').each(function(){
            count++;
            if(this.checked ){
                countChecked++;

            }else{
                countUnChecked++;
            }
        });

        if(countChecked > 0){
            $('#sell').show();
        }else if(countUnChecked >= count){
            $('#sell').hide();
        }
    });

    //Fill Sell Modal
    $('#sell').on('click',function(){
        var glId = 0;
        var count = 0;
        var total = 0.0;

        $('.filled-in').each(function(){
            if(this.checked ){
                glId = this.value;
                $('tbody tr').each(function(){

                    if($(this).find('td:first-child').text() == glId){

                        var id = $(this).find('td:first-child').text();
                        var name =  $(this).find('td:nth-child(2)').text();
                        var brand = $(this).find('td:nth-child(3)').text();
                        var category = $(this).find('td:nth-child(4)').text();
                        var price = parseFloat($(this).find('td:nth-child(5)').text());
                        var quantity =parseInt($(this).find('td:nth-child(6)').text());

                        $('#prepare_sell').append(
                            '<div class="grand" id="'+id+'">'
                                +
                                '<div class="input-field col s2">'
                                    +'<input name="edit_name"  value="'+id+'" placeholder=""  disabled  id="sell_name" type="text" class="validate ">'
                                    +(count == 0?'<label class="active">ID</label>':'')+
                                '</div>'
                                +
                                '<div class="input-field col s2">'
                                    +'<input name="edit_name"  value="'+name+'" placeholder=""  disabled  id="sell_name" type="text" class="validate">'
                                    +(count == 0?'<label class="active">Name</label>':'')+
                                '</div>'
                                +
                                ' <div class="input-field col s2">'
                                    +'<input name="edit_name" value="'+brand+'" placeholder="" disabled  id="sell_brand" type="text" class="validate">'
                                    +(count == 0?'<label class="active" for="first_name">Brand</label>':'')+
                                '</div>'
                                +
                                '<div class="input-field col s2">'
                                    +'<input name="edit_name" placeholder="" disabled  value="'+category+'" id="sell_category" type="text" class="validate">'
                                    +(count == 0?'<label class="active" for="first_name">Category</label>':'')+
                                '</div>'
                                +
                                '<div class="input-field col s2 div_price ">'
                                    +'<input id="sell_price" placeholder="" value="'+price+'" disabled name="price" type="number" class="sell_price" >'
                                    +(count == 0?'<label class="active" for="sell_price">Price</label>':'')+
                                '</div>'
                                +
                                '<div class="input-field col s2 div_quantity">'
                                    +'<input id="sell_quantity" placeholder="" value="'+quantity+'"  name="price" type="number" class="sell_quantity" >'
                                    +(count == 0?'<label class="active" for="sell_quantity">Quantity</label>':'')+
                                '</div>'
                                +
                            '</div>'
                        );
                        count++;
                        total += price*quantity;
                        var line = id+';'+name+';'+brand+';'+category+';'+price+';'+'quantity';
                        sales.push(line);
                    }
                });

                $('#total').text(total);
            }
        });

    });


    $('#prepare_sell').on('change','.sell_quantity',function(){

        var price = 0.0;
        var quantity = 0;
        $(this).each(function(){
           price += $(this).parent().parent().find('.div_price .sell_price').val();
           quantity += $(this).val();
        });

        $('#total').text(price*quantity);
    });

    //refresh button
    $('#refresh_button').on('click',function(){
        $('#loading_modal').modal('open');
        ajax('GET','/stock/get_all','',searchResultByCategoryOrBrand,'');

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

//Search

    $('#name_search').on('keyup',function(e){

        var word  = $(this).val();
        var category = $('#category_search option:selected').val();
        var brand = $('#brand_search option:selected').val();

        if(word.length == 0){
            $('#loading_modal').modal('open');
            filterSearch(category,brand,word);
        }

        if(word.length == 2 && e.keyCode != 8){
            $('#loading_modal').modal('open');
            $('#name_search').prop('disabled',true);
            filterSearch(category,brand,word);
        }else{

            if(productsGlobal !=  null){
                $('tbody tr').remove();
                for(var i = 0 ; i< productsGlobal.length; i++){

                    word =  word.toLowerCase();
                    var name = productsGlobal[i].name.toLowerCase();

                    if(name.indexOf(word) != -1){

                        $('tbody').append(
                            '<tr class="none-top-border">'
                            +'<td>'+productsGlobal[i].id+'</td>'
                            +'<td>'+productsGlobal[i].name+'</td>'
                            +'<td>'+productsGlobal[i].brand+'</td>'
                            +'<td>'+productsGlobal[i].category+'</td>'
                            +'<td>'+productsGlobal[i].price+'</td>'
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
                +'<a id="'+products[i].id+'" href="#sellProductModal" class="btn btn-floating tooltipped waves-effect waves-light green action_button tooltipped sell_product_trigger" data-tooltip="Sell Product" data-position="top"><span class="fa fa-shopping-cart" aria-hidden="true"></span></a>'
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
    var product = responseObj.product;

    if(success){

        $('tbody tr').each(function(){

            if($(this).find('td:first-child').text() == product.id){

                if(product.quantity == 0){
                    $(this).remove();
                }

                $(this).find('td:nth-child(2)').text(product.name);
                $(this).find('td:nth-child(3)').text(brand.name);
                $(this).find('td:nth-child(4)').text(category.name);
                $(this).find('td:nth-child(5)').text(product.price);
                $(this).find('td:nth-child(6)').text(product.quantity);
            }
        });

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

        $('tbody tr').remove();

        for(var i = 0 ; i< productsGlobal.length ; i++){
            $('tbody').append(
                '<tr class="none-top-border">'
                +'<td>'+productsGlobal[i].id+'</td>'
                +'<td>'+productsGlobal[i].name+'</td>'
                +'<td>'+productsGlobal[i].brand+'</td>'
                +'<td>'+productsGlobal[i].category+'</td>'
                +'<td>'+productsGlobal[i].price+'</td>'
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
            description:description
        },
        success:function(responseObj){
            Materialize.toast(responseObj.message,3000,'green');

            var product = responseObj.product;
            var brand = responseObj.brand;
            var category = responseObj.category;

            var productExists = false;

            $('tbody tr').each(function(){

                if($(this).find('td:first-child').text() == product.id){
                    $(this).find('td:nth-child(6)').text(product.quantity);
                    productExists = true;
                }
            });

            if(!productExists){
                $('tbody').append(
                    '<tr class="none-top-border">'
                    +'<td>'+product.id+'</td>'
                    +'<td>'+product.name+'</td>'
                    +'<td>'+brand.name+'</td>'
                    +'<td>'+category.name+'</td>'
                    +'<td>'+product.price+'</td>'
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

        $('tbody tr').each(function(){

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
