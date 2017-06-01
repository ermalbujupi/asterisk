/**
 * Created by User on 02-May-17.
 */

$(document).ready(function() {
    $('select').material_select();

    $('#save_task').on('click',function(){

        saveTask();
    });
});

$('.check_task').on('change',function(){

});

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
});

$('')

$('tbody').on('click','.delete_task_trigger',function(){
   var id = $(this).attr('id');
    $('#delete_task').val(id);
});
//Delete task
$('#delete_task').on('click',function(){
     var id = $(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token2"]').attr('content')
        }
    });

    $.ajax({
        url:'/todo/delete_task',
        type:'POST',
        data:{
            id:id
        },
        success: function (response) {
            Materialize.toast(response.message,3000,'green');
            location.reload();
        },
        error:function(response){
            Materialize.toast(response.message,3000,'red');
            location.reload();
        }
    });
});

function saveTask()
{
    var task = $('#task').val();
    var priority = $('#priority option:selected').text();

    alert(priority);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax({
    url:'/todo/save_task',
    type:'POST',
        data:{
            task:task,
            priority:priority
        },
        success:function(responseObj){
            Materialize.toast(responseObj.message,3000,'green');

            var tasks = responseObj.task;


            $('tbody').append(
                '<tr class="none-top-border">'
                +'<td>'+tasks.name+'</td>'
                +'<td>'+tasks.priority+'</td>'
                +'<td>'+tasks.status+'</td>'
                +'<td>'+ '</td>'
                +'<td>'
                +'<a id="'+tasks.id+'" href="#deleteTaskModal" class="btn btn-floating waves-effect waves-light RED action_button tooltipped delete_product_trigger" data-tooltip="Delete Task" data-position="top"><span class="fa fa-trash"></span></a>'
                +'</td>'
                +'</tr>'
            );
        },
        error:function(responseObj){
            Materialize.toast(responseObj.message,3000,'red');
        }
    });

    clearFields();

}

function clearFields(){
    $('#task').val('');
    $('#priority').val(0);
}

function taskDeleted(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload();

    }else{
        alertify.error(responseObj.message,3000,'red');
    }
}