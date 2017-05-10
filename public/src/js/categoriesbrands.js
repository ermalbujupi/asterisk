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

    //Editimi i brandit
    $('#brand_table').on('click','.edit_brand_trigger',function(){

        var id = $(this).attr('id');

        ajax('POST',"/categories_brands/get_brand","id="+id,brandFound,"");
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






});

function brandAdded(params,success,responseObj){

    if(success){
        var brand = responseObj.brand;

        $('#brand_table_body').append(
            '<tr class="none-top-border">'
            +'<td>'+brand.id+'</td>'
            +'<td>'+brand.name+'</td>'
            +'</tr>');

        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}

function brandFound(params,success,responseObj){

    if(success){

        var brand 
    }
}

function categoryAdded(params,success,responseObj){

    if(success){
        var category = responseObj.category;

        $('#category_table_body').append(
            '<tr class="none-top-border">'
            +'<td>'+category.id+'</td>'
            +'<td>'+category.name+'</td>'
            +'</tr>');


        Materialize.toast(responseObj.message,3000,'green');

    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}