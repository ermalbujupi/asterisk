@extends('layouts.master')

@section('title')
    Asterisk Mobile Shop
@endsection

@section('styles')
@endsection

@section('content')
    <div class="card card-cascade narrower">

        <!--Admin panel-->
        <div class="admin-panel">

            <!--First row-->
            <div class="row m-b-0">

                <!--First column-->
                <div class="col-md-5">

                    <!--Panel title-->
                    <div class="view left primary-color">
                        <h2 class="white-text">Sales</h2>
                    </div>
                    <!--/Panel title-->

                    <!--Panel data-->
                    <div class="row card-block pt-3">

                        <!--First column-->
                        <div class="col-md-6">

                            <!--Date select-->
                            <h4><span class="badge big-badge primary-color">Data range</span></h4>
                            <div class="select-wrapper mdb-select colorful-select dropdown-primary"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-15293108-0437-b61b-7fc0-0ecbe0e69ae5" value="Choose time period"><ul id="select-options-15293108-0437-b61b-7fc0-0ecbe0e69ae5" class="dropdown-content select-dropdown "><li class="disabled "><span>Choose time period</span></li><li class=""><span>Today</span></li><li class=""><span>Yesterday</span></li><li class=""><span>Last 7 days</span></li><li class=""><span>Last 30 days</span></li><li class=""><span>Last week</span></li><li class=""><span>Last month</span></li></ul><select class="mdb-select colorful-select dropdown-primary initialized">
                                    <option value="" disabled="" selected="">Choose time period</option>
                                    <option value="1">Today</option>
                                    <option value="2">Yesterday</option>
                                    <option value="3">Last 7 days</option>
                                    <option value="3">Last 30 days</option>
                                    <option value="3">Last week</option>
                                    <option value="3">Last month</option>
                                </select></div>
                            <br>

                            <!--Date pickers-->
                            <h4><span class="badge big-badge primary-color">Custom date</span></h4>
                            <br>
                            <div class="md-form">
                                <input placeholder="Selected date" type="text" id="from" class="form-control datepicker picker__input" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="from_root"><div class="picker" id="from_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__date-display"><div class="picker__weekday-display">Friday</div><div class="picker__month-display"><div>Apr</div></div><div class="picker__day-display"><div>07</div></div><div class="picker__year-display"><div>2017</div></div></div><select class="picker__select--year" disabled="" aria-controls="from_table" title="Select a year"><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017" selected="">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option></select><select class="picker__select--month" disabled="" aria-controls="from_table" title="Select a month"><option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3" selected="">April</option><option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option><option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option></select><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="from_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="from_table" title="Next month"> </div></div><table class="picker__table" id="from_table" role="grid" aria-controls="from" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490482800000" role="gridcell" aria-label="26 March, 2017">26</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490565600000" role="gridcell" aria-label="27 March, 2017">27</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490652000000" role="gridcell" aria-label="28 March, 2017">28</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490738400000" role="gridcell" aria-label="29 March, 2017">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490824800000" role="gridcell" aria-label="30 March, 2017">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490911200000" role="gridcell" aria-label="31 March, 2017">31</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1490997600000" role="gridcell" aria-label="1 April, 2017">1</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491084000000" role="gridcell" aria-label="2 April, 2017">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491170400000" role="gridcell" aria-label="3 April, 2017">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491256800000" role="gridcell" aria-label="4 April, 2017">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491343200000" role="gridcell" aria-label="5 April, 2017">5</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491429600000" role="gridcell" aria-label="6 April, 2017">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted" data-pick="1491516000000" role="gridcell" aria-label="7 April, 2017" aria-activedescendant="true">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491602400000" role="gridcell" aria-label="8 April, 2017">8</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491688800000" role="gridcell" aria-label="9 April, 2017">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491775200000" role="gridcell" aria-label="10 April, 2017">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491861600000" role="gridcell" aria-label="11 April, 2017">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491948000000" role="gridcell" aria-label="12 April, 2017">12</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492034400000" role="gridcell" aria-label="13 April, 2017">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492120800000" role="gridcell" aria-label="14 April, 2017">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492207200000" role="gridcell" aria-label="15 April, 2017">15</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492293600000" role="gridcell" aria-label="16 April, 2017">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492380000000" role="gridcell" aria-label="17 April, 2017">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492466400000" role="gridcell" aria-label="18 April, 2017">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492552800000" role="gridcell" aria-label="19 April, 2017">19</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492639200000" role="gridcell" aria-label="20 April, 2017">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492725600000" role="gridcell" aria-label="21 April, 2017">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492812000000" role="gridcell" aria-label="22 April, 2017">22</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492898400000" role="gridcell" aria-label="23 April, 2017">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492984800000" role="gridcell" aria-label="24 April, 2017">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493071200000" role="gridcell" aria-label="25 April, 2017">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493157600000" role="gridcell" aria-label="26 April, 2017">26</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493244000000" role="gridcell" aria-label="27 April, 2017">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493330400000" role="gridcell" aria-label="28 April, 2017">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493416800000" role="gridcell" aria-label="29 April, 2017">29</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493503200000" role="gridcell" aria-label="30 April, 2017">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493589600000" role="gridcell" aria-label="1 May, 2017">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493676000000" role="gridcell" aria-label="2 May, 2017">2</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493762400000" role="gridcell" aria-label="3 May, 2017">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493848800000" role="gridcell" aria-label="4 May, 2017">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493935200000" role="gridcell" aria-label="5 May, 2017">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1494021600000" role="gridcell" aria-label="6 May, 2017">6</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1491516000000" disabled="" aria-controls="from">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="from">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="from">Close</button></div></div></div></div></div></div>
                                <label for="date-picker-example" class="active">From</label>
                            </div>
                            <div class="md-form">
                                <input placeholder="Selected date" type="text" id="to" class="form-control datepicker picker__input" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="to_root"><div class="picker" id="to_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__date-display"><div class="picker__weekday-display">Friday</div><div class="picker__month-display"><div>Apr</div></div><div class="picker__day-display"><div>07</div></div><div class="picker__year-display"><div>2017</div></div></div><select class="picker__select--year" disabled="" aria-controls="to_table" title="Select a year"><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017" selected="">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option></select><select class="picker__select--month" disabled="" aria-controls="to_table" title="Select a month"><option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3" selected="">April</option><option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option><option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option></select><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="to_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="to_table" title="Next month"> </div></div><table class="picker__table" id="to_table" role="grid" aria-controls="to" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490482800000" role="gridcell" aria-label="26 March, 2017">26</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490565600000" role="gridcell" aria-label="27 March, 2017">27</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490652000000" role="gridcell" aria-label="28 March, 2017">28</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490738400000" role="gridcell" aria-label="29 March, 2017">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490824800000" role="gridcell" aria-label="30 March, 2017">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1490911200000" role="gridcell" aria-label="31 March, 2017">31</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1490997600000" role="gridcell" aria-label="1 April, 2017">1</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491084000000" role="gridcell" aria-label="2 April, 2017">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491170400000" role="gridcell" aria-label="3 April, 2017">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491256800000" role="gridcell" aria-label="4 April, 2017">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491343200000" role="gridcell" aria-label="5 April, 2017">5</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491429600000" role="gridcell" aria-label="6 April, 2017">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted" data-pick="1491516000000" role="gridcell" aria-label="7 April, 2017" aria-activedescendant="true">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491602400000" role="gridcell" aria-label="8 April, 2017">8</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491688800000" role="gridcell" aria-label="9 April, 2017">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491775200000" role="gridcell" aria-label="10 April, 2017">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491861600000" role="gridcell" aria-label="11 April, 2017">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1491948000000" role="gridcell" aria-label="12 April, 2017">12</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492034400000" role="gridcell" aria-label="13 April, 2017">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492120800000" role="gridcell" aria-label="14 April, 2017">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492207200000" role="gridcell" aria-label="15 April, 2017">15</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492293600000" role="gridcell" aria-label="16 April, 2017">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492380000000" role="gridcell" aria-label="17 April, 2017">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492466400000" role="gridcell" aria-label="18 April, 2017">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492552800000" role="gridcell" aria-label="19 April, 2017">19</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492639200000" role="gridcell" aria-label="20 April, 2017">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492725600000" role="gridcell" aria-label="21 April, 2017">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492812000000" role="gridcell" aria-label="22 April, 2017">22</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492898400000" role="gridcell" aria-label="23 April, 2017">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1492984800000" role="gridcell" aria-label="24 April, 2017">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493071200000" role="gridcell" aria-label="25 April, 2017">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493157600000" role="gridcell" aria-label="26 April, 2017">26</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493244000000" role="gridcell" aria-label="27 April, 2017">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493330400000" role="gridcell" aria-label="28 April, 2017">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493416800000" role="gridcell" aria-label="29 April, 2017">29</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1493503200000" role="gridcell" aria-label="30 April, 2017">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493589600000" role="gridcell" aria-label="1 May, 2017">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493676000000" role="gridcell" aria-label="2 May, 2017">2</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493762400000" role="gridcell" aria-label="3 May, 2017">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493848800000" role="gridcell" aria-label="4 May, 2017">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1493935200000" role="gridcell" aria-label="5 May, 2017">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1494021600000" role="gridcell" aria-label="6 May, 2017">6</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1491516000000" disabled="" aria-controls="to">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="to">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="to">Close</button></div></div></div></div></div></div>
                                <label for="date-picker-example" class="active">To</label>
                            </div>

                        </div>
                        <!--/First column-->

                        <!--Second column-->
                        <div class="col-md-6 text-center">

                            <!--Summary-->
                            <p>Total sales: <strong>2000$</strong> <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Total sales in the given period"><i class="fa fa-question"></i></button></p>
                            <p>Average sales: <strong>100$</strong> <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Average daily sales in the given period"><i class="fa fa-question"></i></button></p>

                            <!--Change chart-->
                            <span class="min-chart" id="chart-sales" data-percent="76"><span class="percent">76</span><canvas height="110" width="110"></canvas></span>
                            <h5><span class="badge green">Change <i class="fa fa-arrow-circle-up"></i></span><button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Percentage change compared to the same period in the past"><i class="fa fa-question"></i></button></h5>
                        </div>
                        <!--/Second column-->

                    </div>
                    <!--/Panel data-->
                </div>
                <!--/First column-->

                <!--Second column-->
                <div class="col-md-7">
                    <!--Cascading element-->
                    <div class="view right primary-color">
                        <!--Main chart-->
                        <canvas id="sales" height="262" width="508" style="width: 636px; height: 328px;"></canvas>
                    </div>
                    <!--/Cascading element-->
                </div>
                <!--/Second column-->

            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row mb-0">
                <!--First column-->
                <div class="col-md-12">

                    <!--Panel content-->
                    <div class="card-block pt-0">

                        <div class="table-responsive">

                            <!--Table-->
                            <table class="table table-hover">
                                <!--Table head-->
                                <thead>
                                <tr class="primary-color">
                                    <th>Campaign name</th>
                                    <th>Source</th>
                                    <th>Conversion rate</th>
                                    <th>Invested</th>
                                </tr>
                                </thead>
                                <!--/Table head-->

                                <!--Table body-->
                                <tbody>
                                <tr class="none-top-border">
                                    <td>Newsletter</td>
                                    <td>Newsletter</td>
                                    <td>5%</td>
                                    <td>100$</td>
                                </tr>
                                <tr>
                                    <td>Facebook</td>
                                    <td>Facebook</td>
                                    <td>5%</td>
                                    <td>100$</td>
                                </tr>
                                <tr>
                                    <td>Adwords</td>
                                    <td>Adwords</td>
                                    <td>5%</td>
                                    <td>100$</td>
                                </tr>
                                <tr>
                                    <td>Sponsored post</td>
                                    <td>Sponsored post</td>
                                    <td>5%</td>
                                    <td>100$</td>
                                </tr>
                                <tr>
                                    <td>Newsletter 2</td>
                                    <td>Newsletter 2</td>
                                    <td>5%</td>
                                    <td>100$</td>
                                </tr>
                                </tbody>
                                <!--/Table body-->
                            </table>
                            <!--/Table-->

                        </div>

                    </div>
                    <!--/.Panel content-->

                </div>
                <!--/First column-->
            </div>
            <!--/Second row-->

        </div>
        <!--/Admin panel-->

    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
    <script type="text/javascript">

        $(function() {
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(0,0,0,.15)",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: "#4CAF50"
                }, {
                    label: "My Second dataset",
                    fillColor: "rgba(255,255,255,.25)",
                    strokeColor: "rgba(255,255,255,.75)",
                    pointColor: "#fff",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(0,0,0,.15)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }]
            };


            var dataPie = [{
                value: 300,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            }, {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            }, {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            }]

            var option = {
                responsive: true,
                // set font color
                scaleFontColor: "#fff",
                // font family
                defaultFontFamily: "'Roboto', sans-serif",
                // background grid lines color
                scaleGridLineColor: "rgba(255,255,255,.1)",
                // hide vertical lines
                scaleShowVerticalLines: false,
            };

            // Get the context of the canvas element we want to select
            var ctx = document.getElementById("sales").getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, option); //'Line' defines type of the chart.
        });

    </script>
@endsection