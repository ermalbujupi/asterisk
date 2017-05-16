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

<div class="row">

        <div class="col s6 m6 lg6">

            <div class="card-panel large ">


                <div class="card-content">
                    <div class="col-md-12">
                        <div id="myfirstchart"></div>
                    </div>
                    <div class="col-md-12">
                        <h5 style="margin-left: 15px;">Sales</h5>
                        <!--<form action="{{route('getsize',['year'=>2017,'month'=>4])}}">-->
                            <button type="submit"  id="button1" >Get</button>
                        <!--</form>-->

                    </div>
                </div>


            </div>

        </div>


</div>
@endsection

@section('modals')

@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('src/js/dashboard.js')}}"></script>
@endsection