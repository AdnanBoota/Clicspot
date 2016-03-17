@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/>
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
        <h1>{{ Lang::get('auth.emailplatform') }}</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="javascript:void(0)" class="automaticMailForm"><i class="fa fa-pencil"></i>{{ Lang::get('auth.automail') }}</a></li>
            <li><a href="javascript:void(0)" class="manualMailingForm "  ><i class="fa fa-pencil-square-o"></i>{{ Lang::get('auth.manumail') }}</a></li>
        </ul>
    </div>
</section>

<section class="creatpart automaticMailing">
    <div class="titleblock">
        <i class="mailingicon">
            <img src="{{ asset("img/mailingicon.png") }}" />
        </i>
        <h1>{{ Lang::get('auth.automail') }}</h1>
    </div>
    
     
    
    <div class="newautomaticplatform">
       <table class="mailplateformnewtable">
            <thead>
                <th>Template</th>
                <th>Description</th>
                <th>Report</th>
                <th>Status</th>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ asset("img/riviewicon.png") }}" /><span><a href="{{ URL::to('emails/review') }}" style="color:#1abc9c">Review</a></span></td>
                    <td>Send a review email automatically after first time connexion. </td>
                    <td><canvas id="pieChart1"></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-1" {{ isset($hotspot->reviewstatus) && $hotspot->reviewstatus==1 ? 'checked="checked"' : '' }}>
                            <label for="cmn-toggle-1"></label>
                          </div>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{ asset("img/birthdayimg.png") }}" /><span>Birthday</span></td>
                    <td>Send out an email automatically for Users Birthday.</br> Works only with Facebook profile.  </td>
                    <td><canvas id="pieChart2"></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-2">
                            <label for="cmn-toggle-2"></label>
                          </div>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{ asset("img/fblikeicon.png") }}" /><span>Facebook Like</span></td>
                    <td>Increase your Facebook fans by asking them to like your page.</td>
                    <td><canvas id="pieChart3" ></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-3">
                            <label for="cmn-toggle-3"></label>
                          </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

 
    
    
</section>


<section class="creatpart automaticMailing" style="display: none;" id="emailTemplate">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>{{ Lang::get('auth.automail') }}</h1>
    </div>
    <div class="automailingblock">
        <a href="{{url('emails/emailSetup')}}"><img src="{{ asset("img/addicon.png") }}" /> {{ Lang::get('auth.createCampaign') }}</a>
        <div class="manualbtn">
