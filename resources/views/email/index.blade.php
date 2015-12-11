@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('/css/platform-mailing.css') }}" rel="stylesheet" type="text/css"/>

@endpush
@section('content')
<style>
    /*    .deletebtn{
            display: none !important;
        }*/
</style>

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
            <!--<a class="deletebtn" href="#"><img src="{{ asset("img/deleteimg.png") }}" /></a>-->
            <table class="mailingtable" id="emailTemplate-table">
                <thead>
                    <tr>
<!--                        <th class="tchackboc">
                            <label class="">
                                <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" checked="" class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;" name="emailTemplateDelete[]" id="multicheck" value="hi"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>
                        </th>-->
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
        sDom: 'lrftip',
        processing: true,
        serverSide: true,
        responsive: true,
        info: false,
        bFilter: false,
        ajax: '',
        columns: [
//            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'templateName', name: 'templateName'},
            {data: 'description', name: 'description'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
$(document).ready(function() {
    $(document).on("change", ".emailDelCheckBox", function() {
        if ($(this).is(":checked")) {
            $(this).parent().addClass("checked");
        } else {
            $(this).parent().removeClass("checked");
        }
    });
    $(document).on("click", ".deletebtn", function() {
        console.log($(".emailDelCheckBox:checked").map(function() {
            return this.value;
        }).get().join(', '));
//                     $(this).attr("templateId");
//            jQuery.ajax({
//                                url: 'emails/' + id,
//                                type: 'DELETE',
//                                data: {
//                                    "_token": token
//                                },
//                                success: function (result) {
//                                    if (result.success) {
//                                        swal("success!", "Hotspot deleted successfully.", "success");
//                                        oTable.draw();
//                                    } else {
//                                        alert('false');
//                                        swal("ohh snap!", "something went wrong", "error");
//                                    }
//
//                                }
//                            });
    });
});
</script>

@endpush