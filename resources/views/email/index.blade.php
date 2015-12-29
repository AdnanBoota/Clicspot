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
    .automailingblock{
        overflow: visible;
    }
    .dropdown-menu span a{
        color: #69737f !important;
        background: none;
        border-radius: none;
        margin: 0px;
    }
    #templateName{
        display: block;
    }
</style>

<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>E-Mail Platform</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="javascript:void(0)" class="automaticMailForm"><i class="fa fa-pencil"></i>Automatic Mailing</a></li>
            <li><a href="javascript:void(0)" class="manualMailingForm"><i class="fa fa-pencil-square-o"></i>Manual Mailing</a></li>
        </ul>
    </div>
</section>
<section class="creatpart automaticMailing">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>Automatic Mailing</h1>
    </div>
      <div class="automailingblock">
        <a href="{{url('emails/emailSetup')}}"><img src="{{ asset("img/addicon.png") }}" /> Create Campaign</a>
        <div class="manualbtn">
<!--               <a href="#" class="sentbtn active"><i></i>Sent<span class="notiblk">{{  $sentCount[0]->totalSentCountCount }}</span></a>
            <a href="#" class="draftbtn "><i></i>Drafts<span class="notiblk">{{$draftCount[0]->totalDraftCount}}</span></a>-->
        </div>
        <div class="mailingtabledtl">
            <a class="deletebtn" href="#"><img src="{{ asset("img/deleteimg.png") }}" /></a>
            <table class="mailingtable" id="emailTemplate-table">
                <thead>
                    <tr>
                        <th class="tchackboc">
                            <label class="">
                                <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;" name="emailTemplateDelete[]" id="multicheck" value=""><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>
                        </th>
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
<section class="creatpart manualMailing" style="display: none;">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>Manual Mailing</h1>
    </div>
    <div class="automailingblock">
        <a href="{{url('emails/emailSetup')}}">Create Campaign</a>
         <div class="manualbtn">
            <a href="javascript:void(0)" class="sentbtn active"><i></i>Sent<span class="notiblk">{{  $sentCount[0]->totalSentCountCount }}</span></a>
            <a href="javascript:void(0)" class="draftbtn "><i></i>Drafts<span class="notiblk">{{$draftCount[0]->totalDraftCount}}</span></a>
        </div>
        <div class="mailingtabledtl">
            <a class="deletebtn" href="#"><img src="{{ asset("img/deleteimg.png") }}" /></a>
            <input type="hidden" value="" name="mailType" id="mailType">
            <table class="mailingtable" id="campaign-table">
                <thead>
                    <tr>
                        <th class="tchackboc">
                            <label class="">
                                <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;" name="emailTemplateDelete[]" id="multicheck" value=""><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>
                        </th>
                        <th>Campaign Name</th>
                        <th>Statistics</th>
                        <th></th>
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
<script type="text/javascript">
var oTableCampaign;

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
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'templateName', name: 'templateName'},
            {data: 'description', name: 'description'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
$(function() {
            oTableCampaign = $('#campaign-table').DataTable({
        sDom: 'lrftip',
        processing: true,
        serverSide: true,
        responsive: true,
        info: false,
        bFilter: false,
        ajax: {
            url:'/emails/campaignTable',
            "data":function(d) {
                    mailType = $("#mailType").val();
                       if (mailType)
                    d.mailType = mailType;
            }
         },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'campaignName', name: 'campaignName'},
            {data: 'statistics', name: 'statistics'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
$(document).ready(function() {
   var dataToFetch="";

    $(document).on("change", ".emailDelCheckBox", function() {
        if ($(this).is(":checked")) {
            $(this).parent().addClass("checked");
        } else {
            $(this).parent().removeClass("checked");
        }
    });
    $(document).on("change", "#multicheck", function() {
//        alert("hello");
        if ($(this).is(":checked")) {

            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', true);
            });
            $(".emailDelCheckBox").parent().addClass("checked");

        } else {
            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', false);
            });
            $(".emailDelCheckBox").parent().removeClass("checked");
        }
    });

    $(document).on("click", ".deletebtn", function() {

        var checkBoxValue = $(".emailDelCheckBox:checked").map(function() {
            return $(this).val();
        }).toArray();
        console.log(checkBoxValue);
        jQuery.ajax({
            url: 'emails/' + checkBoxValue,
            type: 'post',
            data: {
                "_method": 'delete',
                "_token": '{{csrf_token()}}'

            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Template  deleted successfully.", "success");
                    oTable.draw();
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }

            }
        });
    });

    $(document).on("click", ".duplicateTemplate", function() {
        var templateId = $(this).attr("id");
        console.log(templateId);
        jQuery.ajax({
            url: 'emails/duplicateTemplate/' + templateId,
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}'
            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Template  Duplicated successfully.", "success");
                    oTable.draw();
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }

            }
        });
    });

    $(document).on("click", ".renameTemplate", function() {
        var templateId = $(this).attr("id");
        var templateName = $(this).attr("templateName");
        console.log(templateId);
        swal({
            title: "Template Rename",
            text: '<input class="visibleInput" id="templateName" type="text" name="templateName" value="' + templateName + '" placeholder="Enter Template Name">',
            html: true,
            showCancelButton: true,
        },
                function(response) {
                    if (response == true) {
                        templateName = $("#templateName").val();
                        var templateDescription = $("#templateDesc").val();
                        jQuery.ajax({
                            url: 'emails/rename/' + templateId,
                            type: 'POST',
                            data: {
                                "templateName": templateName,
                                "_token": '{{csrf_token()}}'
                            },
                            success: function(result) {
                                swal({
                                    title: "Template is Renamed Successfully",
                                    text: "",
                                    type: "success",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: true
                                },
                                function(response) {
                                    if (response == true) {
                                        oTable.draw();
                                    }
                                    else {
                                        return false;
                                    }
                                });
                            }
                        });
                    }
                });
    });
    
    $(document).on("click",".automaticMailForm",function(){
        $(".automaticMailing").show();
        $(".manualMailing").hide();
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
      $(document).on("click",".manualMailingForm",function(){
        $(".automaticMailing").hide();
        $(".manualMailing").show();
           $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");
     
    });
    $(document).on("click",".draftbtn",function(){
        $(this).addClass("active");
        if($(".sentbtn").hasClass("active")){
            $(".sentbtn").removeClass("active");
        }
       $("#mailType").val("draft");
        oTableCampaign.draw();
    });
    
    $(document).on("click",".sentbtn",function(){
        $(this).addClass("active");
        if($(".draftbtn").hasClass("active")){
            $(".draftbtn").removeClass("active");
        }
         $("#mailType").val("sent");
         oTableCampaign.draw();
    });
});
</script>

@endpush