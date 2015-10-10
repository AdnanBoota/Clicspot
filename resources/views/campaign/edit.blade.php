@extends('app')
@section('content')


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

<!-- form start -->
{!! Form::model($campaign,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['CampaignController@update',$campaign->id],"files"=>"true"]) !!}

@include('campaign._form')

<div class="box-footer">
    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
    <a href="{{url('campaign')}}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Submit</button>
</div>
<!-- /.box-footer -->
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


    $('#headerBg').text($('#fontcolor').val());
    $('#preview .navbar').css('background-color', $('#fontcolor').val());
    $('#preview .navbar-brand').css('text-align', $('input[name=logoposition]').val());
	

});

</script>
@endpush
