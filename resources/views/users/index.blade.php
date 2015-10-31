@extends('app')
@push('styles')
<link href="{{ asset('/css/email-list.css') }}" rel='stylesheet' />
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
<section class="statistics-box">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-pie-chart"></i><span>Statistics</span>

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
                            <h2>{{$facebookCount}}</h2>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa  fa-google-plus"></i></span>
                            <img src="img/user-icon.png" alt="" class="user-icon">
                            <h2>{{$googleCount}}</h2>
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                            <img src="img/user-icon.png" alt="" class="user-icon">
                            <h2>{{$emailCount}}</h2>
                            
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-green">
                            <span class="info-box-icon">
                                <img src="img/voicemail-icon.png" alt="">
                            </span>
                            <img src="img/speech.png" alt="" class="user-icon">
                            <h2>10</h2>
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
                            <h3>1327</h3>
                            <span>/ 1500</span>
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
                <!-- /.info-box -->
            </div>
        </div>
    </div>
</section>
<section class="statistics-box">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw  fa-list-alt"></i><span>Manage Lists</span>

        </div>
    </div>
    <div class="box box-widget p30">
        <div class="row">

            <div class="manage-list">
                <ul>
                    <li>
                        <a href="">
                            <div class="slist">
                                <img src="img/select-list.png" alt="">
                            </div>
                            <div class="list-title">
                                <span>Select List</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div class="slist">
                                <img src="img/create-list.png" alt="">
                            </div>
                            <div class="list-title">
                                <span>Creat List</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div class="slist">
                                <img src="img/edit-list.png" alt="">
                            </div>
                            <div class="list-title">
                                <span>Edit List</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div class="slist">
                                <img src="img/export-list.png" alt="">
                            </div>
                            <div class="list-title">
                                <span>Export List</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>
<!--<section>
    <div class="row">
        <div class="statistics user-list">
            <img src="img/user-icon-black.png" alt="" class="user-icon-black"></i><span>User Lists</span>

        </div>
    </div>
     <div class="box box-widget">
             /.box-header 
            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive" id="user-table" width="100%">
                    <thead>
                        <tr>
                            <th>Favored Connection</th>
                            <th>Visitor</th>
                            <th>Amount of Visits</th>
                            <th>Last Visit</th>
                            <th>Campaign</th>
                            <th>Review Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
             /.box-body 
        </div>
</section>-->
<!-- Main content -->

@endsection

@push('scripts')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>

$(function () {
//    oTable = $('#user-table').DataTable({
//        processing: true,
//        serverSide: true,
//        responsive: true,
//        ajax: 'users',
//        columns: [
//            {data: 'name', name: 'name'},
//            {data: 'backgroundimage', name: 'backgroundimage', orderable: false, searchable: false},
//            {data: 'logoimage', name: 'logoimage', orderable: false, searchable: false},
//            {data: 'fontcolor', name: 'fontcolor', orderable: false, searchable: false},
//            {data: 'edit', name: 'edit', orderable: false, searchable: false},
//            {data: 'delete', name: 'delete', orderable: false, searchable: false}
//        ]
//    });



});
</script>

@endpush