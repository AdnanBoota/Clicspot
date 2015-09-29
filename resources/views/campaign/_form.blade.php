<style>
    .mygallerybox {background: #222d32 none repeat scroll 0 0;
    bottom: 0;
    left: 0;
    overflow: auto;
    position: fixed;
    top: 0;
    width: 230px;
    z-index: 10000;
    overflow-x: hidden;
    }
    .mygallerybox ul{
        padding: 0;
    text-align: center;
    }
</style>
<div class="form-group">
    {!! Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('name', null, array('id'=>'name','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>

<!--<div class="form-group">
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
</div>-->
@if(isset($campaign->backgroundimage))
    {!! Form::hidden('oldbackgroundimage',$campaign->backgroundimage) !!}
@endif
@if(isset($campaign->logoimage))
    {!! Form::hidden('oldlogoimage',$campaign->logoimage) !!}
@endif
{!! Form::hidden('backgroundimage') !!}
{!! Form::hidden('logoimage') !!}
{!! Form::hidden('description') !!}
<div class="form-group">
    {!! Form::label('fontcolor', 'Font Color', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('fontcolor', null, array('id'=>'fontcolor','class'=>'form-control my-colorpicker','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    <label class='col-sm-2 control-label'>&nbsp;</label>
    <div class="col-sm-10"><a class="opengallery" href="javascript:void(0)">Open Gallery</a><p>Drag and drop logo and background from gallary to below preview</p><p>click on content to edit</p></div>
</div>
<div class="box box-info no-border mygallerybox" style="display: none;">
    <div class="box-header with-border">
        <h3 class="box-title">Gallery</h3><i class="fa fa-fw fa-close pull-right closegallery"></i>
    </div>
    <div class="box-body">
        <ul class="" style="list-style: none">
            <li>
                <div class="timeline-item">
                    <div class="timeline-body galleryList">
                        <img src="/img/Clicspot-Grey.png" height="100" width="150" alt="..." class="margin">
                        <img src="/uploads/gallery/lg-logo.png" height="100" width="150" alt="..." class="margin">
                        <img src="/uploads/gallery/retina_wood.png" height="100" width="150" alt="..." class="margin">
                        <img src="/uploads/gallery/bg.png" height="100" width="150" alt="..." class="margin">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@include('campaign.preview')
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
