<div class="form-group">
    {!! Form::label('shortname', 'Location Name', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('shortname', null, array('id'=>'shortname','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('nasidentifier', 'MAC Address', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('nasidentifier', Session::pull('mac'), array('id'=>'nasidentifier','class'=>'form-control','required'=>'true')) !!}
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
    {!! Form::label('map_canvas', 'Map', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <div id="map_canvas" class="mapping"
             style="width:100%;max-width: 350px; height: 350px"></div>
    </div>
</div>

<div class="form-group">
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
</div>