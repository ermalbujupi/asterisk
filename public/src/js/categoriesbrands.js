$(function(){

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

    //Trigger per editimin e brandit
    $('#brand_table').on('click','.edit_brand_trigger',function(){

        var id = $(this).attr('id');
        $('#edit_brand').val(id);
        $('#delete_brand').val(id);
        ajax('POST',"/categories_brands/get_brand","id="+id,brandFound,"");
    });

    //Edit Brand
    $('#edit_brand').on('click',function(){

        var id = $(this).val();
        var name = $('#edit_brand_name').val();
        var info = $('#edit_brand_info').val();

        if(name == ""){
            Materialize.toast('Please write brand name',3000,'red');
            return false;
        }

        ajax('POST','/categories_brands/edit_brand','id='+id+"&name="+name+'&info='+info,brandEdited,'');

    });

    //Trigger per fshirje te brand-it
    $('#brand_table').on('click','.delete_brand_trigger',function(){
        var id = $(this).attr('id');
        $('#delete_brand').val(id);
    });

    //Delete Brand
    $('#delete_brand').on('click',function(){

        var id = $(this).val();

        ajax('POST','/categories_brands/delete_brand','id='+id,brandDeleted,'');
    });


    //Shtimi i categorise
    $('#save_category').on('click',function(){

        var name = $('#category_name').val();

        if(name == ""){
            Materialize.toast('Please write brand name',3000,'red');
            return false;
        }

        ajax("POST","/stock/add_category","name="+name,categoryAdded,"");
    });

    //Trigger per editimin e kategorise
    $('#category_table_body').on('click','.edit_category_trigger',function(){

        var id = $(this).attr('id');
        $('#edit_category').val(id);
        $('#delete_product').val(id);

        ajax('POST','/categories_brands/get_category','id='+id,categoryFound,'');
    });

    //Edit category
    $('#edit_category').on('click',function(){

        var id = $(this).val();
        var name = $('#edit_category_name').val();

        if(name == ""){
            Materialize.toast('Please write brand name',3000,'red');
            return false;
        }

        ajax('POST','/categories_brands/edit_category','id='+id+"&name="+name,categoryEdited,'');
    });

    //Trigger per fshirje te brand-it
    $('#category_table_body').on('click','.delete_category_trigger',function(){
        var id = $(this).attr('id');
        $('#delete_category').val(id);
    });

    //Delete Category
    $('#delete_category').on('click',function(){

        var id = $(this).val();

        ajax('POST','/categories_brands/delete_category','id='+id,categoryDeleted,'');
    });

});

function categoryDeleted(params,success,responseObj){

    if(success){

        Materialize.toast(responseObj.message,3000,'green');
        $('#deleteCategoryModal').modal('close');
        location.reload();
    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}

function brandDeleted(params,success,responseObj){

    if(success){

        Materialize.toast(responseObj.message,3000,'green');
        location.reload();
    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}

function brandEdited(params,success,responseObj){

    if(success){

        var brand = responseObj.brand;

        $('#brand_table_body tr').each(function(){

            if($(this).find('td:first-child').text() == brand.id){
                $(this).find('td:nth-child(2)').text(brand.name);
                $(this).find('td:nth-child(3)').text(brand.info);
            }
        });
        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}


function categoryEdited(params,success,responseObj){

    if(success){

        var category = responseObj.category

        $('#category_table_body tr').each(function(){

            if($(this).find('td:first-child').text() == category.id){
                $(this).find('td:nth-child(2)').text(category.name);
            }
        });
        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}




function brandAdded(params,success,responseObj){

    if(success){
        var brand = responseObj.brand;

        $('#brand_table_body').append(
            '<tr class="none-top-border">'
            +'<td>'+brand.id+'</td>'
            +'<td>'+brand.name+'</td>'
            +'<td>'+brand.info+'</td>'
            +'<td>'
            +'<a id="'+brand.id+'" href="#editBrandModal"   class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_brand_trigger" data-tooltip="Edit Brand" data-position="top"><span class="fa fa-pencil"></span></a>'
            +'<a id="'+brand.id+'" href="#deleteBrandModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_brand_trigger" data-tooltip="Delete Brand" data-position="top"><span class="fa fa-trash"></span></a>'
            +'<td>'
            +'</tr>');

        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}

function brandFound(params,success,responseObj){

    if(success){

        var brand  = responseObj.brand;

        $('#edit_brand_name').val(brand.name);
        $('#edit_brand_info').val(brand.info);
    }
}

function categoryFound(params,success,responseObj){

    if(success){

        var category = responseObj.category;

        $('#edit_category_name').val(category.name);
    }
}

function categoryAdded(params,success,responseObj){

    if(success){
        var category = responseObj.category;

        $('#category_table_body').append(
            '<tr class="none-top-border">'
            +'<td>'+category.id+'</td>'
            +'<td>'+category.name+'</td>'
            +'<td>'
                +'<a id="'+category.id+'" href="#editCategoryModal"   class="btn btn-floating waves-effect waves-light blue action_button tooltipped edit_category_trigger" data-tooltip="Edit Category" data-position="top"><span class="fa fa-pencil"></span></a>'
                +'<a id="'+category.id+'" href="#deleteCategoryModal" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped delete_category_trigger" data-tooltip="Delete Category" data-position="top"><span class="fa fa-trash"></span></a>'
            +'<td>'
            +'</tr>');


        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}