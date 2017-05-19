$(function(){

    $('select').material_select();

    $('#year_select').on('change',function () {
        var year = this.value;

        if(year!=0)
        {
            $('#month_select').removeAttr('disabled');
        }
    });

    $('#date').on('change',function(){

        var date =  $(this).val();
        $('#loading_modal').modal('open');
        ajax("GET",'/sales/filter_date/'+date,'',reloadTable,'');
    });

    //refresh table
    $('#refresh_button').click(function(){
        $('#loading_modal').modal('open');
        ajax('GET','/sales/refresh_sales','',reloadTable,'');
    });

    //list sales by user
    $('#user_select').on('change',function(){

        var user_id = $(this).val();
        $('#loading_modal').modal('open');
        ajax('GET','/sales/filter_user/'+user_id,'',reloadTable,'');
    });

});

function reloadTable(params,success,responseObj){

    if(success){
        $('#sales_tbody tr').remove();
        var sales = responseObj.sales;

        for(var i =0; i< sales.length; i++){

            $('#sales_tbody').append(
               '<td>'+sales[i].id+'</td>'
               +'<td>'+sales[i].user+'</td>'
               +'<td>'+sales[i].product+'</td>'
               +'<td>'+sales[i].brand+'</td>'
               +'<td>'+sales[i].category+'</td>'
               +'<td>'+sales[i].quantity_sold+'</td>'
               +'<td>'+sales[i].price_sold+'&euro;</td>'
               +'<td>'+sales[i].created_at+'</td>'
            );
        }

        $('#loading_modal').modal('close');
    }
}