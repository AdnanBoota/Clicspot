@extends('app')
@push('styles')
<link href="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
<style>
#preview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
#preview  #logo{
    width: 90px;
    height: 90px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
@endpush
@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Campaign
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Campaign</li>
        <li class="active">Add Campaign</li>
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
                    <h3 class="box-title">Add Campaign</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array("class"=>"form-horizontal","url"=> url('campaign'),"files"=>"true")) !!}
                <div class="box-body">
                    @include('campaign._form')
                </div>
                <div class="box-footer">
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                    <a href="{{url('campaign')}}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
            @include('campaign.gallery')
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
@endsection
@push('scripts')
<script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('form').validate({
            rules: {},
            errorClass: "text-red",
            errorElement: "span",
            errorPlacement: function (error, element) {
                if (element.context.name == 'x') {
                    error.appendTo(element.parents(".col-sm-10:last"));
                }
                else {
                    error.appendTo(element.parents(".col-sm-10:first"));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('has-error');
                $(element).parents('.form-group').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error');
                $(element).parents('.form-group').addClass('has-success');
            }
        });

        $(".my-colorpicker").colorpicker();
        $("#ChilliSpot-Bandwidth-Max-Up").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#ChilliSpot-Bandwidth-Max-Down").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#Session-Timeout").ionRangeSlider({
            min: 60,
            max: 14400,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        $("#Idle-Timeout").ionRangeSlider({
            min: 60,
            max: 7200,
            grid_num: 1,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        
        
        
        
        
        $("#backgroundimage").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    $("#preview").css("background-image", "url("+this.result+")");
                }
            }
        });
        
        $("#logoimage").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    
                    $("#preview #logo").css("background-image", "url("+this.result+")");
                }
            }
        });

    });

</script>
@endpush