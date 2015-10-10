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
        Campaign
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Campaign</li>
        <li class="active">Add Campaign</li>
    </ol>
</section>
{!! Form::open(array("class"=>"form-horizontal","url"=> url('campaign'),"files"=>"true")) !!}
@include('campaign._form')
<div class="box-footer">
    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
    <a href="{{url('campaign')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Submit</button>
</div>
<!-- /.box-footer -->
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
    });

</script>
@endpush
