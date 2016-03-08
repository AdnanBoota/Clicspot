@extends('app')
@push('styles')
<link href="{{ asset('/css/home-page.css') }}" rel='stylesheet' />
<link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">
@endpush
@section('content')
<section class="statistics-box">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-pie-chart"></i><span>{{ Lang::get('auth.statistics') }}</span>
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
                                    <p><span>10</span>{{ Lang::get('auth.dayremaining') }}</p>
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
            <i class="fa fa-fw fa-user"></i><span>{{ Lang::get('auth.routerstatistics') }}</span>
        </div>
    </div>
    <div class="userprofileblock">
        <div class="statisticsBg">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ Lang::get('auth.routerstatus') }} </h3>
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
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ Lang::get('auth.amountconnection') }}</h3>
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
                                <a href="javascript:void(0)" class="btn active getDataby" id="months">{{ Lang::get('auth.month')}}</a>
                                <a href="javascript:void(0)" class="btn getDataby" id="weeks">{{ Lang::get('auth.week') }}</a>
                                <a href="javascript:void(0)" class="btn getDataby" id="days">{{ Lang::get('auth.day') }}</a>
                            </div>
                        </div><!-- /.box -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-user"></i><span>{{ Lang::get('auth.memberstatistics') }}</span>
        </div>
    </div>
    <div class="statisticsBg">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ Lang::get('auth.latestmember') }}</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-danger">8 {{ Lang::get('auth.newmemeber') }}</span>
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
                        <a href="javascript::" class="uppercase">{{ Lang::get('auth.alluser') }}</a>
                    </div><!-- /.box-footer -->
                </div><!--/.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ Lang::get('auth.reviews') }}</h3>
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
                        <a href="javascript:void(0)" class="btn active">{{ Lang::get('auth.month')}}</a>
                        <a href="javascript:void(0)" class="btn">{{ Lang::get('auth.week') }}</a>
                        <a href="javascript:void(0)" class="btn">{{ Lang::get('auth.day') }}</a>
                    </div>
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

//========================================================== Ajax Call for fetch the data for Chart============================================
function getChartAjax(typeOfData, getAllData) {
    jQuery.ajax({
        url: '/routerConnections',
        type: 'post',
        data: {
            "_token": '{{csrf_token()}}',
            "type": typeOfData,
            "AllData": getAllData

        },
        success: function(result) {
            if (result['routerConnection']) {
                monthValueArray.length = 0;
                monthKeyArray.length = 0;
                monthValueArray = [];
                monthKeyArray = [];
                for (var i = 0; i < result['routerConnection'].length; i++) {
                    jQuery.each(result['routerConnection'][i], function(index, value) {
                        monthValueArray.push(value);
                        monthKeyArray.push(index);
                    });
                }
                amountOfConnectionsChart(monthValueArray, monthKeyArray);
            }
            if (result['routerStatus']) {
                var routerData = [];
                for (var i = 0; i < (result['routerStatus'].length); i++) {
                    routerData.push({label: result['routerStatus'][i].label, value: result['routerStatus'][i].value});
                }
                routerStatusChart(routerData);
            }

        }
    });
}

//========================================================== Donut chart for Router Status====================================================
function routerStatusChart(myVal) {
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: myVal,
        hideHover: 'auto'
    });
}

//========================================================== Bar chart for Customer Reviews============================================
function customerReviews() {
    var barAreaChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Reviews",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "FeedBack",
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
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true,
        maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
}

//========================================================== Line chart for Amount of router Connections=======================================
function amountOfConnectionsChart(myArrayValue, myArrayKey) {
   
        var areaChartData = {
        labels: myArrayKey,
        datasets: [
            {
                label: "Amount Of Connections",
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
    var areaChartOptions = {
        showScale: true,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        scaleOverride: true,
        scaleSteps: 6,
        scaleStepWidth: 50,
        // Number - The scale starting value
        scaleStartValue: 0,
        bezierCurve: true,
        bezierCurveTension: 0.3,
        pointDot: true,
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
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);
}
</script>
<script type="text/javascript">
    var chartOfData = "months";
    var getData = "all";
    $(document).ready(function() {
        getChartAjax(chartOfData, getData);
        customerReviews();
        $(document).on("click", ".getDataby", function() {
            getData = "";
            $(".reviewButtons").find(".active").removeClass("active");
            $(this).addClass("active");
            $("#lineChart").remove();
            $('.lineChart').append('<canvas id="lineChart"><canvas>');
            chartOfData = $(this).attr("id");
            getChartAjax(chartOfData);
        });
    });
</script>
@endpush