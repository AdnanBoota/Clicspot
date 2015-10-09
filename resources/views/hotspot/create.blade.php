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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="{{ asset('/plugins/input-mask/inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){

        var mapOptions = {
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(41.06000,28.98700)
        };

        var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

        var geocoder = new google.maps.Geocoder();

        $(function() {
            $("#address").autocomplete({

                source: function(request, response) {

                    if (geocoder == null){
                        geocoder = new google.maps.Geocoder();
                    }
                    geocoder.geocode( {'address': request.term }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            var searchLoc = results[0].geometry.location;
                            var lat = results[0].geometry.location.lat();
                            var lng = results[0].geometry.location.lng();
                            var latlng = new google.maps.LatLng(lat, lng);
                            var bounds = results[0].geometry.bounds;

                            geocoder.geocode({'latLng': latlng}, function(results1, status1) {
                                if (status1 == google.maps.GeocoderStatus.OK) {
                                    if (results1[1]) {
                                        response($.map(results1, function(loc) {
                                            return {
                                                label  : loc.formatted_address,
                                                value  : loc.formatted_address,
                                                bounds   : loc.geometry.bounds
                                            }
                                        }));
                                    }
                                }
                            });
                        }
                    });
                },
                select: function(event,ui){
                    var pos = ui.item.position;
                    var lct = ui.item.locType;
                    var bounds = ui.item.bounds;

                    if (bounds){
                        map.fitBounds(bounds);
                    }
                }
            });
        });
    });
</script>
{{--<script type="text/javascript">--}}
    {{--var map;--}}
    {{--var marker;--}}
    {{--window.onload = function () {--}}
        {{--var defaultLat = '<?php echo count($hotspotDetails) > 0 ? $hotspotDetails->latitude : 22.3000 ?>';--}}
        {{--var defaultLang = '<?php echo count($hotspotDetails) > 0 ? $hotspotDetails->longitude : 70.7833 ?>';--}}

        {{--var myLatlng = new google.maps.LatLng(defaultLat, defaultLang);--}}
        {{--var mapOptions = {--}}
            {{--zoom: 22--}}
            {{--//        mapTypeId: google.maps.MapTypeId.SATELLITE--}}
        {{--};--}}
        {{--map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);--}}
        {{--marker = new google.maps.Marker({--}}
            {{--position: myLatlng,--}}
            {{--draggable: true,--}}
            {{--map: map--}}
        {{--});--}}
        {{--google.maps.event.addListener(marker, 'dragend', function (evt) {--}}

            {{--$("[name=latitude]").val(evt.latLng.lat());--}}
            {{--$("[name=longitude]").val(evt.latLng.lng());--}}
        {{--});--}}

        {{--google.maps.event.addListener(map, 'click', function (evt) {--}}
            {{--marker.setMap(null);--}}
            {{--$("[name=latitude]").val(evt.latLng.lat());--}}
            {{--$("[name=longitude]").val(evt.latLng.lng());--}}
            {{--marker = new google.maps.Marker({--}}
                {{--position: evt.latLng,--}}
                {{--map: map--}}
            {{--});--}}
        {{--});--}}

        {{--map.setCenter(marker.position);--}}
        {{--marker.setMap(map);--}}
    {{--}--}}
    {{--jQuery(document).ready(function () {--}}
        {{--$('#nasidentifier').inputmask("mac");--}}
        {{--$('form').validate({--}}
            {{--rules: {},--}}
            {{--errorClass: "text-red",--}}
            {{--errorElement: "span",--}}
            {{--errorPlacement: function (error, element) {--}}
                {{--if (element.context.name == 'x') {--}}
                    {{--error.appendTo(element.parents(".col-sm-10:last"));--}}
                {{--}--}}
                {{--else {--}}
                    {{--error.appendTo(element.parents(".col-sm-10:first"));--}}
                {{--}--}}
            {{--},--}}
            {{--highlight: function (element, errorClass, validClass) {--}}
                {{--$(element).parents('.form-group').addClass('has-error');--}}
                {{--$(element).parents('.form-group').removeClass('has-success');--}}
            {{--},--}}
            {{--unhighlight: function (element, errorClass, validClass) {--}}
                {{--$(element).parents('.form-group').removeClass('has-error');--}}
                {{--$(element).parents('.form-group').addClass('has-success');--}}
            {{--}--}}
        {{--});--}}
        {{--$("#address").blur(function () {--}}
            {{--var address = $(this).val();--}}
            {{--$.ajax({--}}
                {{--url: "http://maps.googleapis.com/maps/api/geocode/json?address=" + address + "&sensor=false",--}}
                {{--type: "POST",--}}
                {{--success: function (res) {--}}
                    {{--console.log(res.results[0].geometry.location.lat);--}}
                    {{--console.log(res.results[0].geometry.location.lng);--}}
                    {{--$("[name=latitude]").val(res.results[0].geometry.location.lat);--}}
                    {{--$("[name=longitude]").val(res.results[0].geometry.location.lng);--}}

                    {{--marker.setMap(null);--}}
                    {{--marker = new google.maps.Marker({--}}
                        {{--position: res.results[0].geometry.location,--}}
                        {{--draggable: true,--}}
                        {{--map: map--}}
                    {{--});--}}
                    {{--map.setCenter(marker.position);--}}
                    {{--marker.setMap(map);--}}
                    {{--google.maps.event.addListener(marker, 'dragend', function (evt) {--}}
                        {{--//                console.log(geocodePosition(marker.getPosition()));--}}
                        {{--$("[name=latitude]").val(evt.latLng.lat());--}}
                        {{--$("[name=longitude]").val(evt.latLng.lng());--}}
                    {{--});--}}

                    {{--google.maps.event.addListener(map, 'click', function (evt) {--}}
                        {{--console.log(evt);--}}
                        {{--marker.setMap(null);--}}
                        {{--$("[name=latitude]").val(evt.latLng.lat());--}}
                        {{--$("[name=longitude]").val(evt.latLng.lng());--}}
                        {{--marker = new google.maps.Marker({--}}
                            {{--position: evt.latLng,--}}
                            {{--draggable: true,--}}
                            {{--map: map--}}
                        {{--});--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--});--}}


{{--</script>--}}
@endpush