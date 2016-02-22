@extends('app')

@section('content')
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
<section class="content-header">
    <h1>
        {{ Lang::get('auth.campaignn') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.campaignn') }}</li>
        <li class="active">{{ Lang::get('auth.addcompagin') }}</li>
    </ol>
</section>
{!! Form::open(array("class"=>"form-horizontal","url"=> url('campaign'),"files"=>"true")) !!}
@include('campaign._form')
{!! Form::close() !!}
@include('campaign.gallery')
<!-- Content Header (Page header) -->

@endsection
@push('scripts')
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

//    $(".my-colorpicker").colorpicker();






        $("#backgroundimage").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    $("#preview").css("background-image", "url(" + this.result + ")");
                }
            }
        });

        $("#logoimage").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () { // set image data as background of div

                    $("#preview #logo").css("background-image", "url(" + this.result + ")");
                }
            }
        });
        
        $('.imgbtnlogo a:first').trigger('click');
        $("#backgroundzoom").val('100');
        $('#fontcolor').val('#222222');
    });

</script>
@endpush
