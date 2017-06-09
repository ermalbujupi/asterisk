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
                <h4>Users</h4>
                <div class="ct-chart "></div>

            </div>

            <div class="card-panel " >
                <div class="ct-chart2"></div>
                <div class="col-md-12">
                    <h5>Users Added</h5>
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
    <script>
        new Chartist.Line('.ct-chart', {
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
        }, {
            low: 0,
            showArea: true
        });

        new Chartist.Line('.ct-chart2', {
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
@endsection