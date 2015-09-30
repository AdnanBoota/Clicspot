@extends('app')

@section('content')
<style>
    .myimg{
        display: inline-block;
        position: relative;
        margin: 10px;
    }
    
    .myimg .closegallery {
    background: #333 none repeat scroll 0 0;
    border-radius: 25px;
    color: #fff;
    height: 20px;
    padding: 3px;
    position: absolute;
    right: -3px;
    top: -7px;
    width: 20px;
}
</style>
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Gallery
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Gallery List</h3>
                    <a href="{{url('gallery/create')}}" class="btn btn-info pull-right">Add Images</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="timeline-item">
                        <div class="timeline-body galleryList">
                        @forelse($images as $image)
                        <div class="myimg" >
                        <img src="{{ $image }}" height="100" width="150" alt="..." class="">
                        <a href="javascript:void(0);" data-token="{{csrf_token()}}" id="delete" val="{{ $image }}" ><i class="fa fa-fw fa-close pull-right closegallery"></i></a>                        </div>
                        @empty
                            <p>No Images</p>
                        @endforelse
                        </div>
                    </div>
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
<script>

    $(function () {
        


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
                            var imagePath = jQuery($me).attr('val');
                            var token = jQuery($me).attr('data-token');

                            jQuery.ajax({
                                url: 'gallery/deleteImage',
                                type: 'post',
                                data: {
                                    "imagePath": imagePath,
                                    "_token": token
                                    
                                },
                                success: function (result) {
                                    if (result.success) {
                                        swal("success!", "Image deleted successfully.", "success");
                                        jQuery($me).parent().remove();
                                    } else {
                                        alert('false');
                                        swal("ohh snap!", "something went wrong", "error");
                                    }

                                }
                            });
                        } else {
                            swal("Cancelled", "Image delete is cancelled ", "error");
                            //return true;
                        }
                    });
            return false;
        });
    });
</script>

@endpush