@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/> 
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


<section class="creatpart automaticMailing">
    <div class="titleblock">
        <i class="mailingicon">
            <img src="{{ asset("img/mailingicon.png") }}" />
        </i>
        <h1>{{ Lang::get('auth.automail') }}</h1>
    </div>
    
    
    <div class="emailreviewblock">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="reviewblockdetail">
                        <div class="reviewtitle">
                            <div class="switch">
                                <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-4" value="0">
                                <label for="cmn-toggle-4"></label>
                            </div>
                            <h2>Review</h2>
                        </div>
                        <p>Select the router that will be configured</p>
                        <div class="selectbox">
                          
                            {!!  Form::select('router[]', $routers, null, ['id'=>'router','tabindex'=>'8']) !!}
<!--                            <select>
                                <option>Krunchy Burger</option>
                                <option>Crepery Pen TY</option>
                                <option>Le Passy</option>
                            </select>-->
                        </div>
                        <p>Enter the URL of your choice. This must be the page where your customer fill up the review form.</p>
                        <div class="urlreviewblock ">
                            <div class="urlreview">
                                <input type="url" id="socialmedia" placeholder="Enter the URL">
                            </div>
                            <ul class="reviewimg">
                                <li class="" id="trip"><i class="tripimg"></i></li>
                                <li id="yoff" class=""><i class="yoffimg"></i></li>
                                <li id="gplus" class=""><i class="gplusimg"></i></li>
                                <li id="fb" class=""><i class="fbimg"></i></li>
                            </ul>
                            <p class="successnote">The URL is valid.</p>
                            <p class="errornote">Make sure the URL that you used is the good one, follow the screencast above following which website
