@extends('app')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ Lang::get('auth.campaignn') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.campaignn') }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ Lang::get('auth.compaginlist') }}</h3>
                    <a href="{{url('campaign/create')}}" class="btn btn-info pull-right">{{ Lang::get('auth.addcompagin') }}</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive" id="hotspot-table" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>BackGround Image</th>
                            <th>Logo Image</th>
                            <th>Font Color</th>
                            <th>Edit</th>
                            <th>Delete</th>
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
            ajax: 'campaign',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'backgroundimage', name: 'backgroundimage',orderable: false, searchable: false},
                {data: 'logoimage', name: 'logoimage', orderable: false, searchable: false},
                {data: 'fontcolor', name: 'fontcolor', orderable: false, searchable: false},
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
                                url: 'campaign/' + id,
                                type: 'DELETE',
                                data: {
                                    "_token": token
                                },
                                success: function (result) {
                                    if (result.success) {
                                        swal("success!", "Campaign deleted successfully.", "success");
                                        oTable.draw();
                                    } else {
                                        alert('false');
                                        swal("ohh snap!", "something went wrong", "error");
                                    }

                                }
                            });
                        } else {
                            swal("Cancelled", "Campaign delete is cancelled ", "error");
                            //return true;
                        }
                    });
            return false;
        });
    });
</script>

@endpush