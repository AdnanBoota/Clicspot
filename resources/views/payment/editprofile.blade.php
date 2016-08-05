@extends('app')
@section('content')
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
<section class="content-header">
    <h1>
        {{ Lang::get('auth.payment') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ Lang::get('auth.home') }}</a></li>
        <li class="active">{{ Lang::get('auth.payment') }}</li>
        <li class="active">{{ Lang::get('auth.edituser') }}</li>
    </ol>
</section>
{!! Form::model($userDetails,["method"=>"POST","class"=>"form-horizontal","action"=> ['PaymentController@updateUser'],"files"=>"true"]) !!}
<div class="form-group">
    {!! Form::label('username',Lang::get("auth.usernm"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('username', null, array('id'=>'username','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', Lang::get("auth.email"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('email', null, array('id'=>'email','class'=>'form-control','required'=>'true')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('businessname',Lang::get("auth.business"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('businessname', null, array('id'=>'businessname','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address',Lang::get("auth.address"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('address', null, array('id'=>'ssid','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city', Lang::get("auth.city"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('city', null, array('id'=>'city','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('zip',Lang::get("auth.zipcode"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('zip', null, array('id'=>'zip','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('country',Lang::get("auth.country"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('country', null, array('id'=>'country','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('phone',Lang::get("auth.phone"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('phone', null, array('id'=>'phone','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('siren', Lang::get("auth.SIREN"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('siren', null, array('id'=>'phone','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('nvat', Lang::get("auth.vat"), array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!!  Form::text('nvat', null, array('id'=>'nvat','class'=>'form-control','required'=>'true')) !!}
    </div>
</div>
<div class="box-footer">
    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
    <a href="{{url('payment')}}" class="btn btn-default">{{ Lang::get("auth.cancel") }}</a>
    <button type="submit" class="btn btn-info pull-right">{{ Lang::get("auth.submit") }}</button>
</div>
<!-- /.box-footer -->
{!! Form::close() !!}

@endsection
