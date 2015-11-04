@extends('app')

@section('content')

<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-pencil-square-o"></i>
        <h1>Create List</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li ><a href="{{url('emailList/create')}}"><i class="fa fa-pencil"></i>Create list</a></li>
            <li class="active"><a href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit list</a></li>
            <li><a href="{{url('users')}}"><i class="fa fa-list-alt"></i>User list</a></li>
        </ul>
    </div>
</section>
<section class="profilepart">
    <div class="titleblock">
        <i class="fa fa-search"></i>
        <h1>Profiles found</h1>
    </div>
    <div class="row profilefound">
        <div class="col-md-4">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-facebook"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2>15</h2>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa  fa-google-plus"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2>10</h2>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                <img src="/img/user-icon.png" alt="" class="user-icon">
                <h2>5</h2>

            </div>
            <!-- /.info-box -->
        </div>
    </div>
</section>

<section class="filterpart">
    <div class="titleblock">
        <h1>Filters</h1>
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
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($emailList,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['EmailListController@update',$emailList->id]]) !!}
                <div class="box-body">
                    @include('emailList._form')
                </div>
                <div class="editbottombtn">
        <!--    <a href="javascript:void(0);">Update</a>
            <a href="javascript:void(0);">Reset Preferences</a>
            <a href="javascript:void(0);">Save List</a>-->
            
            <button type="submit" class="">Update</button>
        </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
       
    <!-- /.row -->
</section><!-- /.content -->
@endsection
