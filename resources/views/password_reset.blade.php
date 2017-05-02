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

        #send_email{
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
            <h3>Asterisk</h3>
        </div>

        <h5 class="indigo-text">Password Reset</h5>
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
                            <input class='validate' placeholder="" type='text' name='username' id='username' />
                            <label for='email'>New Passowrd</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' placeholder="" type='password' name='password' id='password' />
                            <label for='password'>Repeat New Password</label>
                        </div>

                    </div>



                    <br />
                    <center>
                        <div class='row'>
                            <button type='button' name='btn_login' class='col s12 btn btn-large waves-effect blue login_btn'>Confirm</button>
                        </div>
                    </center>
                <!--</form>-->
            </div>
        </div>
    </div>
    <!--Password Forget Modal -->
    <div id="passwordForgetModal" class="modal">
      <div class="modal-content">
        <h4>Reset Password</h4>
        <div class="row">
            <div class="col s12">
                <label>Email:</label>
                <input type="text" id="password_reset_email"/>
            </div>
        </div>
      </div>
          <div class="modal-footer">
            <button  type="submit" id="send_email" href="#!" class="modal-action  waves-effect waves-green btn "> Send Email</button>
            <a class="modal-action modal-close waves-effect waves-light btn">Close</a>
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
<script>
</script>
</body></html>