<!--               <a href="#" class="sentbtn active"><i></i>Sent<span class="notiblk">{{  $sentCount[0]->totalSentCountCount }}</span></a>
            <a href="#" class="draftbtn "><i></i>Drafts<span class="notiblk">{{$draftCount[0]->totalDraftCount}}</span></a>-->
        </div>
        <div class="mailingtabledtl">

            <table class="mailingtable" id="emailTemplate-table">
                <thead>
                    <tr>

                        <th class="tchackboc">
                            <a class="deletebtn" href="javascript:void(0)" style="display: none;" id="deletebtn"><img src="{{ asset("img/deleteimg.png") }}" /></a>
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
        <h1>{{ Lang::get('auth.manumail') }}</h1>
    </div>
    <div class="automailingblock">
        <a href="{{url('emails/emailSetup')}}">{{ Lang::get('auth.createCampaign') }}</a>
        <div class="manualbtn">
            <a href="javascript:void(0)" class="sentbtn active" id="sentbtn"><i></i>{{ Lang::get('auth.sent') }}<span class="notiblk">{{  $sentCount[0]->totalSentCountCount }}</span></a>
            <a href="javascript:void(0)" class="draftbtn "><i></i>{{ Lang::get('auth.draft') }}<span class="notiblk">{{$draftCount[0]->totalDraftCount}}</span></a>
        </div>
        <div class="mailingtabledtl">
          
            <input type="hidden" value="" name="mailType" id="mailType">
            <table class="mailingtable" id="campaign-table">
                <thead>
                    <tr>
                        <th class="tchackboc">
                            <a class="deletebtn" href="javascript:void(0)" style="display: none;" id="campaignDelete"><img src="{{ asset("img/deleteimg.png") }}" /></a>
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
<script src="{{ asset('/plugins/chartjs/Chart.js') }}"></script>
<!--<script src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>-->
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript">
var oTableCampaign;
function  countChecked() {
    var n = $("input:checked").length; //n now contains the number of checked elements.
 //  $("#count").text(n + (n === 1 ? " is" : " zijn") + " aangevinkt!"); //show some text
    if (n == 0) {
        $(".deletebtn").fadeOut(); //if there are none checked, hide only visible elements
        $(".campaignDelete").fadeOut();
    } else {
        $(".deletebtn").fadeIn(); //otherwise (some are selected) fadeIn - if the div is hidden.
        $(".campaignDelete").fadeIn();
    }

}
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
            url: '/emails/campaignTable',
            "data": function(d) {
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
    var dataToFetch = "";
    var APP_URL = {!! json_encode(url('/')) !!};
    $(document).on("click", ".emailDelCheckBox", function() {
        countChecked();
        if ($(this).is(":checked")) {
            $(this).parent().addClass("checked");
            $(".deletebtn").show();
             $(".campaignDelete").show();
        } else {
            $(this).parent().removeClass("checked");
            // $(".deletebtn").hide("slow", !$('input[type="checkbox"]').is(":checked"));
        }
    });

    $(document).on("change", "#multicheck", function() {
//        alert("hello");
        if ($(this).is(":checked")) {
            $(".deletebtn").fadeIn();

            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', true);
            });
            $(".emailDelCheckBox").parent().addClass("checked");

        } else {
            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', false);
            });
            $(".deletebtn").fadeOut();
            $(".emailDelCheckBox").parent().removeClass("checked");
        }
    });

    $(document).on("click", "#deletebtn", function() {

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
                 $(".deletebtn").fadeOut();

            }
        });
    });
        $(document).on("click", "#campaignDelete", function() {

        var checkBoxValue = $(".emailDelCheckBox:checked").map(function() {
            return $(this).val();
        }).toArray();
        console.log(checkBoxValue);
        jQuery.ajax({
            url: '/campaignTemplate/' ,
            type: 'post',
            data: {
                "_method": 'post',
                "_token": '{{csrf_token()}}',
                "checkBoxValue":checkBoxValue

            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Campaign  deleted successfully.", "success");
                    oTableCampaign.draw();
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }
                 $(".deletebtn").fadeOut();

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

    $(document).on("click", ".automaticMailForm", function() {
        $(".automaticMailing").show();
        $("#emailTemplate").hide();
        $(".manualMailing").hide();
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
    $(document).on("click", ".manualMailingForm", function() {
         $("#sentbtn").trigger("click");
        $(".automaticMailing").hide();
        $(".manualMailing").show();
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");

    });
    $(document).on("click", ".draftbtn", function() {
        $(this).addClass("active");
        if ($(".sentbtn").hasClass("active")) {
            $(".sentbtn").removeClass("active");
        }
        $("#mailType").val("draft");
        oTableCampaign.draw();
    });

    $(document).on("click", "#sentbtn", function() {
        $(this).addClass("active");
        if ($(".draftbtn").hasClass("active")) {
            $(".draftbtn").removeClass("active");
        }
        $("#mailType").val("sent");
        oTableCampaign.draw();
    });
    
     $("#cmn-toggle-1").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
         $(this).val("1");
        }else{
            $(this).removeAttr("checked");
            $(this).val("0");
        }
         $.ajax({
               url:APP_URL+'/emails/reviewState/'+$(this).val(),
               type:'get',
               success:function(result){
                console.log(result);   
               }   
            });
    });
    $("#cmn-toggle-2").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
        }else{
            $(this).removeAttr("checked");
        }
    });
    $("#cmn-toggle-3").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
        }else{
            $(this).removeAttr("checked");
        }
    });
});
    
    var pieChartCanvas1 = $("#pieChart1").get(0).getContext("2d");
    var pieChart1 = new Chart(pieChartCanvas1);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      }, 
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      } 
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart1.Doughnut(PieData, pieOptions);
    
    var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
    var pieChart2 = new Chart(pieChartCanvas2);
    pieChart2.Doughnut(PieData, pieOptions);
    
    var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
    var pieChart3 = new Chart(pieChartCanvas3);
    pieChart3.Doughnut(PieData, pieOptions);
    
    
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      },
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      },
      {
        value: 300,
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "Opera"
      },
      {
        value: 100,
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "Navigator"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    
    
    
</script>


 


@endpush