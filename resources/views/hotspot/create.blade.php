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
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-8">
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
                    <h3 class="box-title">Hotspot</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="hotspot-form" id="hotspot-form" role="form" method="POST" action="{{ url('hotspot') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="<?php echo isset($hotspotDetails) ? $hotspotDetails->id : '' ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="shortname" class="col-sm-2 control-label">Short Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="shortname" id="shortname" value="{{ isset($hotspotDetails) ? $hotspotDetails->shortname : old('shortname') }}"  placeholder="Short Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nasidentifier" class="col-sm-2 control-label">Identifier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nasidentifier" id="nasidentifier" value="{{ isset($hotspotDetails) ? $hotspotDetails->nasidentifier : old('nasidentifier') }}" placeholder="Identifier">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secret" class="col-sm-2 control-label">Secret</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="secret" id="secret" value="{{ isset($hotspotDetails) ? $hotspotDetails->secret : old('secret') }}"  placeholder="clicspot@wifi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" id="address" value="{{ isset($hotspotDetails) ? $hotspotDetails->address : old('address') }}"  placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Map</label>
                            <div class="col-sm-10">
                                <div id="map_canvas" class="mapping" style="width: 350px; height: 350px"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="latitude" class="col-sm-2 control-label">Latitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="latitude" id="latitude" value="{{ isset($hotspotDetails) ? $hotspotDetails->latitude : old('latitude') }}"  placeholder="Latitude">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="longitude" class="col-sm-2 control-label">Longitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="longitude" id="longitude" value="{{ isset($hotspotDetails) ? $hotspotDetails->longitude : old('longitude') }}"  placeholder="Longitude">
                            </div>
                        </div>
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                        <a href="{{url('hotspot')}}" class="btn btn-default">cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
@push('scripts')
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">
    var map;
    var marker ;
    window.onload = function () {
        var defaultLat = '<?php echo isset($hotspotDetails) ? $hotspotDetails->latitude: 22.3000 ?>';
        var defaultLang = '<?php echo isset($hotspotDetails) ? $hotspotDetails->longitude : 70.7833 ?>';

        var myLatlng = new google.maps.LatLng(defaultLat, defaultLang);
        var mapOptions = {
            zoom: 22
    //        mapTypeId: google.maps.MapTypeId.SATELLITE
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

        google.maps.event.addListener(map, 'click', function(evt) {
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
    jQuery(document).ready(function(){
       $("#address").blur(function(){
            var address = $(this).val();
            $.ajax({
              url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
              type: "POST",
              success:function(res){
                 console.log(res.results[0].geometry.location.lat);
                 console.log(res.results[0].geometry.location.lng);
                 $("[name=latitude]").val(res.results[0].geometry.location.lat);
                 $("[name=longitude]").val(res.results[0].geometry.location.lng);

                 marker.setMap(null);
                 marker = new google.maps.Marker({
                    position: res.results[0].geometry.location,
                    draggable:true,
                    map: map
                });
                map.setCenter(marker.position);
                marker.setMap(map);

                google.maps.event.addListener(marker, 'dragend', function (evt) {
    //                console.log(geocodePosition(marker.getPosition()));
                    $("[name=latitude]").val(evt.latLng.lat());
                    $("[name=longitude]").val(evt.latLng.lng());
                });

                google.maps.event.addListener(map, 'click', function(evt) {
                    console.log(evt);
                    marker.setMap(null);
                    $("[name=latitude]").val(evt.latLng.lat());
                    $("[name=longitude]").val(evt.latLng.lng());
                    marker = new google.maps.Marker({
                            position: evt.latLng,
                            draggable:true,
                            map: map
                    });
                });
              }
            });
        });
    });
    
    
</script>
@endpush