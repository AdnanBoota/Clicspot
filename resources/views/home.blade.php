@extends('app')
@push('styles')
<link href="{{ asset('/css/home-page.css') }}" rel='stylesheet' />
<link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">
@endpush
@section('content')
<section class="statistics-box">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-pie-chart"></i><span>Statistics</span>
        </div>
    </div>
    <div class="box box-widget p30">
        <div class="row">
            <div class="col-md-12">
                <div class="row staticblock">
                    <div class="col-md-3">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-facebook"></i></span>
                            <img src="img/user-icon.png" alt="" class="user-icon">
                            <h2 class="fbCount" >{{$facebookCount}}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa  fa-google-plus"></i></span>
                            <img src="img/user-icon.png" alt="" class="user-icon">
                            <h2 class="gCount">{{$googleCount}}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                            <img src="img/user-icon.png" alt="" class="user-icon">
                            <h2 class="eCount">{{$emailCount}}</h2>
                        </div>
                    </div>
                    <div class="col-md-3 mailinfo">
                        <div class="info-box bgteal">
                            <span class="info-box-icon">
                                <img src="img/pin.png" alt="">
                            </span>
                            <div class="mail-info">
                                <div class="mail-detail">
                                    <h3>1327</h3>
                                    <sub>/ 1500</sub>
                                    <img src="img/mail-icon.png" alt="" class="mail-icon">
                                </div>
                                <div class="progress">
                                    <div style="width: 70%" class="progress-bar"></div>
                                </div>
                                <div class="remain-title">
                                    <p><span>10</span>Days Remaining</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="profilepart">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-user"></i><span>Router Statistics</span>
        </div>
    </div>
    <div class="userprofileblock">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Router Status</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="memberbox">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Amount of connections</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart lineChart">
                                <canvas id="lineChart" style="height:250px"></canvas>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="reviewButtons">
                            <a href="javascript:void(0)" class="btn active getDataby" id="months">Months</a>
                            <a href="javascript:void(0)" class="btn getDataby" id="weeks">Weeks</a>
                            <a href="javascript:void(0)" class="btn getDataby" id="days">Days</a>
                        </div>
                    </div><!-- /.box -->

                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-user"></i><span>Member Statistics</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Members</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">8 New Members</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        @if (count($getLatestUsers) > 0)
                        @foreach ($getLatestUsers as $latestUser)
                        <li>
                            @if($latestUser->avatar!='')
                            <img alt="User Image" src="{{$latestUser->avatar}}">
                            @else
                            @if($latestUser->gender=='male')
                            <img src="{{ asset("img/male.png") }}" />
                            @else
                            <img src="{{ asset("img/female.png") }}" />
                            @endif
                            @endif
                            <a href="#" class="users-list-name">{{$latestUser->name}}</a>
                            <span class="users-list-date">{{ $latestUser->joinDate }}</span>
                        </li>
                        @endforeach
                        @endif
                    </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript::" class="uppercase">View All Users</a>
                </div><!-- /.box-footer -->
            </div><!--/.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Reviews</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart barChart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div><!-- /.box-body -->
                <div class="reviewButtons">
                    <a href="javascript:void(0)" class="btn active">Months</a>
                    <a href="javascript:void(0)" class="btn">Weeks</a>
                    <a href="javascript:void(0)" class="btn">Days</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script type="text/javascript" src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/morris/morris.js') }}"></script>
<script type="text/javascript">
var monthValueArray = [];
var monthKeyArray = [];
function getChartAjax(typeOfData) {

    jQuery.ajax({
        url: '/routerConnections',
        type: 'post',
        data: {
            "_token": '{{csrf_token()}}',
            "type": typeOfData

        },
        success: function(result) {
            monthValueArray.length = 0;
            monthKeyArray.length = 0;
            monthValueArray = [];
            monthKeyArray = [];
            for (var i = 0; i < result.length; i++) {
                jQuery.each(result[i], function(index, value) {
                    monthValueArray.push(value);
                    monthKeyArray.push(index);
                });
            }
            printChart(monthValueArray, monthKeyArray);
        }
    });
}
function donutChart(myVal) {
    console.log(myVal);
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: myVal,
        hideHover: 'auto'
    });
}

function barChart() {
    var barAreaChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Electronics",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Digital Goods",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = barAreaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
}
function printChart(myArrayValue, myArrayKey) {
//============================================ This is ChartData from Where Chart is initialize================================================
    var areaChartData = {
        labels: myArrayKey,
        datasets: [
            {
                label: "Electronics",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: myArrayValue
            }
        ]
    };
//============================================ This is ChartArea from Where Chart Options generated================================================
    var areaChartOptions = {
        showScale: true,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve: true,
        bezierCurveTension: 0.3,
        pointDot: false,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        maintainAspectRatio: true,
        responsive: true
    };

//=================================================Line Chart Starts===========================================================================   
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);

    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);
}
//=================================================Line Chart Ends=============================================================================
</script>
<script type="text/javascript">
    var chartOfData = "months";
    $(document).ready(function() {
        getChartAjax(chartOfData);
        barChart();
        $(document).on("click", ".getDataby", function() {
            $(".reviewButtons").find(".active").removeClass("active");
            $(this).addClass("active");
            $("#lineChart").remove();
            $('.lineChart').append('<canvas id="lineChart"><canvas>');
            chartOfData = $(this).attr("id");
            getChartAjax(chartOfData);
        });
        setTimeout(function() {
            jQuery.ajax({
                url: '/routerStatus',
                type: 'post',
                data: {
                    "_token": '{{csrf_token()}}'
                },
                success: function(data) {
                    var routerData = [];
                    for (var i = 0; i < (data.length); i++) {
                        routerData.push({label: data[i].label, value: data[i].value});
                    }
                    donutChart(routerData);
                }
            });
        }, 1000);
    });
</script>
@endpush