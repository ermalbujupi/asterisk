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

        },
        error:function(responseObj){
            Materialize.toast(responseObj.message,3000,'red');
        }
    });
}
