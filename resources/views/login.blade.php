<html lang="en">
<script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{URL::asset('src\font\font-awesome-4.7.0\css\font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('src/css/style.css')}}">
</head>

<body style="background: #f2f2f2">
<main>
    <div class="container-fluid">
        <br><br><br><br>
        <div class="row">

            <div class="col-lg-4 col-md-4 offset-md-4 offset-lg-4">

                <div class="card">
                    <div class="card-block">
                        <div class="form-header info-color ">
                            <h3><i class="fa fa-lock"></i> Login:</h3>
                        </div>
                        <form action="{{ route('login') }}" method="POST" >
                            <div class="md-form">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text"  name="username" class="form-control">
                                <label for="form2" class="">Your email</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="password" class="form-control">
                                <label for="form4" class="">Your password</label>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-info waves-effect waves-light" type="submit">Login</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        </form>

                    </div>

                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options">
                            <p>Forgot <a href="#">Password?</a></p>
                        </div>
                    </div>

                </div>
                <!--/Form with header-->

            </div>

        </div>
    </div>
</main>
<script type="text/javascript">
    var baseUrl = "{{ URL::to('/') }}";
    var token = "{{ Session::token() }}";
</script>
<script type="text/javascript" src="{{URL::asset('src/js/script.js')}}"></script>
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

</script>
</body></html>