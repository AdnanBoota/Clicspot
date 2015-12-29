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
                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>
                    </div>
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
            <div class="memberbox">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Members</h3>
                    </div>
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
                        </ul>
                    </div>
                </div>
            </div>
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
                <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script type="text/javascript" src="{{ asset('/plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript">
$(function() {
//      =====================================This is Line Chart===========================================================================
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Item 1'],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });

//     ========================================This is Bar chart==========================================================================
    var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
        ],
        barColors: ['#00a65a', '#f56954'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['CPU', 'DISK'],
        hideHover: 'auto'
    });
//     =====================================This is DONUT CHART===============================================================================
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
        ],
        hideHover: 'auto'
    });
});
</script>
@endpush