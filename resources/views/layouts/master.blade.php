<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('src/font-awesome-4.7.0/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{URL::asset('src/css/materialize.css')}}">
    <link rel="stylesheet" href="{{URL::asset('src/css/style.css')}}">

    @yield('styles')
</head>

<body cz-shortcut-listen="true">
<header>
    <nav class="top-nav blue">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="fa fa-bars"></i></a>
            <div class="nav-wrapper ">
                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="{{route('logout')}}">Log Out</a></li>
                    <li><a href="#!">Account</a></li>
                </ul>
                <h4 class="brand-logo center">@yield('page')</h4>
                <ul class="right user-menu">
                    <li><i class="fa fa-user fa-fw dropdown-button" href='#' data-activates='dropdown1'></i></li>
                    <li><i class="fa fa-caret-down dropdown-button"  data-activates='dropdown1'></i></li>
                </ul>
            </div>
    </nav>
    <div class="container"></div>
    <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
        <li class="logo"><a id="logo-container" href="#" class="brand-logo">
            <h1>logo </h1>
        <li class="bold {{Request::is('/') ? 'active':''}}"><a href="{{route('index')}}" class="waves-effect waves-teal"><i class="fa fa-bar-chart menu-item"></i>Dashboard  </a></li>
        <li class="bold {{Request::is('stock') ? 'active':''}}"><a href="#" class="waves-effect waves-teal"><i class="fa fa-rocket"></i>Products</a></li>
        <li class="bold {{Request::is('users') ? 'active':''}}"><a href="{{route('users')}}" class="waves-effect waves-teal"><i class="fa fa-users"></i>Users</a></li>
        <li class="bold {{Request::is('log') ? 'active':''}}"><a href="#" class="waves-effect waves-teal"><i class="fa fa-clipboard"></i>Log</a></li>
    </ul>
</header>
<main>
        <div class="container">
            @yield('content')
            @yield('modals')
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
        </div>
</main>
<script type="text/javascript">
    var baseUrl = "{{ URL::to('/') }}";
    var token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{URL::asset('src/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('src/js/materialize.js')}}"></script>
<script>
    $('.button-collapse').sideNav();
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

<script type="text/javascript">
    $(document).ready(function () {
        $('.modal').modal({
            dismissible: false
        });

        $('.test').click(function () {
            $('#loading_modal').modal('open');
        });
    })
</script>
@yield('scripts')
</body>
</html>