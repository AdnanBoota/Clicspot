@extends('app')

@section('content')

<!-- Content Header (Page header) -->
<!--<section class="content-header">
    <h1>
        Email List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Email List</li>
        <li class="active">Create Email List</li>
    </ol>
</section>-->

<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-pencil-square-o"></i>
        <h1>{{ Lang::get('auth.createlist') }}</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="javascript:void(0);"><i class="fa fa-pencil"></i>{{ Lang::get('auth.createlist') }}</a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>{{ Lang::get('auth.editlist') }}</a></li>
            <li><a href="{{url('users')}}"><i class="fa fa-list-alt"></i>{{ Lang::get('auth.userlist') }}</a></li>
        </ul>
    </div>
</section>
<section class="profilepart">
    <div class="titleblock">
        <i class="fa fa-search"></i>
        <h1>{{ Lang::get('auth.profilefound') }}</h1>
    </div>
    <div class="row profilefound">
        <div class="col-md-4">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-facebook"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2 class="fbCount">{{$profileCount['fbCount']}}</h2>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa  fa-google-plus"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2 class="gCount">{{$profileCount['gCount']}}</h2>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2 class="eCount">{{$profileCount['eCount']}}</h2>

            </div>
            <!-- /.info-box -->
        </div>
    </div>
</section>

<section class="filterpart">
    <div class="titleblock">
        <h1>{{ Lang::get('auth.filter') }}</h1>
    </div>
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



        </div>
        <!-- /.col -->
    </div>
    <div class="filterform">

        <!-- form start -->
        {!! Form::open(array("class"=>"form-horizontal","url"=> url('emailList'))) !!}
        <div class="box-body">
            @include('emailList._form')
        </div>
<!--        <div class="box-footer">
            <button type="submit" class="btn btn-default">Cancel</button>
            <a href="{{url('emailList')}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-info pull-right">Submit</button>
        </div>-->
        <div class="editbottombtn">
        <!--    <a href="javascript:void(0);">Update</a>
            <a href="javascript:void(0);">Reset Preferences</a>
            <a href="javascript:void(0);">Save List</a>-->
            <a href="{{url('emailList/create')}}" >{{ Lang::get('auth.resetpref') }}</a>
            <button type="submit" class="">{{ Lang::get('auth.savelist') }}</button>
        </div>
        <!-- /.box-footer -->
        {!! Form::close() !!}
    </div>
</section>
@endsection