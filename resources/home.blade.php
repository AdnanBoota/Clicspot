@extends('app')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('errors.flash')
            <div class="box">
                <div class="box-header">Home</div>
                <div class="box-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection
