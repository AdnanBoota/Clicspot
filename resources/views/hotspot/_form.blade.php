@push('styles')
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
@endpush
<div class="form-group">
    {!! Form::label('shortname', 'Location Name', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('shortname', null, array('id'=>'shortname','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('nasidentifier', 'MAC Address', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('nasidentifier', Session::get('mac'), array('id'=>'nasidentifier','class'=>'form-control','required'=>'true',$readonly,'minlength'=>'17')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('campaignid', 'Campaign', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::select('campaignid',$campaign, null, array('id'=>'campaignid','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address', 'Address', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('address', null, array('id'=>'address','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('ssid', 'SSID', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('ssid', null, array('id'=>'ssid','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('redirectUrl', 'Redirect Location', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('redirectUrl', null, array('id'=>'redirectUrl','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    <!--{!! Form::label('tripAdvisorId', 'Trip Advisor Id', array('class' => 'col-sm-2 control-label')) !!} -->
    {!! Form::label('tripAdvisorId', 'Review URL', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('tripAdvisorId', null, array('id'=>'tripAdvisorId','class'=>'form-control')) !!}
    </div>
    
</div>
<div class="form-group">
    <!--{!! Form::label('tripAdvisorId', 'Trip Advisor Id', array('class' => 'col-sm-2 control-label')) !!} -->
    {!! Form::label('reviewstatus', 'Review Status', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        ON {!!  Form::radio('reviewstatus','0',false,array('class' => '','required'=>'true')) !!}
        OFF {!!  Form::radio('reviewstatus', '1') !!}
    </div>
    
</div>

<!--<div class="form-group">
    {!! Form::label('map_canvas', 'Map', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            <div id="map_canvas" class="mapping"
                 style="width:100%;max-width: 350px; height: 350px"></div>
        </div>
    </div>-->

<!--<div class="form-group">
    {!! Form::label('latitude', 'Latitude', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!!  Form::text('latitude', null, array('id'=>'latitude','class'=>'form-control','required'=>'true')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('longitude', 'Longitude', array('class' => 'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!!  Form::text('longitude', null, array('id'=>'longitude','class'=>'form-control','required'=>'true')) !!}
        </div>
    </div>-->
<div class="box box-info no-border">
    <div class="box-header with-border">
        <h3 class="box-title">Social</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            {!! Form::label('ChilliSpot-Bandwidth-Max-Up', 'Upload Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('ChilliSpot-Bandwidth-Max-Up', "", array('data-from'=>isset($hotspot['ChilliSpot-Bandwidth-Max-Up']) ? $hotspot['ChilliSpot-Bandwidth-Max-Up'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Up','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('ChilliSpot-Bandwidth-Max-Down', 'Download Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('ChilliSpot-Bandwidth-Max-Down', "", array('data-from'=>isset($hotspot['ChilliSpot-Bandwidth-Max-Down']) ? $hotspot['ChilliSpot-Bandwidth-Max-Down'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Down','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Session-Timeout', 'Session-Timeout', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('Session-Timeout', "", array('data-from'=>isset($hotspot['Session-Timeout']) ? $hotspot['Session-Timeout'] : '3600','id'=>'Session-Timeout','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Idle-Timeout', 'Idle-Timeout', array('class' => 'col-sm-2 control-label')) !!}
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
            {!! Form::label('EMail_ChilliSpot-Bandwidth-Max-Up', 'Upload Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('EMail_ChilliSpot-Bandwidth-Max-Up', "", array('data-from'=>isset($hotspot['EMail_ChilliSpot-Bandwidth-Max-Up']) ? $hotspot['EMail_ChilliSpot-Bandwidth-Max-Up'] : '1024','id'=>'EMail_ChilliSpot-Bandwidth-Max-Up','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('EMail_ChilliSpot-Bandwidth-Max-Down', 'Download Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('EMail_ChilliSpot-Bandwidth-Max-Down', "", array('data-from'=>isset($hotspot['EMail_ChilliSpot-Bandwidth-Max-Down']) ? $hotspot['EMail_ChilliSpot-Bandwidth-Max-Down'] : '1024','id'=>'EMail_ChilliSpot-Bandwidth-Max-Down','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('EMail_Session-Timeout', 'Session-Timeout', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('EMail_Session-Timeout', "", array('data-from'=>isset($hotspot['EMail_Session-Timeout']) ? $hotspot['EMail_Session-Timeout'] : '3600','id'=>'EMail_Session-Timeout','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('EMail_Idle-Timeout', 'Idle-Timeout', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('EMail_Idle-Timeout', "", array('data-from'=>isset($hotspot['EMail_Idle-Timeout']) ? $hotspot['EMail_Idle-Timeout'] : '1800','id'=>'EMail_Idle-Timeout','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
    </div>
</div>
@push('scripts')
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