you want to use.</p>
                        </div> 
                        <p>Choose the period between the connexion and the email sent.</p>
                        <div class=""><input id="range_5" type="text" name="range_5" data-from=""></div>    
                        <p>Choose the email template, it will be translated into differents languages.</p>
                    </div>
                </div>
                <div class="col-md-5">
                     <div class="box box-danger">
                        <div class="box-header with-border">
                          <h3 class="box-title">Statistic report</h3> 
                          <div class="box-tools pull-right">
                            <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i>
                            </button>
                            <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <canvas style="height: 324px; width: 648px;" id="pieChart" width="648" height="324"></canvas>
                        </div> 
                  </div>
                </div>
            </div>
            <div class="row">
                 <div class="reviewtabdetial"> 
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Standard" aria-controls="Standard" role="tab" data-toggle="tab">Standard</a></li>
                    <li role="presentation"><a href="offertab" aria-controls="offertab" role="tab" data-toggle="tab">10% OFF </a></li> 
                  </ul> 
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Standard">
                        
                        <div class="tabdetailtitle">
                            <div class="tabdetailtitleleft">
                                <h3>{{ Lang::get('auth.visiting') }} <span class="shortname"></span> !</h3>
                                <span>From: {{ $email }}</span>
                            </div>
                            <div class="tabdetailtitleright">
                                <span>15 {{ Lang::get('auth.feb') }}, 2015 11:03 PM</span>
                            </div>
                        </div> 
                        <div class="rtabcontentdetail">
                            <p>Hi {{-- $userDetail->name or '' --}},</p>
                            <p>{{ Lang::get('auth.visiting') }} <span class="shortname"></span>{{-- $hotspot->shortname or ''--}} - {{ Lang::get('auth.hope') }} </p>
    <p>{{ Lang::get('auth.leavefeedback') }}</p>
    <br>
    <h3>{{ Lang::get('auth.recommend') }} <span class="shortname"></span>{{-- $hotspot->shortname or '' --}} {{ Lang::get('auth.tofriend') }}</h3>
    
    <a style="" href="{{ url("/") }}/feedback/{{-- $feedback_code --}}" target="_blank">{{ Lang::get('auth.goodtime') }}</a>
	<br><br>
	<a href="mailto:{{-- $userDetail->email or 'survey@clicspot.fr' --}}?subject=Thank you for taking the time to answer our survey!&body=We%20appreciate%20the%20feedback.%0D%0A%0D
	We%20strive%20to%20always%20provide%20the%20best%20services%20but%20sometimes%20it%20could%20happen%20that%20our%20client%20are%20not%20fully%20satisfied.%0D%0A%0D
	Would%20you%20give%20us%20your%20opinion%20and%20your%20recommendation%20to%20improve%20our%20services%20?%0D%0A%0D
	Thank%20you%0D%0A%0D
	{{-- $hotspot->shortname or '' --}} Team%0D%0A%0D
	Please, type%20your%20comment%20below&#58;%0D%0A%0D%0D%0A%0D" target="_top">{{ Lang::get('auth.tellyou') }}</a>
    <br><br>
    <p>{{ Lang::get('auth.notequestion') }}</p>
    <p>{{ Lang::get('auth.feedback-it') }}</p>
    <br>
    <p>{{ Lang::get('auth.regards') }}</p>
    <p><span class="shortname"></span>{{-- $hotspot->shortname or '' --}} {{ Lang::get('auth.team') }}</p>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="offertab ">...</div> 
                  </div> 
                </div>
            </div>
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
var dataToFetch = "";
     var routerID="";
     var APP_URL = {!! json_encode(url('/')) !!};
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
    
      $(document).on('change', '#router', function(e) {
         if(this.value!=""){
           var templateName = $("#router option:selected").text();
           $(".shortname").html(templateName);
          routerID= this.value;
          $.ajax({
            url:APP_URL+'/emails/getHotspotDetail/'+routerID,
         type:'get',
         success:function(data){
           
           $.each(data,function(index,obj){
            $.each(obj,function(i,o){
               console.log("key",i);    
               if(i=="tripAdvisorId"){
                   $("#socialmedia").val(o);
                    $("#socialmedia").trigger('blur');
               }
               if(i=="reviewstatus"){
                   console.log(o);
                   if(o=="1"){
                       //$(".switch").html("<input type='checkbox' class='cmn-toggle cmn-toggle-round' id='cmn-toggle-4' checked='checked' value='1'><label for='cmn-toggle-4'></label>");
                       $("#cmn-toggle-4").prop("checked",true);
                   }
                   else if(o=="0"){
                       //$(".switch").html("<input type='checkbox' class='cmn-toggle cmn-toggle-round' id='cmn-toggle-4' value='0'><label for='cmn-toggle-4'></label>");
                       $("#cmn-toggle-4").prop("checked",false);
                   }
               }
               if(i=="reviewEmailDelay"){
                   console.log(o);
//                   $("#range_5").data("from",o);
var slider = $("#range_5").data("ionRangeSlider");
                   slider.update({
                        from: o
                            });
                    }
               
           });
            
           });
         }
          });
          }
      });
      
        $("#socialmedia").blur(function(){
            var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
            var urlval=$(this).val();
            if(pattern.test(urlval)){
                if(urlval.indexOf("tripadvisor")!=-1 || urlval.indexOf("facebook")!=-1 || urlval.indexOf("google")!=-1 || urlval.indexOf("yelp")!=-1){
                    if(routerID.length>0)
                        reviewUpdate(routerID,'tripAdvisorId',urlval);
                
                    $(".urlreviewblock ").removeClass("error");
                    $(".urlreviewblock ").addClass("successful");
                   
                    if(urlval.indexOf("tripadvisor.in")!=-1){
                        $("#trip").addClass('active');
                        $("#yoff").removeClass('active');
                        $("#gplus").removeClass('active');
                        $("#fb").removeClass('active');
                }
                    else if(urlval.indexOf("facebook.com")!=-1){
                         $("#trip").removeClass('active');
                        $("#yoff").removeClass('active');
                        $("#gplus").removeClass('active');
                        $("#fb").addClass('active');
                        
                    }    
                    else if(urlval.indexOf("google.com")!=-1){
                         $("#trip").removeClass('active');
                        $("#yoff").removeClass('active');
                        $("#gplus").addClass('active');
                        $("#fb").removeClass('active');
                    }
                    else if(urlval.indexOf("yelp.com")!=-1){
                         $("#trip").removeClass('active');
                        $("#yoff").addClass('active');
                        $("#gplus").removeClass('active');
                        $("#fb").removeClass('active');
                    }
                    
                    
                }else{
                    $(".urlreviewblock ").removeClass("successful");
                    $(".urlreviewblock ").addClass("error");
                }
            }else{
                $(".urlreviewblock ").removeClass("successful");
                 $(".urlreviewblock ").addClass("error");
            }
        });
        
        $("#cmn-toggle-4").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
         $(this).val('1');
         var onoff=$(this).val();
          if(routerID.length>0)
                        reviewUpdate(routerID,'reviewstatus',onoff);
        }else{
            $(this).removeAttr("checked");
            $(this).val('0');
            var onoff=$(this).val();
          if(routerID.length>0)
                        reviewUpdate(routerID,'reviewstatus',onoff);
        }
    });
    $("#range_5").ionRangeSlider({
      min: 0,
      max: 86400,
      type: 'single',
      step: 1,
      //postfix: " hr",
     prettify: function (value) {
                if (value <=3600) {
                    
                    return Math.round(value/60) + ' Min';
                } else {
                   return Math.round(value / 3600) + ' Hr';
                }
            },
      hasGrid: true,
       onFinish: function (data) {
                reviewUpdate(routerID,'reviewEmailDelay',data.from);
            }
    });
    
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
        $(".manualMailing").hide();
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
    $(document).on("click", ".manualMailingForm", function() {
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

    $(document).on("click", ".sentbtn", function() {
        $(this).addClass("active");
        if ($(".draftbtn").hasClass("active")) {
            $(".draftbtn").removeClass("active");
        }
        $("#mailType").val("sent");
        oTableCampaign.draw();
    });
});
    
    var pieChartCanvas1 = $("#pieChart").get(0).getContext("2d");
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
    
//    var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
//    var pieChart2 = new Chart(pieChartCanvas2);
//    pieChart2.Doughnut(PieData, pieOptions);
//    
//    var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
//    var pieChart3 = new Chart(pieChartCanvas3);
//    pieChart3.Doughnut(PieData, pieOptions);
//    
    
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
     
     
  function reviewUpdate(nasId,fieldName,fieldVal){
      //console.log(APP_URL+'/emails/reviewUpdate/'+nasId+'/'+fieldName+'/'+fieldVal);
        $.ajax({
        // url:APP_URL+'/emails/reviewUpdate/'+nasId+'/'+fieldName+'/'+fieldVal,
         url:APP_URL+'/emails/reviewUpdate',
         type:'post',
         data:'nasId='+nasId+'&fieldName='+fieldName+'&fieldVal='+fieldVal+"&_token={{ csrf_token() }}",
         success:function(data){
          console.log(data);   
         }
      });
  }
</script>

<script>
    
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider();
   
     
      
      
        
      
  });
 
  
  
  
</script>


 


@endpush