<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('src/font/font-awesome-4.7.0/css/font-awesome.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('src/css/style.css')}}">
    @yield('styles')
</head>

<body class="fixed-sn white-skin " cz-shortcut-listen="true" style="background: #EEEEEE"    >
<header>
    <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar ps-container ps-theme-default" data-ps-id="f73dfefb-8c1f-7c94-8f59-21e765b5ede8" style="transform: translateX(-100%);">
        <!-- Logo -->
        <li>
            <div class="logo-wrapper waves-effect">
                <a href="#"><i class="fa fa-3x ">Asterisk</i> </a>
            </div>
        </li>
        <li>
            <ul class="social">
                <li><a class="icons-sm fb-ic"><i class="fa fa-facebook"> </i></a></li>
                <li><a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a></li>
                <li><a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a></li>
                <li><a class="icons-sm tw-ic"><i class="fa fa-twitter"> </i></a></li>
            </ul>
        </li>

        <!--Search Form>
        <li>
            <form class="search-form" role="search">
                <div class="form-group waves-effect">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
        </li>--
        <!--/.Search Form-->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a href="#" class="collapsible-header waves-effect arrow-r"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
                <li><a href="#" class="collapsible-header waves-effect arrow-r"><i class="fa fa-rocket"></i> Products</a></li>
                <li><a href="#" class="collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Users</a></li>
                <li><a href="#" class="collapsible-header waves-effect arrow-r"><i class="fa fa-clipboard"></i> Log</a></li>


            </ul>
        </li>
        <div class="sidenav-bg mask-strong"></div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></ul>

    <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">

        <div class="float-xs-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
        <div class="breadcrumb-dn mr-auto">
            <p>Asterisk Mobile Shop</p>
        </div>
        <ul class="nav navbar-nav ml-auto flex-row">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item waves-effect waves-light" href="#">Account</a>
                    <a class="dropdown-item waves-effect waves-light" href="{{route('logout')}}">Log Out</a>

                </div>
            </li>
        </ul>
    </nav>
</header>
<main>
    <div class="container-fluid">
        @yield('content')
        @yield('modals')
    </div>
</main>
<script type="text/javascript">
    var baseUrl = "{{ URL::to('/') }}";
    var token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{URL::asset('src/js/script.js')}}"></script>
<script>
    $(".button-collapse").sideNav();

    var el = document.querySelector('.custom-scrollbar');
    Ps.initialize(el);

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
@yield('scripts')
<div class="hiddendiv common"></div><div class="drag-target" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); left: 0px;"></div></body></html>