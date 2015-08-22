@extends('app')
        
@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Vendors
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vendors</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Vendor List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped dt-responsive" id="users-table" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>Status</th>
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
        oTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: 'vendorList',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'isactivated', name: 'isactivated', orderable: false, searchable: false}
            ]
        });


        $(document).on('click', '#action', function () {
            var $me = $(this);
            swal({
                        title: "Are you sure?",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Active it!",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var id = jQuery($me).attr('val');
                            jQuery.ajax({
                                url: 'vendorAction/' + id,
                                type: 'GET',
                                success: function (result) {
                                    if (result) {
                                        oTable.draw();
                                        swal("success!", "User account activated successfully.", "success");
                                    } else {
                                        alert('false');
                                        swal("ohh snap!", "something went wrong", "error");
                                    }

                                }
                            });
                        } else {
                            swal("Cancelled", "User action is cancelled ", "error");
                            //return true;
                        }
                    });
//        var flag = confirm('Are Sure to confirm the user');
//        if (flag) {
//            var id = jQuery(this).attr('val');
//            jQuery.ajax({
//                url: 'vendorAction/' + id,
//                type: 'GET',
//                success: function (result) {
//                    if (result) {
//                        oTable.draw();
//                        swal("success!", "User account activated successfully.", "success");
//                    } else {
//                        alert('false');
//                        swal("ohh snap!", "something went wrong", "error");
//                    }
//
//                }
//            });
//        } else {
//            return false;
//        }
            return false;
        });
    });
</script>

@endpush