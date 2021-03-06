@extends('app')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ Lang::get('auth.hotspot') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.hotspot') }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ Lang::get('auth.hotspot') }} {{ Lang::get('auth.list') }}</h3>
                    <a href="{{url('hotspot/create')}}" class="btn btn-info pull-right">{{ Lang::get('auth.addhotspot') }} </a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive" id="hotspot-table" width="100%">
                        <thead>
                        <tr>
                            <th>{{ Lang::get('auth.name') }}</th>
                            <th>{{ Lang::get('auth.macaddress')}}</th>
                            <th>{{ Lang::get('auth.publicip')}}</th>
                            <th>{{ Lang::get('auth.lastcheck')}}</th>
                            <th>{{ Lang::get('auth.status')}}</th>
                            <th>{{ Lang::get('auth.edit')}}</th>
                            <th>{{ Lang::get('auth.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
@endsection

@push('scripts')
        <!-- DataTables -->
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>

    $(function () {
        oTable = $('#hotspot-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: 'hotspot',
            columns: [
                {data: 'shortname', name: 'shortname'},
                {data: 'nasidentifier', name: 'nasidentifier'},
                {data: 'publicip', name: 'publicip', orderable: false, searchable: false},
                {data: 'lastcheckin', name: 'lastcheckin', orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'edit', name: 'edit', orderable: false, searchable: false},
                {data: 'delete', name: 'delete', orderable: false, searchable: false}
            ]
        });


        $(document).on('click', '#delete', function () {
            var $me = $(this);
            swal({
                        title: "Are you sure?",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Delete it!",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var id = jQuery($me).attr('val');
                            var token = jQuery($me).attr('data-token');

                            jQuery.ajax({
                                url: 'hotspot/' + id,
                                type: 'DELETE',
                                data: {
                                    "_token": token
                                },
                                success: function (result) {
                                    if (result.success) {
                                        swal("success!", "Hotspot deleted successfully.", "success");
                                        oTable.draw();
                                    } else {
                                        alert('false');
                                        swal("ohh snap!", "something went wrong", "error");
                                    }

                                }
                            });
                        } else {
                            swal("Cancelled", "Hotspot delete is cancelled ", "error");
                            //return true;
                        }
                    });
            return false;
        });
    });
</script>

@endpush