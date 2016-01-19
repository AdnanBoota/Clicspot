@extends('app')
@push('styles')
<link href="{{ asset('/css/emailSetupProcess.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css"/>
<!--<link href="{{ asset('/css/datepicker3.css') }}" rel="stylesheet" type="text/css"/>-->
<link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
<!--<img src="{{asset("img/cameraiconwhite.png")}}" />-->

<div class="titleblock">
    <h1><i class="fa fa-send"></i>Send E-mail</h1>
</div>
<div class="page_content">
    <div class="container mainsection">
        <div class="row mainstepblock">
            <div class="col-md-3">
                <!--Begin :: progressbar -->
                <div class="setupstep">
                    <ul>
                        <li class="current active"><span class="setup">Setup</span></i>
                            <dl class="subdetail">
                                <dt>Name: </dt>
                                <dd class="ng-binding">{{isset($campaignData->campaignName) && $campaignData->campaignName != '' ? $campaignData->campaignName:''}}</dd>

                                <dt>From Name:</dt>
                                <dd class="ng-binding">{{isset($campaignData->fromName) && $campaignData->fromName != '' ? $campaignData->fromName:''}}</dd>

                                <dt>Email From Sender: </dt>
                                <dd class="ng-binding">{{isset($campaignData->senderEmail) && $campaignData->senderEmail != '' ? $campaignData->senderEmail:''}}</dd>
                            </dl>
                        </li>
                        <li><span class="setup">Build</span>
                            <dl class="subdetail">
                                <dt>Template used: </dt>
                                <dd class="ng-binding">Template 01</dd>    
                            </dl>
                        </li>
                        <li><span class="setup">Recipients</span>
                            <dl class="subdetail">
                                <dt>Mailing lists:</dt>
                                <dd class="ng-binding">Email List 1</dd>    
                                <dd class="ng-binding">Email List 2</dd>    
                            </dl>
                        </li>
                        <li class="last"><span class="setup">Confirm</span></li>
                    </ul>
                </div>
                <!--End :: progressbar --> 
            </div>
            {!! Form::model($campaignData,["method"=>"PATCH","class"=>"form-horizontal","action"=> ['EmailCampaignController@update',$campaignData->id]]) !!}

            @include('email._form')
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/js/sweetalert.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
var oTable;
var emailAddress = [];
$(function() {
    oTable = $('#emailCampaign-Table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        bPaginate: false,
        ajax: {
            "url": '/emails/emailSetup',
            type: 'GET',
            "data": function(d) {
                var listVal = "";
                listVal = $("#emailListId").val();
                var gender = $("#gender").val();
                var age = $("#age").val();
                var numberofvisit = $("#numberofvisit").val();
                var noOfDays = $("#duringRecipientLastVisit").val();
                var dateSelection = $("#datequickselection").val();
                var datequickselection = noOfDays * dateSelection;
                if (listVal)
                    d.listVal = listVal;
                if (gender)
                    d.gender = gender;
                if (age)
                    d.age = age;
                if (numberofvisit)
                    d.numberofvisit = numberofvisit;
                if (datequickselection)
                    d.datequickselection = datequickselection;
            }
        },
        columns: [
            {data: 'visitor', name: 'visitor'},
            {data: 'gender', name: 'gender'},
            {data: 'lastvisit', name: 'lastvisit'},
            {data: 'amountofvisit', name: 'amountofvisit'},
            {data: 'include', name: 'include', orderable: false, searchable: false}
        ]
    });
});
function validationForm() {
    $('form').validate({
        rules: {
            'campaignName': {
                required: true
            },
            'senderEmail': {
                required: true
            },
            'fromName': {
                required: true
            },
            'templateId': {
                required: true
            },
            'emailListId': {
                required: function(element) {
                    return $("input:radio[name='selectList']:checked").val() == 'customList';
                }
            },
            ' gender': {
                required: function(element) {
                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
                }
            },
//            'age': {
//                required: function(element) {
//                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
//                }
//            },
//            'numberofvisit': {
//                required: function(element) {
//                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
//                }
//            },
            'recipientVisitVenue': {
                required: function(element) {
                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
                }
            },
            'numberofvisit': {
                required: function(element) {
                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
                }
            },
            'noOfDays': {
                required: function(element) {
                    return $("input:radio[name='selectList']:checked").val() == 'quickList';
                }
            },
        },
        errorClass: "text-red",
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.context.name == 'x') {
                error.appendTo(element.parents(".col-md-8:last"));
            }
            else {
                error.appendTo(element.parents(".col-md-8:first"));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
            $(element).parents('.form-group').removeClass('has-success');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });
}

