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
        <h1><i class="fa fa-send"></i>{{ Lang::get('auth.sendmail')}}</h1>
    </div>
    <div class="page_content">
        <div class="container mainsection">
            <div class="row mainstepblock">
                <div class="col-md-3">
                    <!--Begin :: progressbar -->
                    <div class="setupstep">
                        <ul>

                            <li class="current setupno">{{ Lang::get('auth.temp')}}<i class="fa fa-pencil pencil-show"></i>
                                <!--<dl class="subdetail">
                                <dt>{{ Lang::get('auth.tempuse')}}: </dt>
                                <dd class="ng-binding" id="templateGetName">{{ isset($emailTemp->templateName) ? $emailTemp->templateName : '' }}</dd>
                            </dl>
							-->
                                <dl class="subdetail">
                                    <dt>{{ Lang::get('auth.tempuse')}}: </dt>
                                    <dd class="ng-binding" id="templateGetName">{{ Lang::get('auth.temp')}} 01</dd>

                                </dl>
                            </li>
                            <li>{{ Lang::get('auth.setup')}}
                                <!--<dl class="subdetail">
                                <dt>{{ Lang::get('auth.name')}}: </dt>
                                <dd class="ng-binding" id="campaignGetName">{{ Lang::get('auth.mycampaign')}}</dd>

                                <dt>{{ Lang::get('auth.Formname')}}:</dt>
                                <dd class="ng-binding">{{isset($campaignData->fromName) && $campaignData->fromName != '' ? $campaignData->fromName:''}}</dd>

                                <dt>{{ Lang::get('auth.emailfromsender')}}: </dt>
                                <dd class="ng-binding">{{isset($campaignData->subjectEmail) && $campaignData->subjectEmail != '' ? $campaignData->subjectEmail:''}}</dd>
                            </dl>
							    -->
                                <dl class="subdetail">
                                    <dt>{{ Lang::get('auth.name')}}: </dt>
                                    <dd class="ng-binding" id="campaignGetName">{{ Lang::get('auth.mycampaign')}}</dd>

                                    <dt>{{ Lang::get('auth.Formname')}}:</dt>
                                    <dd class="ng-binding" id="fromName"></dd>

                                    <dt>{{ Lang::get('auth.subjectemail')}}: </dt>
                                    <dd class="ng-binding" id="subjectGetEmail">{{ Lang::get('auth.subjectemail')}}</dd>

                                </dl>
                            </li>

                            <li>{{ Lang::get('auth.recipients')}}
                                <dl class="subdetail">
                                    <dt>{{ Lang::get('auth.maillist')}}:</dt>
                                    <dd class="ng-binding" id="emailGetList"></dd>
                                    <dd class="ng-binding" id="emailGetList"><?php echo isset($emailListId->listname) ? $emailListId->listname : ''; ?></dd>
                                </dl>
                            </li>
                            <li class="last">{{ Lang::get('auth.confirm')}}</li>
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
<!-- Raty plugin me@diegopucci.com pucci_diego -->
<script type="text/javascript" src="{{ asset('/plugins/raty/jquery.raty.js') }}"></script>


