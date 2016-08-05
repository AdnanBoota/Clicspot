@extends('app')
@section('content')


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong>{{ Lang::get('auth.problem')}}<br><br>
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
         <li><a href="javascript:void(0);" id="reset"><img src="{{ asset("img/reseticon.png") }}"><span>Reset</span></a></li>
        <li><a href="javascript:void(0);" id="quite"><img src="{{ asset("img/quiticon.png") }}"><span>Quit Without Saving</span></a></li>
        <li><a href="javascript:void(0)" id="save"><img src="{{ asset("img/saveicon.png") }}"><span>Save & Quit</span></a></li>
    </ul>
    <a href="#" class="campaignlogo">
        <img src="{{ asset("img/campaign_logo.png") }}">
    </a>
<!--    <h1>
        Campaign
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Campaign</li>
        <li class="active">Edit Campaign</li>
    </ol>-->
</section>
<!-- form start -->
{!! Form::model($campaign,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['CampaignController@update',$campaign->id],"files"=>"true","id"=>"campform"]) !!}
@include('campaign._form')
{!! Form::close() !!}
@include('campaign.gallery')
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

$("#save").click(function(){
            $("#campform").submit();
        })
    $('#headerBg').text($('#fontcolor').val());
    $('#preview .navbar').css('background-color', $('#fontcolor').val());
    $('#preview .navbar-brand').css('text-align', $('input[name=logoposition]').val());
//    console.log($('input[name=backgroundzoom]').attr('data-from'));
//    $('#preview .container-img').css('background-size', $('input[name=backgroundzoom]').attr('data-from') + '%');
	

});
function checkboxCamp(id){
var APP_URL = {!! json_encode(url('/')) !!};
 var vale=$("#checkbox"+id).val();
if($("#checkbox"+id).prop("checked")==true)
{
    var appurl=APP_URL+'/updatecampaign/'+vale+'/'+ {!! $campaign->id !!};
}else{
     var appurl=APP_URL+'/updatecampaign/'+vale+'/1';
}

    $.ajax({
        url:appurl,
        type:'get',
        success:function(data){
        } 
    });
}

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
