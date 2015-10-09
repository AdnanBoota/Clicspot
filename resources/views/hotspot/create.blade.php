@extends('app')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Hotspot
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hotspot</li>
        <li class="active">Add Hotspot</li>
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
                    <h3 class="box-title">Add Hotspot</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array("class"=>"form-horizontal","url"=> url('hotspot'))) !!}
                <div class="box-body">
                    @include('hotspot._form')
                </div>
                <div class="box-footer">
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                    <a href="{{url('hotspot')}}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU"></script>
<script src="{{ asset('/plugins/input-mask/inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script>
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });

</script>
<script type="text/javascript">
    var map;
    var marker;
    window.onload = function () {
        var defaultLat = '<?php echo count($hotspotDetails) > 0 ? $hotspotDetails->latitude : 22.3000 ?>';
        var defaultLang = '<?php echo count($hotspotDetails) > 0 ? $hotspotDetails->longitude : 70.7833 ?>';

        var myLatlng = new google.maps.LatLng(defaultLat, defaultLang);
        var mapOptions = {
            zoom: 22,
            center: {lat: defaultLat, lng: defaultLang}
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        marker = new google.maps.Marker({
            position: myLatlng,
            draggable: true,
            map: map
        });
        google.maps.event.addListener(marker, 'dragend', function (evt) {

            $("[name=latitude]").val(evt.latLng.lat());
            $("[name=longitude]").val(evt.latLng.lng());
        });

        google.maps.event.addListener(map, 'click', function (evt) {
            marker.setMap(null);
            $("[name=latitude]").val(evt.latLng.lat());
            $("[name=longitude]").val(evt.latLng.lng());
            marker = new google.maps.Marker({
                position: evt.latLng,
                map: map
            });
        });

        map.setCenter(marker.position);
        marker.setMap(map);
    }
    jQuery(document).ready(function () {
        $('#nasidentifier').inputmask("mac");
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
        $("#address").blur(function () {
            var address = $(this).val();
            $.ajax({
                url: "http://maps.googleapis.com/maps/api/geocode/json?address=" + address + "&sensor=false",
                type: "POST",
                success: function (res) {
                    console.log(res.results[0].geometry.location.lat);
                    console.log(res.results[0].geometry.location.lng);
                    $("[name=latitude]").val(res.results[0].geometry.location.lat);
                    $("[name=longitude]").val(res.results[0].geometry.location.lng);

                    marker.setMap(null);
                    marker = new google.maps.Marker({
                        position: res.results[0].geometry.location,
                        draggable: true,
                        map: map
                    });
                    map.setCenter(marker.position);
                    marker.setMap(map);

                    google.maps.event.addListener(marker, 'dragend', function (evt) {
                        //                console.log(geocodePosition(marker.getPosition()));
                        $("[name=latitude]").val(evt.latLng.lat());
                        $("[name=longitude]").val(evt.latLng.lng());
                    });

                    google.maps.event.addListener(map, 'click', function (evt) {
                        console.log(evt);
                        marker.setMap(null);
                        $("[name=latitude]").val(evt.latLng.lat());
                        $("[name=longitude]").val(evt.latLng.lng());
                        marker = new google.maps.Marker({
                            position: evt.latLng,
                            draggable: true,
                            map: map
                        });
                    });
                }
            });
        });
    });


</script>
@endpush