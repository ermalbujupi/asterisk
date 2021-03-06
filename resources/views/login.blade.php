<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{URL::asset('src\font-awesome-4.7.0\css\font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('src/css/materialize.css')}}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        body {
            background: #fff;
        }

        .input-field input[type=date]:focus + label,
        .input-field input[type=text]:focus + label,
        .input-field input[type=email]:focus + label,
        .input-field input[type=password]:focus + label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }

        .login-form{

            margin-left: 35%;
        }



        .loader {
            position: absolute;
            top :0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        .loading_modal{
            background: transparent !important;
            box-shadow: none !important;
            height: 100%;
            overflow: hidden !important;
        }

        #send_email,#password_reset_confirm_code{
            margin-left: 11px;
        }


    </style>
</head>


<body style="background: #f2f2f2">
<div class="section"></div>
<main>
    <div class="login-form col s12 m4">
        <!--<img class="responsive-img" style="width: 250px;" src="http://i.imgur.com/ax0NCsK.gif" /> -->
        <div class="section">
            <h3 class="waves-effect" style="font-family:GillSans, Calibri, Trebuchet, sans-serif; padding-left:10px; color:#1a237e;"  >Welcome to Asterisk</h3>
        </div>

        <h5 class="indigo-text" style="font-family:GillSans, Calibri, Trebuchet, sans-serif; padding-left:40px;">Please, login into your account</h5>
        <div class="section"></div>

        <div class="">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <!--<form class="col s12" method="post" action="{{route('login')}}">-->
                <div class='row'>
                    <div class='col s12'>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12'>
                        <input class='validate' placeholder="Please enter your username" type='text' name='username' id='username' />
                        <label for='email'>Username</label>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12'>
                        <input class='validate' placeholder="Please enter password" type='password' name='password' id='password' />
                        <label for='password'>Password</label>
                    </div>
                    <label style='float: right;'>
                        <a class='pink-text' href='#passwordForgetModal'><b>Forgot Password?</b></a>
                    </label>
                </div>

                <input type="hidden" name="_token" value="{{ Session::token() }}">

                <br />
                <center>
                    <div class='row'>
                        <button type='button' name='btn_login' class='col s12 btn btn-large waves-effect  login_btn' style="background-color:#40E0D0 !important;">Login</button>
                    </div>
                </center>
                <!--</form>-->
            </div>
        </div>
    </div>
    <!--Password Forget Modal -->
    <div id="passwordForgetModal" class="modal">
        <div id="password_forget_modal" class="col s12">
            {{--<form action="{{route('password_reset.send_mail')}}">--}}
            <input type="hidden" id="pass_token" name="csrf-token" value="{{ csrf_token() }}">
            <div class="modal-content">
                <h4>Reset Password</h4>
                <div class="row">
                    <div class="col s12">
                        <label>Email:</label>
                        <input name="email" type="text" id="password_reset_email"/>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button  type="submit" id="send_email" href="#!" class="modal-action  waves-effect  btn" style="background-color:#40E0D0 !important;"> Send Email</button>
                <a  class="modal-action modal-close waves-effect waves-light btn">Close</a>
            </div>
            {{--</form>--}}
        </div>

    </div>
</div>
    <!--/password Forget Modal -->

    <!-- Modal Structure -->
    <div id="loading_modal" class="modal loading_modal">
        <div class="modal-content">
            <div class="preloader-wrapper active loader">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section"></div>
    <div class="section"></div>
</main>
<script type="text/javascript" src="{{URL::asset('src/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('src/js/materialize.js')}}"></script>
<script type="text/javascript">
    var baseUrl = "{{ URL::to('/') }}";
    var token= "{{ Session::token() }}";
</script>
<script>
    function ajax(method, url, params, callback, callbackParams) {
        var xhttp;

        if(window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == XMLHttpRequest.DONE) {
                if(xhttp.status == 200) {
                    var obj = JSON.parse(xhttp.responseText);
                    callback(callbackParams, true, obj);
                }
                else if (xhttp.status == 400) {
                    var obj = JSON.parse(xhttp.responseText);
                    callback(callbackParams, false, obj);
                }
                else {
                    var obj = JSON.parse(xhttp.responseText);
                    if (obj.message) {
                        alert(obj.message);
                    }
                    else
                    {
                        alert("kontrollo edhe niher");
                    }
                }
            }
        };
        xhttp.open(method, baseUrl + url, true);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhttp.send(params + "&_token=" + token);
    }

    $(document).ready(function () {
        $('.modal').modal({
                    dismissible: false
                }
        );
    });

    $('.login_btn').click(function () {
        var username = $('#username').val();
        var password = $('#password').val();
        $('#loading_modal').modal('open');
        ajax("POST",'/login',"username="+username+"&password="+password,onSuccess,'')
    });

    function onSuccess(params,success,responseObj){
        $('#loading_modal').modal('close');
        if(success){
            window.location=baseUrl+'/';
        }
        else{
            Materialize.toast(responseObj.message,3000,'red');
        }

    };

    $('#send_email').on('click',function(){

        var email = $('#password_reset_email').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var token = $('#pass_token').val();

        if(email == ""){
            Materialize.toast("Please Write Email",3000,'red');
            return false;
        }

        if(!regex.test(email)){
            Materialize.toast("Email not valid",3000,'red');
            return false;
        }
        $('#loading_modal').modal('open');
        ajax("POST","/password_reset/send_mail","email="+email+'&token='+token,emailSent,"");


    });

    function emailSent(params,success,responseObj){
        $('#loading_modal').modal('close');

        if(success){
            Materialize.toast(responseObj.message,5000,'green');

        }else{
            Materialize.toast(responseObj.message,5000,'red');
        }
    }


    //# sourceURL=login.js
</script>
</body></html>
