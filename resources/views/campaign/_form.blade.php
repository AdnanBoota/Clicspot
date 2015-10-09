<style>
    .mygallerybox {background: #e2e2e2 none repeat scroll 0 0;
    bottom: 0;
    left: 0;
    overflow: auto; 
    
    width: 100%;
    height: 255px;
    z-index: 10000;
    overflow-x: hidden;
    margin-top: 10px;
    }
    .mygallerybox ul{
        padding: 0;
    }
    .closebox{
        position: fixed;
        top: 0;
        right:5px;
        
    }
    .plusicon{
     background: #333 none repeat scroll 0 0;
    border-radius: 50%;
    color: #fff;
    display: block;
    float: right;
    font-size: 23px;
    font-weight: bold;
    height: 30px;
    line-height: 28px;
    padding: 0;
    text-align: center;
    width: 30px;
}
    .lefControls p {
    font-size: 16px;
}
    .closegallery{
        background: #fff;
            border-radius: 5px;
    height: 26px;
    padding: 3px;
    width: 30px;
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


@include('campaign.preview')
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Set Template
</button>
