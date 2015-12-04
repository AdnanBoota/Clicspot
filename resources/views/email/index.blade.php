@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('/css/platform-mailing.css') }}" rel="stylesheet" type="text/css"/>

@endpush
@section('content')


<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>E-Mail Platform</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="#"><i class="fa fa-pencil"></i>Automatic Mailing</a></li>
            <li><a href="#"><i class="fa fa-pencil-square-o"></i>Manual Mailing</a></li>
        </ul>
    </div>
</section>
<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>Manual Mailing</h1>
    </div>
    <div class="automailingblock">
        <a href="{{url('emails/create')}}">Create Campaign</a>
        <div class="mailingtabledtl">
            <a class="deletebtn" href="#"><img src="{{ asset("img/deleteimg.png") }}" /></a>
            <table class="mailingtable" id="emailTemplate-table">
                <thead>
                    <tr>
                        <th>Template Name</th>
                        <th>Template Description</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


</section>


@endsection

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>

$(function() {
    oTable = $('#emailTemplate-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '',
        columns: [
            {data: 'templateName', name: 'templateName'},
            {data: 'description', name: 'description'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}          
        ]
    });
});
</script>

@endpush