function sendCampaignMail(id, name, email, fromName, fromEmail) {
    jQuery.ajax({
        url: 'sendCampaignMail',
        type: 'post',
        data: {
            "_token": '{{csrf_token()}}',
            "templateId": id,
            "templateName": name,
            "emailAddress": email,
            "fromName": fromName,
            "fromEmail": fromEmail

        },
        success: function(result) {

            emailAddress = [];
            swal({
                title: "Campaign Send",
                text: "",
                type: "success",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ok",
                closeOnConfirm: true

            },
            function(response) {
            emailAddress=[];

            });

        }
    });
}
var getName = "";
$(document).ready(function() {
    var list = $('.setupstep ul li');
            var lengthLi = {{isset($campaignData->currentForm)? $campaignData->currentForm :''}};
      //     console.log("length" + lengthLi);
        $(list).each(function(i) {
    if (i < lengthLi) {
        if(i!=lengthLi-1){
        $(this).find(".setup").after('<a href="javascript:void(0)" class="editLink" id="' + (i+1) + '"><i class="fa fa-pencil pencil-show"></i></a>');
        $(this).addClass('current active setupno');
    }else{
           $(this).find(".setup").after('<a href="javascript:void(0)" class="editLink" id="' + (i+1) + '"><i class="fa fa-pencil pencil-show"></i></a>');
        $(this).addClass('current  setupno');
    }
    }
});
 if ($(".stepform4").hasClass("currentForm")) {
            $(".stepbtn").find(".nextbtn").removeClass("nextbtn").addClass("sendMail").find(".nxtButton").html("Send");
        }
console.log($(".setupstep ul").children().length);
var templateID =$("#templateId").val();
var templateName= $("#templateId option:selected").text();
var formName = "";
var myVal;
        var APP_URL = {!! json_encode(url('/')) !!};
$(".currentForm").show();
$("#age").ionRangeSlider({
    min: 1,
    max: 100
});
$("#numberofvisit").ionRangeSlider({
    min: 1,
    max: 100
});
$('#router').multiselect({
    includeSelectAllOption: true
});
validationForm();
$(document).on("click", ".nextbtn", function() {

    var valid = $('form').valid();
    if (valid) {
        $(document).find(".currentForm").removeClass("currentForm").next().addClass("currentForm");
           $(document).find(".setupno").addClass("active").next().addClass("current setupno");
//        $(document).find(".current").next().addClass("current active");
        $(".backbtn").prop("href", "javascript:void(0)");
        console.log($(document).find(".currentForm").attr("id"));
        $("#currentFormIndex").val($(document).find(".currentForm").attr("id"));
        if ($(".stepform4").hasClass("currentForm")) {
            $(this).removeClass("nextbtn").addClass("sendMail").find(".nxtButton").html("Send");
        }
    }
});
$(document).on("click", ".backbtn", function() {
   
   
        $(document).find(".currentForm").removeClass("currentForm").prev().addClass("currentForm");
       // $(".setupstep").find(".current").last().removeClass("current active");
         $(".setupstep").find(".setupno").last().removeClass("current active setupno").prev().removeClass("active");
        if ($(".stepform1").hasClass("currentForm")) {
            setTimeout(function() {
                $(".backbtn").prop("href", "/emails");
            }, 100);
        }
        if ($(".stepbtn").find(".sendMail")) {
            $(".sendMail").removeClass("sendMail").addClass("nextbtn").find(".nxtButton").html("Next");
        }
   
});

$(document).on("click", ".sendMail", function() {
    $.each($("input[name='checkbox[]']"), function() {
        if ($(this).is(":checked")) {
            emailAddress.push({"email": $(this).val()});
        }
    });
    var senderEmail = $("#senderEmail").val();
    var senderName = $("#senderName").val();
    sendCampaignMail(templateID, templateName, emailAddress, senderName, senderEmail);

});
$(document).on('change', '#templateId', function(e) {

    templateID = this.value;

    templateName = $("#templateId option:selected").text();
    $("#templatePreviewHidden").val(APP_URL + "/template_builder/html/"+{{$adminid}}+"/" + templateName + ".html");
    $("#templatePreview").attr("src", APP_URL + "/template_builder/html/"+{{$adminid}}+"/" + templateName + ".html");
});
$('#emailListId').on('change', function() {
    myVal = this.selectedOptions[0].value;
    oTable.draw();
});
$('form').on('change', '#gender,#age,#recipientVisitVenue,#numberofvisit,#duringRecipientLastVisit,#noOfDays', function() {
    var myName = $(this).attr('name');
    var fromAge = $("#recipientsFrom").val();

    var visitAmout = $("#amountVisit").val();
    var dateQickSelection = $("#noOfDays").val();

    if (dateQickSelection != "") {
        $("#datequickselection").val(dateQickSelection);
    } else {
        $("#datequickselection").val("1");
    }
    if (myName) {
        oTable.draw();
    }
});
$(document).on("click", "#sendTestAddress", function() {
    var testEmailAddress = [];
    testEmailAddress.push({"email": $("#testEmailAddress").val()});
    var senderEmail = $("#senderEmail").val();
    var senderName = $("#senderName").val();
    if (testEmailAddress.length != 0) {
        sendCampaignMail(templateID, templateName, testEmailAddress, senderName, senderEmail);
    }
});
$(document).on("click", ".editLink", function() {
    var currentId = $(this).attr("id");
          $("#currentFormIndex").val(currentId);
        $(".campaingnState").find(".currentForm").removeClass("currentForm");
        $(".campaingnState").find("#" + currentId).addClass("currentForm");
        $(".setupstep ul li").removeClass('current setupno active');
        $(".setupstep ul li").each(function(i) {
            if (i < currentId) {
                $(this).addClass('current setupno active');
                
            }
        });
    });
    $('#crtTempBtn').on('click',function(){
        var cmpName = $('input[name=campaignName]').val();
        var sndrEmail = $('input[name=senderEmail]').val();
        var frmName = $('input[name=fromName]').val();
        jQuery.ajax({
        url: '/emails/emailSetup/updateForm',
        type: 'post',
        data: {
            "_token": '{{csrf_token()}}',
            "campaignName": cmpName,
            "senderEmail": sndrEmail,
            "fromName": frmName,
            "id":{{$campaignData->id}},
            "currentForm": '2'

        },
        success: function(result) {
            expiry = new Date();
            expiry.setTime( expiry.getTime()+(3600*60*1000) );
            document.cookie='camEmailSetup='+{{$campaignData->id}}+'; expires='+ expiry.toGMTString() + ';path=/';
            window.location.replace('/emails/create/');
        }

        
    });
    });    
    });
    function delete_cookie(name) {
     document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
    delete_cookie('camEmailSetup');

</script>

@endpush