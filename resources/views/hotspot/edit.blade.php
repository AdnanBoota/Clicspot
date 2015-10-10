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
        <li class="active">Edit Hotspot</li>
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
                    <h3 class="box-title">Edit Hotspot</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($hotspot,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['HotspotController@update',$hotspot->id]]) !!}
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
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places"></script>
<script src="{{ asset('/plugins/input-mask/inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script>
    var map;
    var marker;
    var defaultLat = '<?php echo count($hotspot) > 0 ? $hotspot->latitude : 22.3000 ?>';
    var defaultLang = '<?php echo count($hotspot) > 0 ? $hotspot->longitude : 70.7833 ?>';
    function initialize() {
        var mapOptions = {
            zoom: 20
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
                mapOptions);

        // Get GEOLOCATION

        handleNoGeolocation(false);


        function handleNoGeolocation(errorFlag) {
            if (errorFlag) {
                var content = 'Error: The Geolocation service failed.';
            } else {
                var content = 'Error: Your browser doesn\'t support geolocation.';
            }

            var options = {
                map: map,
                position: new google.maps.LatLng(defaultLat, defaultLang),
                content: content
            };

            map.setCenter(options.position);
            marker = new google.maps.Marker({
                position: options.position,
                map: map,
                draggable: true
            });
            marker.setIcon(/** @type {google.maps.Icon} */ ({
                url: '{{ asset('img/wifi_marker.png') }}',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

        }

        // get places auto-complete when user type in location-text-box
        var input = /** @type {HTMLInputElement} */
                (
                        document.getElementById('address'));


        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place);
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            $("[name=latitude]").val(lat);
            $("[name=longitude]").val(lng);
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */ ({
                url: '{{ asset('img/wifi_marker.png') }}',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

        });

        google.maps.event.addDomListener(window, 'load', initialize);

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
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
    });


</script>
@endpush