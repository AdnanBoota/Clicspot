@extends('app')
@push('styles')
<link href="{{ asset('/css/email-list.css') }}" rel='stylesheet' />
<!-- Raty plugin me@diegopucci.com pucci_diego -->
<link href="{{ asset('/plugins/raty/jquery.raty.css') }}" rel='stylesheet' />
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>-->
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
        </div>
    </div>
    @if(Session::has('deleteEmailList'))
        <div class="alert alert-success">
            <li>{{ Session::get('deleteEmailList') }}</li>
        </div>
    @endif
    @if(Session::has('deleteEmailListError'))
        <div class="alert alert-danger">
            <li>{{ Session::get('deleteEmailListError') }}</li>
        </div>
    @endif

    <section class="statistics-box">
        <div class="row">
            <div class="statistics">
                <i class="fa fa-fw fa-pie-chart"></i><span>{{ Lang::get('auth.statistics') }}</span>

            </div>
        </div>
        <div class="box box-widget p30">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon"><i class="fa fa-facebook"></i></span>
                                <img src="img/user-icon.png" alt="" class="user-icon">
                                <h2 class="fbCount" >{{$facebookCount}}</h2>
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa  fa-google-plus"></i></span>
                                <img src="img/user-icon.png" alt="" class="user-icon">
                                <h2 class="gCount">{{$googleCount}}</h2>
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                                <img src="img/user-icon.png" alt="" class="user-icon">
                                <h2 class="eCount">{{$emailCount}}</h2>

                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-green">
                            <span class="info-box-icon">
                                <img src="img/voicemail-icon.png" alt="voice-mail">
                            </span>
                                <img src="img/speech.png" alt="speech" class="user-icon">
                                <h2>0</h2>
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mailinfo">
                    <div class="info-box bgteal">
                    <span class="info-box-icon">
                        <img src="img/pin.png" alt="">
                    </span>
                        <div class="mail-info">
                            <div class="mail-detail">
                                <h3>5000</h3>
                                <span>/ 5000</span>
                                <img src="img/mail-icon.png" alt="" class="mail-icon">
                            </div>
                            <div class="progress">
                                <div style="width: 70%" class="progress-bar"></div>
                            </div>
                            <div class="remain-title">
                                <p><span>30</span>{{ Lang::get('auth.dayremaining') }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
    </section>
    <section class="statistics-box">
        <div class="row">
            <div class="statistics">
                <i class="fa fa-fw  fa-list-alt"></i><span>{{ Lang::get('auth.managelist') }}</span>

            </div>
        </div>
        <div class="box box-widget p30">
            <div class="row">

                <div class="manage-list">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <div class="slist">
                                    <img src="img/select-list.png" alt="">
                                </div>
                                <div class="list-title">
                                    <span>{{ Lang::get('auth.selectlist') }}</span>
                                </div>
                            </a>
                            @if (count($emailList) > 0)
                                <div class="selectlistblock select-list">
                                    @foreach ($emailList as $list)
                                        <a href="javascript:void(0);" class="{{ (Session::has('listId') AND Session::get('listId') == $list->id) ? 'active':'' }}" data-token="{{csrf_token()}}" val="{{$list->id}}">{{ $list->listname }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                        <li>
                            <a href="{{url('emailList/create')}}">
                                <div class="slist">
                                    <img src="img/create-list.png" alt="">
                                </div>
                                <div class="list-title">
                                    <span>{{ Lang::get('auth.createlist') }}</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="slist">
                                    <img src="img/edit-list.png" alt="">
                                </div>
                                <div class="list-title">
                                    <span>{{ Lang::get('auth.editlist') }}</span>
                                </div>
                            </a>
                            @if (count($emailList) > 0)
                                <div class="selectlistblock">
                                    @foreach ($emailList as $list)
                                        <a href="{{url('emailList/'.$list->id.'/edit')}}">{{ $list->listname }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                        <li>
                            <a href="">
                                <div class="slist">
                                    <img src="img/export-list.png" alt="">
                                </div>
                                <div class="list-title">
                                    <span>{{ Lang::get('auth.exportlist') }}</span>
                                </div>
                            </a>
                            <div class="selectlistblock expList">
                                <a href="javascript:void(0);" val='csv' style="font-size: 14px">{{ Lang::get('auth.dlcsv') }}</a>
                                <a href="javascript:void(0);" val='xls' >{{ Lang::get('auth.dlxls') }}</a>
                                <a href="javascript:void(0);" val='txt' >{{ Lang::get('auth.dltxt') }}</a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="statistics user-list">
                <img src="img/user-icon-black.png" alt="" class="user-icon-black"></i><span>{{ Lang::get('auth.userlist') }}</span>

            </div>
        </div>
        <div class="box box-widget">
            <!--             /.box-header -->
            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive" id="user-table" width="100%">
                    <thead>
                    <tr>
                        <th>{{ Lang::get('auth.favconn') }}</th>
                        <th>{{ Lang::get('auth.visitor') }}</th>
                        <th>{{ Lang::get('auth.amountvisit') }}</th>
                        <th>{{ Lang::get('auth.lastvisit') }}</th>
                        <th>{{ Lang::get('auth.campaignn') }}</th>
                        <th>{{ Lang::get('auth.reviewstatus') }}</th>
                        <th>{{ Lang::get('auth.lang') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!--/.box-body-->
        </div>
    </section>
    <!-- Main content -->

@endsection

@push('scripts')
<!-- Raty plugin me@diegopucci.com pucci_diego -->
<script type="text/javascript" src="{{ asset('/plugins/raty/jquery.raty.js') }}"></script>
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>
    $(function () {
        var oTable = $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                "url": 'users',
                "data": function (d) {
                    var listVal = $('.select-list a.active').attr('val');
                    if (listVal)
                        d.listVal = listVal;
                }
            },
            columns: [
                {data: 'favoredconnection', name: 'favoredconnection', orderable: false, searchable: false},
                {data: 'visitor', name: 'visitor', orderable: false, searchable: false},
                {data: 'amountofvisit', name: 'amountofvisit', orderable: false, searchable: true},
                {data: 'lastvisit', name: 'lastvisit', orderable: true, searchable: false},
                {data: 'campaign', name: 'campaign', orderable: false, searchable: false},
                {data: 'review', name: 'review', orderable: false, searchable: false},
                {data: 'language', name: 'language', orderable: false, searchable: false}
            ],
            "drawCallback": function (settings) {
                $(".raty").raty({
                    readOnly: true,
                    score: function () {
                        return $(this).attr('data-score');
                    }
                });
            }
        });

        $('.select-list a').on('click',function(){
            $('.select-list a').removeClass('active');
            var myVal = $(this).attr('val');
            $(this).addClass('active');
            oTable.draw();
            var token = $(this).attr('data-token');
            jQuery.ajax({
                url: 'users/getStatistics/' + myVal+'/selList',
                type: 'POST',
                data: {
                    "_token": token
                },
                success: function (result) {
                    if (result) {
                        $('.fbCount').text(result.fbCount);
                        $('.gCount').text(result.gCount);
                        $('.eCount').text(result.eCount);

                    } else {

                    }

                }
            });
        });

        $('.expList a').on('click',function(){
            var myVal = $(this).attr('val');
            var listVal = $('.select-list a.active').attr('val');

            if(listVal){
                window.location.href = '/users/exportUsers/' + listVal+'/'+ myVal;
                return false;
            }else{
                return false;
            }
        });



    });
</script>
@endpush