<script type="text/javascript">
    var oTable;
    var dateshedule;
    var total=0;
    $(function() {
        var fbCount;
        var gplusCount;
        var mailCount;
        var recipientsAgeRangeFltrStatus = 1;
        var langFilterStatus = 1;
        var starsFilterStatus = 1;
        var routerFltrStatus = 1;
        var visitsFltrStatus = 1;
        var duringFltrStatus = 1;

        oTable = $('#emailCampaign-Table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            bPaginate: false,
            "drawCallback": function (settings) {
                $(".raty").raty({
                    readOnly: true,
                    score: function () {
                        //oTable.draw();
                        return $(this).attr('data-score');
                    }
                });
            },
            ajax: {
                "url": '/emails/emailSetup',
                "type": 'GET',
                "data": function(d) {
                    var listVal = "";
                    listVal = $("#emailListId").val();
                    var gender = $("#gender").val();
                    var age = $("#age").val();
                    var numberofvisit = $("#numberofvisit").val();
                    var noOfDays = $("#duringRecipientLastVisit").val();
                    var dateSelection = $("#datequickselection").val();
                    var router = $("#router").val();
                    var datequickselection = noOfDays * dateSelection;


                    //edited by me@diegopucci.com @pucci_diego
                    var languages = $("#languages").val();
                    if(langFilterStatus == 1){
                        if (languages)
                            d.languages = languages;
                    }

                    var stars = $(".starsFilter").attr('data-score');
                    if(starsFilterStatus == 1){
                        if (stars)
                            d.stars = stars;
                    }

                    /*
                    console.log('- - - -');
                    console.log(noOfDays);
                    console.log(dateSelection);
                    console.log('! ! ! ! ');
                    */

                    if (listVal)
                        d.listVal = listVal;
                    if (gender)
                        d.gender = gender;

                    if(recipientsAgeRangeFltrStatus == 1){
                        if (age)
                            d.age = age;
                    }
                    if(routerFltrStatus == 1){
                        if (router)
                            d.routerArr = router;
                    }
                    if(visitsFltrStatus == 1){
                        if (numberofvisit)
                            d.numberofvisit = numberofvisit;
                    }
                    //console.log(datequickselection);
                    if(duringFltrStatus == 1){
                        /*
                        console.log('aaaaaa');
                        console.log(datequickselection);
                        */
                        if (datequickselection)
                            d.datequickselection = datequickselection;
                    }
                },
            },
            columns: [
//                    data: 'favoredconnection', name: 'favoredconnection'},
                {data: 'review', name: 'review', orderable: false, searchable: false},
                {data: 'visitor', name: 'visitor'},
                {data: 'language', name: 'language'},
                {data: 'lastvisit', name: 'lastvisit'},
                {data: 'amountofvisit', name: 'amountofvisit'},
                {data: 'include', name: 'include', orderable: false, searchable: false}
            ]
        });

        oTable.on( 'xhr', function () {
            var json = oTable.ajax.json();
            if(json.data.length > 0){
                fbCount = json.data[0].fbCount;
                gplusCount = json.data[0].gplusCount;
                mailCount = json.data[0].mailCount;

                $("#fb_count").html(fbCount);
                //$("#gplus_count").html(gplusCount);
                //edited by me@diegopucci.com pucci_diego
                $("#mail_count").html((mailCount+gplusCount));
            }else{
                $("#fb_count").html(0);
                $("#gplus_count").html(0);
                $("#mail_count").html(0);
            }
        });

        $(document).on('click','.mailCheckBox', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                mailCount--
            }else{
                $(this).attr('checkstatus', 1);
                mailCount++
            }
            $("#mail_count").html(mailCount);
        });

        $(document).on('click','.fbCheckBox', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                fbCount--
            }else{
                $(this).attr('checkstatus', 1);
                fbCount++
            }
            $("#fb_count").html(fbCount);
        });

        $(document).on('click','.gplusCheckBox', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                gplusCount--
            }else{
                $(this).attr('checkstatus', 1);
                gplusCount++
            }
            $("#gplus_count").html(gplusCount);
        });

        $('select#router').on('change', function() {
            if(routerFltrStatus == 1){
                oTable.draw();
            }
        });

        //added by me@diegopucci.com @pucci_diego
        $('select#languages').on('change', function() {
            if(langFilterStatus == 1){
                oTable.draw();
            }
        });

        $(".starsFilter").raty({
            score: function () {
                //oTable.draw();
                return $(this).attr('data-score');
            },
            click: function(score, evt){
                $(this).attr('data-score', score);
                if(starsFilterStatus == 1) {
                    oTable.draw();
                }
            }
        });
        //added by me@diegopucci.com @pucci_diego ENDs


        $(document).on('click','.recipientsAgeRangeFltrStatus', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                recipientsAgeRangeFltrStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                recipientsAgeRangeFltrStatus = 1
            }
            oTable.draw();
        });

        $(document).on('click','.routerFltrStatus', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                routerFltrStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                routerFltrStatus = 1
            }
            oTable.draw();
        });

        //added by me@diegopucci.com @pucci_diego BEGIN
        $(document).on('click','.langFilterStatus', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                langFilterStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                langFilterStatus = 1
            }
            oTable.draw();
        });

        $(document).on('click','.starsFilterStatus', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                starsFilterStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                starsFilterStatus = 1
            }
            oTable.draw();
        });
        //added by me@diegopucci.com @pucci_diego END

        $(document).on('click','.visitsFltrStatus', function() {
            console.log(visitsFltrStatus);
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                visitsFltrStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                visitsFltrStatus = 1
            }
            oTable.draw();
        });

        $(document).on('click','.duringFltrStatus', function() {
            var checkStatus = $(this).attr('checkstatus');
            if(checkStatus == 1){
                $(this).attr('checkstatus', 0);
                duringFltrStatus = 0
            }else{
                $(this).attr('checkstatus', 1);
                duringFltrStatus = 1
            }
            oTable.draw();
        });



        $("[name=shedule]").change(function(){
            if($(this).val()=="now"){
                $(".date").hide();
                dateshedule=$(this).val();
            }else{
                $(".date").show();
                dateshedule=$(this).val();
            }
        });
        /// getting social count

