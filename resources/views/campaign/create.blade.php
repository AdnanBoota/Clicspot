@extends('app')

@section('content')
@include('errors.flash')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong>{{ Lang::get('auth.problem') }}<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content-header campaignheader">
    <ul class="camheaderleft">
        <li><a href="#"><img src="{{ asset("img/deskicon.png") }}"></a></li>
        <li><a href="#"><img src="{{ asset("img/tableticon.png") }}"></a></li>
        <li><a href="#"><img src="{{ asset("img/mobileicon.png") }}"></a></li>
    </ul>
    <ul class="camheaderright">
        <li><a href="javascript:void(0)" id="reset"><img src="{{ asset("img/reseticon.png") }}"><span>{{ Lang::get('campaign.reset') }}</span></a></li>
        <li><a href="javascript:void(0)" id="quite"><img src="{{ asset("img/quiticon.png") }}"><span>{{ Lang::get('campaign.quitwithoutsaving') }}</span></a></li>
        <li><a href="javascript:void(0)" id="save"><img src="{{ asset("img/saveicon.png") }}"><span>{{ Lang::get('campaign.saveandquit') }}</span></a></li>
    </ul>
    <a href="#" class="campaignlogo">
        <img src="{{ asset("img/campaign_logo.png") }}">
    </a>
    
   <!-- <h1>
        {{ Lang::get('auth.campaignn') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.campaignn') }}</li>
        <li class="active">{{ Lang::get('auth.addcompagin') }}</li>
    </ol>-->
</section>
{!! Form::open(array("class"=>"form-horizontal","url"=> url('campaign'),"files"=>"true","id"=>"campform")) !!}
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
        $("#save").click(function(){
            $("#campform").submit();
        })
    });

</script>


<script type="text/javascript">
            
            var $window = $(window);
                var nav = $('.campaignheader');
                $window.scroll(function(){
                    if ($window.scrollTop() >= 50) {
                       nav.addClass('stickyheader');
                    }
                    else {
                       nav.removeClass('stickyheader  ');
                    }
                }); 
           
        </script>


@endpush
