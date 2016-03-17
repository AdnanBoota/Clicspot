 @push('styles')
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/editrouter.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@extends('app')


@section('content')


        <!-- Content Header (Page header) -->
<!--<section class="content-header">
    <h1>
        Hotspot
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hotspot</li>
        <li class="active">Edit Hotspot </li>
    </ol>
</section>-->
<!-- Main content -->

<div class="editrtitle">
        <img src="{{ asset("img/hotspotimg.png") }}"><h1>Edit HotSpot</h1>
    </div>

<section class="content editrouterblock">
    
    
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
                <!--<div class="box-header with-border">
                    <h3 class="box-title">Edit Hotspot</h3>
                </div>-->
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($hotspot,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['HotspotController@update',$hotspot->id]]) !!}
                <div class="box-body">
                   <div class="editboxinfo">
    <h1>Router Infos</h1>
    <p>Modify the information below and click on Modify to save.</p>
     
    <form class="editrouterform">
        <div class="editformblock">
            {!!  Form::text('ssid', null, array('id'=>'shortname','class'=>'lcname','required'=>'true','placeholder'=>'Location Name','required'=>'true')) !!}
             {!!  Form::text('shortname', null, array('id'=>'shortname','class'=>'wifinnm','required'=>'true','placeholder'=>'Wireless Name','required'=>'true')) !!}
             {!!  Form::text('nasidentifier', (Session::has('mac')) ? Session::get('mac') : null, array('id'=>'nasidentifier','class'=>'routericon','required'=>'true','minlength'=>'17','placeholder'=>'88:AC:45:45:87')) !!}
             {!!  Form::hidden('type', 'routerinfo') !!}
<!--            <input class="lcname" type="text" placeholder="Location Name">-->
<!--            <input class="wifinnm" type="text" placeholder="Wireless Name">-->
<!--            <input class="routericon" type="text" placeholder="88:AC:45:45:87" disabled> -->
        </div>
        <div class="editformblock">
            {!!  Form::text('address', null, array('id'=>'autocomplete','onFocus'=>'geolocate()','class'=>'addicon','placeholder'=>'Enter your address')) !!}
             <input type="hidden" id="street_number" value="">
             <input class="padnone" type="text" placeholder="Address" readonly="readonly" id="route" >
            <div class="editformrow">
                <input class="padnone" type="text" placeholder="Zip Code" readonly="readonly"  id="postal_code"> 
                <input class="padnone" type="text" placeholder="City" readonly="readonly"  id="locality">
            </div>
            <input class="padnone" type="text" placeholder="Country" readonly="readonly"  id="country"> 
        </div>
        <div class="modifybtnblock">
            <button class="modifybtn" type="submit">Modify</button>
        </div>
    </form> 
</div>
{!! Form::close() !!}
{!! Form::model($hotspot,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['HotspotController@update',$hotspot->id],"id"=>"info"]) !!}
<div class="editboxinfo">
    <h1>Router Setting</h1>
    <p>Modify the information below and click on Modify to save.</p> 
    <div class="box box-info no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Social</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                 {!!  Form::hidden('type', 'routersetting') !!}
                {!! Form::label('ChilliSpot-Bandwidth-Max-Up',Lang::get("auth.uploadspeed"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('ChilliSpot-Bandwidth-Max-Up', "", array('data-from'=>isset($hotspot['ChilliSpot-Bandwidth-Max-Up']) ? $hotspot['ChilliSpot-Bandwidth-Max-Up'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Up','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('ChilliSpot-Bandwidth-Max-Down',Lang::get("auth.downloadspeed"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('ChilliSpot-Bandwidth-Max-Down', "", array('data-from'=>isset($hotspot['ChilliSpot-Bandwidth-Max-Down']) ? $hotspot['ChilliSpot-Bandwidth-Max-Down'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Down','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Session-Timeout',Lang::get("auth.sessionout"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('Session-Timeout', "", array('data-from'=>isset($hotspot['Session-Timeout']) ? $hotspot['Session-Timeout'] : '3600','id'=>'Session-Timeout','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Idle-Timeout',Lang::get("auth.idleout"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('Idle-Timeout', "", array('data-from'=>isset($hotspot['Idle-Timeout']) ? $hotspot['Idle-Timeout'] : '1800','id'=>'Idle-Timeout','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box box-info no-border">
        <div class="box-header with-border">
            <h3 class="box-title">E-Mail</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('EMail_ChilliSpot-Bandwidth-Max-Up',Lang::get("auth.uploadspeed"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('EMail_ChilliSpot-Bandwidth-Max-Up', "", array('data-from'=>isset($hotspot['EMail_ChilliSpot-Bandwidth-Max-Up']) ? $hotspot['EMail_ChilliSpot-Bandwidth-Max-Up'] : '1024','id'=>'EMail_ChilliSpot-Bandwidth-Max-Up','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('EMail_ChilliSpot-Bandwidth-Max-Down',Lang::get("auth.downloadspeed"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('EMail_ChilliSpot-Bandwidth-Max-Down', "", array('data-from'=>isset($hotspot['EMail_ChilliSpot-Bandwidth-Max-Down']) ? $hotspot['EMail_ChilliSpot-Bandwidth-Max-Down'] : '1024','id'=>'EMail_ChilliSpot-Bandwidth-Max-Down','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('EMail_Session-Timeout',Lang::get("auth.sessionout"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('EMail_Session-Timeout', "", array('data-from'=>isset($hotspot['EMail_Session-Timeout']) ? $hotspot['EMail_Session-Timeout'] : '3600','id'=>'EMail_Session-Timeout','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('EMail_Idle-Timeout',Lang::get("auth.idleout"), array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!!  Form::text('EMail_Idle-Timeout', "", array('data-from'=>isset($hotspot['EMail_Idle-Timeout']) ? $hotspot['EMail_Idle-Timeout'] : '1800','id'=>'EMail_Idle-Timeout','class'=>'form-control','required'=>'true')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modifybtnblock">
        <button class="modifybtn" type="submit">Modify</button>
    </div>
</div>

<!--                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <a href="{{url('hotspot')}}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>-->
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
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
       street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        //administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
                var val,value;
              if(addressType=="street_number")
              {
                     val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
              }else if(addressType=="route"){
                   var value = place.address_components[i][componentForm[addressType]];
                    if(val==undefined){
                    document.getElementById(addressType).value = value;
                 }
                    else{
                        document.getElementById(addressType).value =val+" "+value;
                     }
              }else{
                   var vale = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value =vale;
              }

          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#nasidentifier').inputmask("mac");
        $('#info').validate({
            rules: {
                tripAdvisorId:{
                    url:true
                },
                ssid:"required",
                shortname:"required",
                nasidentifier:"required",
                
            }
          });
    });


</script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#ChilliSpot-Bandwidth-Max-Up").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#ChilliSpot-Bandwidth-Max-Down").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#Session-Timeout").ionRangeSlider({
            min: 60,
            max: 14400,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        $("#Idle-Timeout").ionRangeSlider({
            min: 60,
            max: 7200,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });

        $("#EMail_ChilliSpot-Bandwidth-Max-Up").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#EMail_ChilliSpot-Bandwidth-Max-Down").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#EMail_Session-Timeout").ionRangeSlider({
            min: 60,
            max: 14400,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        $("#EMail_Idle-Timeout").ionRangeSlider({
            min: 60,
            max: 7200,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });

    });
</script>

@endpush