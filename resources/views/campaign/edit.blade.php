@extends('app')
@push('styles')
<link href="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
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
        <li class="active">Edit Campaign</li>
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
                    <h3 class="box-title">Edit Campaign</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($campaign,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['CampaignController@update',$campaign->id],"files"=>"true"]) !!}
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
        $('#campaignName').text($('#name').val());
        $('#headerBg').text($('#fontcolor').val());
        $('.headerBgIcon').css('background-color',$('#fontcolor').val());
        $('#preview .navbar').css('background-color',$('#fontcolor').val());

    
        });
        
</script>
@endpush