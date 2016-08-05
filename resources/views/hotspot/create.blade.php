@extends('app')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ Lang::get('auth.hotspot') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.hotspot') }}</li>
        <li class="active">{{ Lang::get('auth.addhotspot') }}</li>
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
                    <h3 class="box-title">{{ Lang::get('auth.addhotspot') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array("class"=>"form-horizontal","url"=> url('hotspot'))) !!}
                <div class="box-body">
                    @include('hotspot._form')
                </div>
                <div class="box-footer">
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                    <a href="{{url('hotspot')}}" class="btn btn-default">{{ Lang::get('auth.cancel') }}</a>
                    <button type="submit" class="btn btn-info pull-right">{{ Lang::get('auth.submit') }}</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
@endsection
@push('scripts')
<!--<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places"></script>-->
<script src="{{ asset('/plugins/input-mask/inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script>
    function initialize() {

        // get places auto-complete when user type in location-text-box
        var input = /** @type {HTMLInputElement} */
                (
                        document.getElementById('address'));


        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //console.log(place);
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            $("[name=latitude]").val(lat);
            $("[name=longitude]").val(lng);
            
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

        });
    }

    //google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#nasidentifier').inputmask("mac");
        $('form').validate({
            rules: {
                  tripAdvisorId:{
                    url:true
                }
            },
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
    });


</script>
@endpush