//     jQuery.ajax({
//        "url": '/emails/emailSetupCount',
//        type: 'GET',
//        data:{ 'listVal' : $("#emailListId").val() },
//        success: function(result) {
//            var jsonParse=$.parseJSON(result);
//            $("#fbcount").html(jsonParse.fbcount);
//            $("#gpluscount").html(jsonParse.gpluscount);
//            $("#mailcount").html(jsonParse.mailcount);
//        }
//    });



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
                'subjectEmail':{
                    required: true,
                    email:true
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
                //added by me@diegopucci.com @pucci_diego
                'languages[]':{
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

    function sendCampaignMail(id, name, email, fromName, fromEmail,subjectEmail) {

        swal({title:"" ,imageUrl: "{{url()}}/img/loadingBig.gif", showConfirmButton:false,      allowOutsideClick:false});

        jQuery.ajax({
            url: 'sendCampaignMail',
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}',
                "templateId": id,
                "templateName": name,
                "emailAddress": email,
                "fromName": fromName,
                "fromEmail": fromEmail,
                "subjectEmail":subjectEmail,
                "campaignName":$("#campaignName").val(),
                "subjectEmail":$("#subjectEmail").val(),
                "templateId":$("#templateId").val(),
                "emailListId":$("#emailListId").val(),
                "gender":$("#gender").val(),
                "age":$("#age").val(),
                "router":$("#router").val(),
                "languages" : $("#languages").val(), //added by me@diegopucci.com @pucci_diego
                "stars" : $(".starsFilter").attr('data-score'), //added by me@diegopucci.com @pucci_diego
                "numberofvisit":$("#numberofvisit").val(),
                "duringRecipientLastVisit":$("#duringRecipientLastVisit").val(),
                "noOfDays":$("#noOfDays").val(),
                'scheduleTime':$("#scheduleTime").val(),
                'shedule':dateshedule,
                'campaignStatus':'send',
                'radio1':$('#radio1').val(),
                'radio2':$('#radio2').val(),
                'datequickselection':$("#datequickselection").val(),
                'currentForm':'4',
                'templatePreview':$("#templatePreviewHidden").val(),
                'testEmailAddress':$("#testEmailAddress").val(),
                'timepicker':$("#timepicker").val(),


            },
            success: function(result) {
                console.log(result);
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

                            window.location.href = "/emails";
                        });
            }
        });
    }
    function scheduleCampaignMail(id, name, email, fromName, fromEmail,subjectEmail) {

        swal({title:"" ,imageUrl: "{{url()}}/img/loadingBig.gif", showConfirmButton:false,      allowOutsideClick:false});

        jQuery.ajax({
            url: 'scheduleCampaignMail',
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}',
                "templateId": id,
                "templateName": name,
                "emailAddress": email,
                "fromName": fromName,
                "fromEmail": fromEmail,
                "subjectEmail":subjectEmail,
                "campaignName":$("#campaignName").val(),
                "subjectEmail":$("#subjectEmail").val(),
                "templateId":$("#templateId").val(),
                "emailListId":$("#emailListId").val(),
                "gender":$("#gender").val(),
                "age":$("#age").val(),
                "router":$("#router").val(),
                "languages" : $("#languages").val(), //added by me@diegopucci.com @pucci_diego
                "stars" : $(".starsFilter").attr('data-score'),  //added by me@diegopucci.com @pucci_diego
                "numberofvisit":$("#numberofvisit").val(),
                "duringRecipientLastVisit":$("#duringRecipientLastVisit").val(),
                "noOfDays":$("#noOfDays").val(),
                'scheduleTime':$("#scheduleTime").val(),
                'campaignStatus':'schedule',
                'radio1':$('#radio1').val(),
                'radio2':$('#radio2').val(),
                'datequickselection':$("#datequickselection").val(),
                'currentForm':'4',
                'templatePreview':$("#templatePreviewHidden").val(),
                'testEmailAddress':$("#testEmailAddress").val(),
                'timepicker':$("#timepicker").val()

            },
            success: function(result) {
                console.log(result);
                emailAddress = [];
                swal({
                            title: "Schedule created successfully",
                            text: "",
                            type: "success",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true

                        },
                        function(response) {

                            //         window.location.href='/emails';
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
        var emailname=[];
        var myVal;
        var APP_URL = {!! json_encode(url('/')) !!};
    $(".currentForm").show();
    $("#age").ionRangeSlider({
        min: 1,
        max: 100,
        onFinish: function (data) {
            var checkStatus = $(recipientsAgeRangeFltrStatus).attr('checkstatus');
            if(checkStatus == 1){
                oTable.draw();
            }
        }
    });
    $("#numberofvisit").ionRangeSlider({
        min: 1,
        max: 100,
        onFinish: function (data) {
            var checkStatus = $(visitsFltrStatus).attr('checkstatus');
            if(checkStatus == 1){
                oTable.draw();
            }
        }
    });

    $('form').on('change', '#duringRecipientLastVisit, #noOfDays', function() {
        var dateQickSelection = $("#noOfDays").val();
        if (dateQickSelection != "") {
            $("#datequickselection").val(dateQickSelection);
        } else {
            $("#datequickselection").val("1");
        }

        var checkStatus = $(duringFltrStatus).attr('checkstatus');
        if(checkStatus == 1){
            oTable.draw();
        }
    });

    $('#router').multiselect({
        includeSelectAllOption: true
    });

    //added by me@diegopucci @pucci_diego
    $('#languages').multiselect({
        includeSelectAllOption: true,
        enableHTML: true
    });

    validationForm();
    $(document).on("click", ".nextbtn", function() {
        var valid = $('form').valid();
        if (valid) {
            var selectids = $(document).find(".currentForm").attr("id");
            if(selectids==1) {
                if($("#templateId").val()==0) {
                    swal({
                        title: "Please select Any model",
                        type: "error"
                    });
                    return false;
                }
            } else if(selectids==2){
                if($("#campaignName").val()=='') {
                    swal({
                        title: "Please Enter Campaign Name",
                        type: "error"
                    });
                    return false;
                } else if($("#subjectEmail").val()==''){
                    swal({
                        title: "Please Enter Subject Email",
                        type: "error"
                    });
                    return false;
                }
                $("#subjectEmail2").val($("#subjectEmail").val());
            }
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

    });
    $(document).on("click", ".sendMail", function() {
        emailAddress.length=0;
        $.each($("input[name='checkbox[]']"), function() {
            if ($(this).is(":checked")) {
                if($(this).val()!="")
                    emailAddress.push({"email": $(this).val(),"emailname":$(this).attr('data-name')});
            }
        });
        //console.log(emailAddress);
        var senderEmail = $("#senderEmail").val();
        var senderName = $("#senderName").val();
        var subjectEmail=$("#subjectEmail").val();
        sendCampaignMail(templateID, templateName, emailAddress, senderName, senderEmail,subjectEmail);
    });

    $(document).on("click", ".schedule", function() {
        emailAddress.length=0;
        $.each($("input[name='checkbox[]']"), function() {
            if ($(this).is(":checked")) {
                if($(this).val()!="")
                    emailAddress.push({"email": $(this).val(),"emailname":$(this).attr('data-name')});
            }
        });
        //console.log(emailAddress);
        var senderEmail = $("#senderEmail").val();
        var senderName = $("#senderName").val();
        var subjectEmail=$("#subjectEmail").val();
//        sendCampaignMail(templateID, templateName, emailAddress, senderName, senderEmail,subjectEmail);
        scheduleCampaignMail(templateID, templateName, emailAddress, senderName, senderEmail,subjectEmail);
    });

    $(document).on('change', '#templateId', function(e) {

        templateID = this.value;
        templateName = $("#templateId option:selected").text();
        if(templateName.length>0)
            $("#templateGetName").html(templateName);

        $("#templatePreviewHidden").val(APP_URL + "/template_builder/html/"+{{$adminid}}+"/" + templateName + ".html");
        $("#templatePreview").attr("src", APP_URL + "/template_builder/html/"+{{$adminid}}+"/" + templateName + ".html");
    });
    $('#emailListId').on('change', function() {
        var emailGetList=$("#emailListId option:selected").text();
        if(emailGetList.length>0)
            $("#emailGetList").html(emailGetList);

        myVal = this.selectedOptions[0].value;
        oTable.draw();
    });
    $('form').on('change', '#gender, #recipientVisitVenue', function() {
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
        var testEmailName = [];
        testEmailAddress.push({"email": $("#testEmailAddress").val(),"emailname":"Test" });
        var senderEmail = $("#senderEmail").val();
        var senderName = $("#senderName").val();
        var subjectEmail=$("#subjectEmail").val();
        if (testEmailAddress.length != 0) {
            sendCampaignMail(templateID, templateName, testEmailAddress, senderName, senderEmail,subjectEmail);
        }
    });

    $("#currentFormIndex").val('1');
    $('#crtTempBtn').on('click', function() {
        var cmpName = $('input[name=campaignName]').val();
        var sndrEmail = $('input[name=senderEmail]').val();
        var frmName = $('input[name=fromName]').val();
        var subjectemail=$('input[name=subjectEmail]').val();
        jQuery.ajax({
            url: '/emails/emailSetup/updateForm',
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}',
                "campaignName": cmpName,
                "senderEmail": sndrEmail,
                "fromName": frmName,
                "campaignStatus": 'draft',
                "currentForm": '3',
                "subjectEmail":subjectemail

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

    $("#templateId").trigger('change');

    $("#campaignName").blur(function(){
        var campaignGetName=$(this).val();
        if(campaignGetName.length>0)
            $("#campaignGetName").html(campaignGetName);
    });
    $("#subjectEmail").blur(function(){
        var subjectGetEmail=$(this).val();
        if(subjectGetEmail.length>0)
            $("#subjectGetEmail").html(subjectGetEmail);
    });
    // edit template
    $(document).on("click", "#edit_template", function() {
        var tmpid=$("#templateId").val();
        location.href="{{url()}}/emails/"+tmpid+"/edit";
    });
    // delete template
    $(document).on("click", "#delete_template", function() {
        swal({
                    title: "Are you sure delete this template?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
//            var tmpid=new Array();
                        var tmpid=[$("#templateId").val()];

                        jQuery.ajax({
                            url: '{{url()}}/emails/' + tmpid,
                            type: 'post',
                            data: {
                                "_method": 'delete',
                                "_token": '{{csrf_token()}}'

                            },
                            success: function(result) {

                                if (result.success) {
                                    swal("success!", "Email Template  deleted successfully.", "success");
                                    location.reload();
                                } else {
                                    swal("ohh snap!", result.message, "error");
                                }


                            }
                        });


                    } else {

                        swal("ohh snap!", "Template Not Deleted", "error");
                    }
                });
    });

    });
    function delete_cookie(name) {
        document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    delete_cookie('camEmailSetup');
</script>
@endpush