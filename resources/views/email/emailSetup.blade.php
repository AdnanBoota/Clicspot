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
                        <li class="current setupno">Setup<i class="fa fa-pencil pencil-show"></i>
                            <dl class="subdetail">
                                <dt>Name: </dt>
                                <dd class="ng-binding">MyCampaign</dd>

                                <dt>From Name:</dt>
                                <dd class="ng-binding">Nans</dd>

                                <dt>Email From Sender: </dt>
                                <dd class="ng-binding">nans.noel@gmail.com</dd>
                            </dl>
                        </li>
                        <li>Build
                            <dl class="subdetail">
                                <dt>Template used: </dt>
                                <dd class="ng-binding">Template 01</dd>    
                            </dl>
                        </li>
                        <li>Recipients
                            <dl class="subdetail">
                                <dt>Mailing lists:</dt>
                                <dd class="ng-binding">Email List 1</dd>    
                                <dd class="ng-binding">Email List 2</dd>    
                            </dl>
                        </li>
                        <li class="last">Confirm</li>
                    </ul>
                </div>
                <!--End :: progressbar --> 
            </div>
            {!! Form::open(array("method"=>"POST","class"=>"form-horizontal","url"=> url('emails/emailSetup'))) !!}
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
                required: "#radio1:checked"
            },
            'gender': {
                required:"#radio2:checked"
            },
            'age': {
                required:"#radio2:checked"
            },
            'router[]':{
                 required:"#radio2:checked"
            },
            'duringRecipientLastVisit':{
                 required:"#radio2:checked"
            },
            'numberofvisit': {
                 required:"#radio2:checked"
            },
            'recipientVisitVenue': {
                required:"#radio2:checked"
            },
            'numberofvisit': {
                required:"#radio2:checked"
            },
            'noOfDays': {
               required:"#radio2:checked"
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


            });
        }
    });
}
var getName = "";
$(document).ready(function() {
    var templateID
    var templateName
    var formName = "";
    var emailAddress = [];
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
            $(".backbtn").prop("href", "javascript:void(0)");
            console.log($(document).find(".currentForm").attr("id"));
            $("#currentFormIndex").val($(document).find(".currentForm").attr("id"));
            if ($(".stepform4").hasClass("currentForm")) {
                $(this).removeClass("nextbtn").addClass("sendMail").find(".nxtButton").html("Send");
            }
        }
    });
    $(document).on("click", ".backbtn", function() {
        var valid = $('form').valid();
        if (valid) {
            $(document).find(".currentForm").removeClass("currentForm").prev().addClass("currentForm");
            $(".setupstep").find(".setupno").last().removeClass("current active setupno").prev().removeClass("active");
            if ($(".stepform1").hasClass("currentForm")) {
                setTimeout(function() {
                    $(".backbtn").prop("href", "/emails");
                }, 100);
            }
            if ($(".stepbtn").find(".sendMail")) {
                $(".sendMail").removeClass("sendMail").addClass("nextbtn").find(".nxtButton").html("Next");
            }
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
    $("#currentFormIndex").val('1');
    $('#crtTempBtn').on('click', function() {
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
                "currentForm": '2'

            },
            success: function(result) {
                //  console.log(result.id);
                expiry = new Date();
                expiry.setTime(expiry.getTime() + (3600 * 60 * 1000));
                document.cookie = 'camEmailSetup=' + result.id + '; expires=' + expiry.toGMTString() + ';path=/';
                window.location.replace('/emails/create/');
            }


        });
    });
});
function delete_cookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
delete_cookie('camEmailSetup');
console.log("oon loassssd  sds sds:");
</script>

@endpush