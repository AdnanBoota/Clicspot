
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
            {!! Form::label('uploadspeed', 'Upload Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('uploadspeed', "", array('data-from'=>isset($campaign->uploadspeed) ? $campaign->uploadspeed : '1000','id'=>'uploadspeed','class'=>'form-control','required'=>'true')) !!}
                {!! Form::hidden('uploadspeedId',isset($campaign->uploadspeedId) ? $campaign->uploadspeedId : '') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('downloadspeed', 'Download Speed', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('downloadspeed', "", array('data-from'=>isset($campaign->downloadspeed) ? $campaign->downloadspeed : '1000','id'=>'downloadspeed','class'=>'form-control','required'=>'true')) !!}
                {!! Form::hidden('downloadspeedId',isset($campaign->downloadspeedId) ? $campaign->downloadspeedId : '') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('timeout', 'Time Out', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-10">
                {!!  Form::text('timeout', "", array('data-from'=>isset($campaign->timeout) ? $campaign->timeout : '3600','id'=>'timeout','class'=>'form-control','required'=>'true')) !!}
                {!! Form::hidden('timeoutId',isset($campaign->timeoutId) ? $campaign->timeoutId : '') !!}
            </div>
        </div>
    </div>
</div>
