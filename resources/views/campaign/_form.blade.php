
<div class="form-group">
    {!! Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('name', null, array('id'=>'name','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('backgroundimage', 'Background Image', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::file('backgroundimage', null, array('id'=>'backgroundimage','class'=>'form-control','required'=>'true')) !!}
        @if(isset($campaign->backgroundimage))
        <img src="/uploads/campaign/{!! $campaign->backgroundimage !!}" height="100" width="100" />
        {!! Form::hidden('oldbackgroundimage',$campaign->backgroundimage) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('logoimage', 'Logo Image', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">

        {!!  Form::file('logoimage', null, array('id'=>'logoimage','class'=>'form-control','required'=>'true')) !!}
        @if(isset($campaign->logoimage))
        <img src="/uploads/campaign/{!! $campaign->logoimage !!}" height="100" width="100" />
        {!! Form::hidden('oldlogoimage',$campaign->logoimage) !!}
        @endif

    </div>
</div>
<div class="form-group">
    {!! Form::label('fontcolor', 'Font Color', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('fontcolor', null, array('id'=>'fontcolor','class'=>'form-control my-colorpicker','required'=>'true')) !!}
    </div>
</div>
<div class="box box-info no-border">
    <div class="box-header with-border">
        <h3 class="box-title">Attributes</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            {!! Form::label('ChilliSpot-Bandwidth-Max-Up', 'Upload Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('ChilliSpot-Bandwidth-Max-Up', "", array('data-from'=>isset($campaign['ChilliSpot-Bandwidth-Max-Up']) ? $campaign['ChilliSpot-Bandwidth-Max-Up'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Up','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('ChilliSpot-Bandwidth-Max-Down', 'Download Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('ChilliSpot-Bandwidth-Max-Down', "", array('data-from'=>isset($campaign['ChilliSpot-Bandwidth-Max-Down']) ? $campaign['ChilliSpot-Bandwidth-Max-Down'] : '1024','id'=>'ChilliSpot-Bandwidth-Max-Down','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Session-Timeout', 'Session-Timeout', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('Session-Timeout', "", array('data-from'=>isset($campaign['Session-Timeout']) ? $campaign['Session-Timeout'] : '3600','id'=>'Session-Timeout','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Idle-Timeout', 'Idle-Timeout', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('Idle-Timeout', "", array('data-from'=>isset($campaign['Idle-Timeout']) ? $campaign['Idle-Timeout'] : '1800','id'=>'Idle-Timeout','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
    </div>
</div>
