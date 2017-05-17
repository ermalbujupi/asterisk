@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('page')
    Dashboard
@endsection


@section('content')
    <div class="col s6 left-align" id="date" style="height:1px;"></div>

    <div class="row">
        <div class="col s6 right-align">
            Hello
        </div>
    </div>

    <div class"row">
        <div class="col-sm-6 text-center">
            <label class="label label-success">Area Chart</label>
            <div id="area-chart" ></div>
        </div>
    </div>


@endsection

@section('modals')

@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('src/js/dashboard.js')}}"></script>

    <script>
        function formatDate(date) {
            var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();
                    hour = d.getHours();


            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        document.getElementById("date").innerHTML = formatDate(new Date());
    </script>
@endsection