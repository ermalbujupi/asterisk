$(function(){

    $('select').material_select();

    $('#year_select').on('change',function () {
        if(this.value != 0) {
            $('#date').prop('disabled', true);
            $('#date').val("");
        }
        else {
            $('#date').prop('disabled', false);
            $('#date').val();
        }


        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        salesFilter(user,year,month,0);
    });

    $('#month_select').on('change',function () {
        if(this.value != 0) {
            $('#date').prop('disabled', true);
            $('#date').val("");
        }
        else {
            $('#date').prop('disabled', false);
            $('#date').val();
        }

        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        salesFilter(user,year,month,0);
    });



    $('#date').on('change',function(){

        var date =  $('#date').val();
        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        salesFilter(user,year,month,date);
    });

    //refresh table
    $('#refresh_button').click(function(){
        var date =  $('#date').val();
        salesFilter(0,0,0,date);
    });

    //list sales by user
    $('#user_select').on('change',function(){

        var date =  $('#date').val();
        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        salesFilter(user,year,month,(date==''?0:date));
    });

    //export to excel
    $('#export_xls').on('click',function(){
        var date =  $('#date').val();
        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        ajax("GET",'/sales/export_excel/'+user+'/'+year+'/'+month+'/'+date,'',exported,'');
    });

    $('#export_pdf').on('click',function(){
        var date =  $('#date').val();
        var user = $('#user_select').val();
        var month = $('#month_select').val();
        var year = $('#year_select').val();

        ajax("GET",'/sales/export_pdf/'+user+'/'+year+'/'+month+'/'+date,'',exported,'');
    });

});

function salesFilter(user,year,month,date){
    $('#loading_modal').modal('open');
    ajax("GET",'/sales/sales_filter/'+user+'/'+year+'/'+month+'/'+date,'',reloadTable,'');
}

function reloadTable(params,success,responseObj){

    if(success){
        $('#sales_tbody tr').remove();
        var sales = responseObj.sellings;

        for(var i =0; i< sales.length; i++){

            $('#sales_tbody').append(
                '<tr class="none-top-border">'
                   +'<td>'+sales[i].id+'</td>'
                   +'<td>'+sales[i].user+'</td>'
                   +'<td>'+sales[i].product+'</td>'
                   +'<td>'+sales[i].brand+'</td>'
                   +'<td>'+sales[i].category+'</td>'
                   +'<td>'+sales[i].quantity_sold+'</td>'
                   +'<td>'+sales[i].price_sold+'&euro;</td>'
                   +'<td>'+sales[i].created_at+'</td>'
                +'</tr>'
            );
        }

        $('#loading_modal').modal('close');
    }
}

function exported(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}