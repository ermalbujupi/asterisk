$(function(){

    $('#password_repeat').on('keyup',function(){

        var repeatPassword = $(this).val();
        var password = $('#password').val();


        if(repeatPassword != password){
            $('#alert_password_error').show();
        }else{
            $('#alert_password_error').hide();
        }

    });

    $('#confirm').on('click',function(){

        var password = $('#password_repeat').val();
        var user  = $('#user').val();
        var token = $('#pass_token').val();
        $('#loading_modal').modal('open');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            url:'/password/reset_password',
            type:'POST',
            data:{
                user:user,
                password:password,

            },
            success:function(responseObj){
                $('#loading_modal').modal('close');
                Materialize.toast(responseObj.message,3000,'green');
                document.location.href="{{route('login')}}";
            },
            error:function(responseObj){
                Materialize.toast(responseObj,3000,'red');
            }

        });


    });
});

