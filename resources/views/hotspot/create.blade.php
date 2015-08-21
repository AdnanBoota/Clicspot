@extends('app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Hotspot
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hotspot</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-8">
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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Hotspot</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" name="hotspot-form" id="hotspot-form" role="form" method="POST" action="{{ url('hotspot') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="<?php echo isset($hotspotDetails) ? $hotspotDetails->id : '' ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="shortname" class="col-sm-2 control-label">Short Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="shortname" id="shortname" value="{{ isset($hotspotDetails) ? $hotspotDetails->shortname : old('shortname') }}"  placeholder="Short Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nasidentifier" class="col-sm-2 control-label">Identifier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nasidentifier" id="nasidentifier" value="{{ isset($hotspotDetails) ? $hotspotDetails->nasidentifier : old('nasidentifier') }}" placeholder="Identifier">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secret" class="col-sm-2 control-label">Secret</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="secret" id="secret" value="{{ isset($hotspotDetails) ? $hotspotDetails->secret : old('secret') }}"  placeholder="clicspot@wifi">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                        <a href="{{url('hotspot')}}" class="btn btn-default">cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
@push('scripts')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>

$(function () {




});
</script>

@endpush