$(function(){

    $('#send_email').on('click',function(){

        var email = $('#password_reset_email').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if(email == ""){
           Materialize.toast("Please Write Email",3000,'red');
           return false;
        }

        if(!regex.test(email)){
          Materialize.toast("Email not valid",3000,'red');
          return false;
        }
    });
});
