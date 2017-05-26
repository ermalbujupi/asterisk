<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('src/font-awesome-4.7.0/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{URL::asset('src/css/materialize.css')}}">
    <link rel="stylesheet" href="{{URL::asset('src/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('src/material-icons/iconfont/material-icons.css')}}">

    @yield('styles')
</head>

<body cz-shortcut-listen="true">
<header>
    <nav class="top-nav light-blue darken-4">
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="fa fa-bars"></i></a>
        <div class="nav-wrapper ">
                <ul id="dropdown1" class="dropdown-content">
                   <!-- <li><a href="#!">Account</a></li>-->
                    <li><a href="#change_password_modal">Change Password</a></li>
                    <li><a href="{{route('logout')}}">Log Out</a></li>
                </ul>
                <h4 class="brand-logo center">@yield('page')</h4>

                <ul class="right user-menu">
                    <li><i class="fa fa-user fa-fw dropdown-button" href='#' data-activates='dropdown1'></i></li>
                    <li><i class="fa fa-caret-down dropdown-button"  data-activates='dropdown1'></i></li>
                </ul>
            </div>
    </nav>
    <div class="container"></div>
    <ul id="nav-mobile" class="side-nav fixed blue-grey lighten-5" style="transform: translateX(0%);">

        <img src="{{ URL::asset('src/img/asteriskLogo1.png') }}">
        <li class="bold {{Request::is('/') ? 'active':''}}"><a href="{{route('index')}}" class="waves-effect waves-teal"><i class="fa fa-bar-chart menu-item"></i>Dashboard  </a></li>
        <li class="bold {{Request::is('stock') ? 'active':''}}"><a href="{{route('stock')}}" class="waves-effect waves-teal"><i class="fa fa-rocket"></i>Products</a></li>
        <li class="bold {{Request::is('users') ? 'active':''}}"><a href="{{route('users')}}" class="waves-effect waves-teal"><i class="fa fa-users"></i>Users</a></li>
        <li class="bold {{Request::is('todo') ? 'active':''}}"><a href="{{route('todo')}}" class="waves-effect waves-teal"><i class="fa fa-tasks"></i>To Do List</a></li>
        <li class="bold {{Request::is('categories_brands') ? 'active':''}} "><a href="{{route('categories_brands')}}" class="waves-effect waves-teal"><i class="fa fa-apple"></i>Categories & Brands</a></li>
        <li class="bold {{Request::is('sellings') ? 'active':''}}"><a href="{{route('sellings')}}"><i class="fa fa-eur" aria-hidden="true"></i>Sales</a></li>
        <li class="bold {{Request::is('log') ? 'active':''}}"><a href="#" class="waves-effect waves-teal"><i class="fa fa-clipboard"></i>Log</a></li>
    </ul>
</header>
<main>
        <div class="container">

            @yield('content')
            <div class="right-align">
                <a href="#sellProductModal" id="sell" class="waves-effect waves-light btn light-blue darken-4 ">Sell</a>
            </div>

            <!--/Sell Product Modal -->
            <div id="sellProductModal" class="modal modal-sm modal-fixed-footer">

                <div class="modal-content">
                    <h4>Sell Products</h4>
                    <div class="col s12"><br></div>
                    <div class="row">

                        <div class="card-panel large">
                            <div class="col s4">
                                <input type="text" id="autocomplete-input"  class="autocomplete " placeholder="Search for a product">
                            </div>
                            <div class="col s2">
                                <input type="text"   id="price" placeholder="Price">
                            </div>
                            <div class="col s2">
                                <input type="text"   id="price" placeholder="Quantity">
                            </div>
                            <h1></h1>

                        </div>

                        <div class="card-panel large">
                            <h5><b>Products to Sell</b></h5>
                            <table  id="sell_table" border="1" class="bordered  stock_table">

                                <thead>
                                <tr class="primary-color">
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="stock_body">
                                <tr class="none-top-border">

                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col s12">
                            <div class="right-align">
                                <h6><b>TOTAL VALUE:</b><span id="total"></span>&euro;</h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="submit" id="sell_product" href="#!" class="modal-action waves-effect light-blue darken-4 btn ">Sell</button>
                    <a id="close_sell" class="modal-action modal-close waves-effect red darken-4 btn">Cancel</a>
                </div>
            </div>

            @yield('modals')

            <div id="change_password_modal" class="modal">
              <div  class="col s12">
                  <div class="modal-content">
                    <h4>Change Password</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label>Actual Password:</label>
                            <input name="email" type="password" placeholder="" id="actual_password"/>
                        </div>
                        <div class="input-field col s12">
                            <label>New Password:</label>
                            <input placeholder="" name="email" type="password" id="new_password"/>
                        </div>
                        <div class="input-field col s12">
                            <label>Repeat New Password:</label>
                            <input placeholder="" name="email" type="password" id="repeat_new_password"/>
                            <span id="alert_password_error">Password doesn't match<i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>

                  </div>
                    <div class="modal-footer">
                      <button  type="submit" id="submit" href="#!" class="modal-action  waves-effect waves-green btn ">Submit</button>
                      <a  class="modal-action modal-close waves-effect waves-light btn">Close</a>
                    </div>
                </div>
            </div>

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
    })
</script>
<script type="text/javascript">
  $(function(){

    $('#repeat_new_password').on('keyup',function(){

       var repeatPassword = $(this).val();
       var password = $('#new_password').val();


       if(repeatPassword != password){
          $('#alert_password_error').show();
       }else{
         $('#alert_password_error').hide();
       }

    });

      $('#submit').on('click',function(){

          var actual_password = $('#actual_password').val();
          var password = $('#repeat_new_password').val();
          //   ajax("POST","/stock/delete_product","id="+this.value,productDeleted,"");
          ajax('POST','/user/change_password','password='+password+'&actual_password='+actual_password,passwordChanged,"");
          //# sourceURL=password_change.js
      });

    });

function passwordChanged(params,success,responseObj){

    if(success){
        Materialize.toast(responseObj.message,4000,'green');
    }else{
        Materialize.toast(responseObj.message,4000,'red');
    }
}

</script>
<script type="text/javascript" src="{{URL::asset('src/js/index.js')}}"></script>
@yield('scripts')
</body>
</html>
