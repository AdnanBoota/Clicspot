@extends('app')
@push('styles')
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link href="{{ asset('/plugins/mini-upload-form/assets/css/style.css') }}" rel="stylesheet" />
@endpush
@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Gallery
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery</li>
        <li class="active">Add Images</li>
        
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('errors.flash')
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Images</h3>
                    <a href="{{url('gallery')}}" class="btn btn-info pull-right">View Gallery</a>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form id="upload" method="post" action="{{url('galleryFileUpload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div id="drop">
                    Drop Here

                    <a>Browse</a>
                    <input type="file" name="upl" multiple />
                </div>

                <ul>
                    <!-- The file uploads will be shown here -->
                </ul>

            </form>
                
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
@endsection
@push('scripts')
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.knob.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/script.js') }}"></script>
@endpush