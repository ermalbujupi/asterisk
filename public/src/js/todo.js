/**
 * Created by User on 02-May-17.
 */

$(document).ready(function() {
    $('select').material_select();

    $('#save_task').on('click',function(){

        saveTask();
    });
});

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
});

$('tbody').on('click','.delete_product_trigger',function(){
   var id = $(this).attr('id');
    $('#delete_task').val(id);
});
//Delete task
$('#delete_task').on('click',function(){
    ajax("POST","/todo/delete_task","id="+this.value,taskDeleted,"");
    $('#deleteTaskModal').hide();
});

function saveTask()
{
    var task = $('#task').val();
    var priority = $('#priority option:selected').val();


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
                +'<td>'+
                '<a id="'+tasks.id+'" href="#deleteTaskModal" class="btn btn-floating waves-effect waves-light RED action_button tooltipped delete_product_trigger" data-tooltip="Delete Task" data-position="top"><span class="fa fa-trash"></span></a>'
                +'</td>'
                +'</tr>'
            );
        },
        error:function(responseObj){
            Materialize.toast(responseObj.message,3000,'red');
        }
    });
}

function taskDeleted(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload();

    }else{
        alertify.error(responseObj.message,3000,'red');
    }
}