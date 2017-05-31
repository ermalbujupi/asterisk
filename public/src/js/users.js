$(function(){

  //on-click trigger add new user
  $('#save_user').on('click',function(){
      saveUser();
  });

  //Fill Modal data with data from controller
   $('.edit_user_trigger').on('click',function(){
       var user_id = $(this).attr('id');
       $('#edit_user').val(user_id);
       ajax("POST","/users/get_user","id="+user_id,fillUserModal,"");
   });

   $('#edit_user').on('click',function(){
      var id = $(this).val();
      edit_user(id);
   });
//on-click trigger to delete user
   $('.delete_user_trigger').on('click',function(){
       var id = $(this).attr('id');
       $('#delete_user').val(id);
   })

//Delete user
   $('#delete_user').on('click',function(){
     var user_id = this.value;
      ajax("POST","/users/delete_user","id="+user_id,userDeleted,"");
   });


});

//Method For Add new usser
function saveUser(){
    var fullName = $('#fullName').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var email  = $('#email').val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var privilege = $('#privilege option:selected').val();
    if(fullName === ""){
        Materialize.toast('Please Write Full Name',3000,'red');
        return false;
    }
    if(username === ""){
        Materialize.toast('Please Write Username',3000,'red');
        return false;
    }
    if(password.length <3 ){
        Materialize.toast('Please Write Password ( Minimum 3 Characters)',3000,'red');
        return false;
    }
    if(email === ""){
        Materialize.toast('Please Write Email ',3000,'red');
        return false;
    }
    else if(!regex.test(email)){
        Materialize.toast('Invalid Email',3000,'red');
        return false;
    }
    if(!(privilege > 0)){
        Materialize.toast('Please Select a privilege',3000,'red');
        return
    }
    ajax("POST","/users/save_user","full_name="+fullName+"&username="+username+"&password="+password+"&email="+email+"&privilege="+privilege,userSaved,"");
}

function userSaved(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload(true);
    }
    else{
      Materialize.toast(responseObj.message,3000,'red');
    }
}

function fillUserModal(params,success,responseObj){
    $('#edit_FullName').val(responseObj.message.full_name);
    $('#edit_username').val(responseObj.message.username);
    $('#edit_email').val(responseObj.message.email);
    $('#edit_privilege').val(responseObj.message.role);

    Materialize.updateTextFields();
}

function edit_user(id){
    var user_id = id;
    var fullName = $('#edit_FullName').val();
    var username = $('#edit_username').val();
    var email = $('#edit_email').val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var privilege = $('#edit_privilege :selected').val();
    if(fullName === ""){
        Materialize.toast('Please Write Full Name',3000,'red');
        return false;
    }
    if(username === ""){
        Materialize.toast('Please Write Username',3000,'red');
        return false;
    }
    if(email === ""){
        Materialize.toast('Please Write Email',3000,'red');
        return false;
    }
    else if(!regex.test(email)){
        Materialize.toast('Invalid Email',3000,'red');
        return false;
    }
    if(!(privilege >0)){
        Materialize.toast('Please Select a privilege',3000,'red')
        return
    }
    ajax("POST","/users/edit_user","id="+user_id+"&full_name="+fullName+"&username="+username+"&email="+email+"&privilege="+privilege,userEdited,"");
}

function userEdited(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload(true);
    }
    else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}


function userDeleted(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload();
    }else{
        alertify.error(responseObj.message,3000,'red');
    }
}
