@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <style>
        #card1{
            max-height: 400px;
        }
    </style>
@endsection

@section('page')
    Dashboard
@endsection


@section('content')
<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <div class="card-panel ">

                <div class="ct-chart"></div>
                <div class="col-md-12">
                    <h5>Products Added</h5>
                </div>
            </div>

            <div class="card-panel " >
                <div class="ct-chart2"></div>
                <div class="col-md-12">
                    <h5>Products Added</h5>
                </div>
            </div>

            <div class="card-panel " >
                <div class="ct-chart2"></div>
                <div class="col-md-12">
                    <h5>Products Added</h5>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@section('modals')

@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

    <script type="text/javascript" src="{{URL::asset('src/js/dashboard.js')}}"></script>
@endsection