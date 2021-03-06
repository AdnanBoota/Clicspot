@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.css" type="text/css">
<style>
    .dataTables_wrapper.form-inline.dt-bootstrap.no-footer{
        overflow-x: hidden; height: 300px;
    }
</style>
<!-- Raty plugin me@diegopucci.com pucci_diego -->
<link href="{{ asset('/plugins/raty/jquery.raty.css') }}" rel='stylesheet' />
@endpush
<?php //echo '<pre>'; print_r($campaignData); exit; ?>
<input type="hidden" name="campaignStatus" value="draft" id="emailDraft"/>
<div class="col-md-9 campaingnState">
    {!!  Form::hidden('currentForm', null, array('id'=>'currentFormIndex')) !!}


    <!-- STEP 1 -->
    <div class="col-md-12 stepform1 {{isset($campaignData->currentForm) ? '':'currentForm' }}{{ isset($campaignData->currentForm) && $campaignData->currentForm == '1' ? 'currentForm':''}}" id="1">
        <div class="form-group formrow center">
            <label class="step_title">{{ Lang::get('auth.campaignnm')}}</label>
            <p>{{ Lang::get('auth.createmobile') }}</p>
            <!--<a href="{{url('emails/create')}}" class="crtbtn">Create Campaign</a>-->

        </div>
        <div class="col-md-4">
            <div class="form-group formrow">
                <a href="javascript:void(0);" style="float: right; width: auto; padding: 7px 15px; font-size:17px; height:46px; line-height:30px;" id='crtTempBtn' class="crtbtn">{{ Lang::get('auth.createCampaign') }}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group formrow">
                <div class="selectbox">
                    <i class="fa fa-angle-down droparrow"></i>
                    <?php
                    $emailTemplate[0] = Lang::get('auth.selectCampaign');
                    ?>
                    {!!  Form::select('templateId', $emailTemplate, 0, ['id'=>'templateId','tabindex'=>'4']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0)" id="edit_template"  class="form_custom_edit_btn" style=" background: #1abc9c none repeat scroll 0 0;
               border: medium none;
               border-radius: 5px;
               color: #fff;
               display: inline-block;
               margin-top: 10px;
               padding: 5px; font-weight: bold"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0)" id="delete_template"  class="form_custom_delete_btn" style=" background: #E12C2C none repeat scroll 0 0;
               border: medium none;
               border-radius: 5px;
               color: #fff;
               display: inline-block;
               margin-top: 10px;
               padding: 5px; font-weight: bold"><i class="fa fa-remove"></i></a>
        </div>
    </div><!-- STEP 1 -->

    <!-- STEP 2 -->
    <div style="padding: 15px" class="col-md-12 stepform2 {{isset($campaignData->currentForm) && $campaignData->currentForm == '2' ? 'currentForm':''}}" id="2">

        <div class="row">
            <div class="form-group formrow center">
                <label class="step_title">{{ Lang::get('auth.setup') }}</label>
                <p>{{ Lang::get('auth.setupinfo') }}</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="form-group formrow">
                    {!!  Form::text('campaignName', null, array('id'=>'campaignName','placeholder'=>Lang::get("auth.mycampaign"),'class'=>'form-control siranicon','tabindex'=>'1')) !!}
                </div>

                <div class="form-group formrow">
                    {!!  Form::text('subjectEmail', null, array('id'=>'subjectEmail','placeholder'=>Lang::get("auth.subjectemail"),'class'=>'form-control emailicon','tabindex'=>'1')) !!}
                </div>
                <div class="form-group formrow">
                    {!!  Form::text('senderEmail', $email, array('id'=>'senderEmail','placeholder'=>'Email Address','class'=>'form-control bnameicon','readonly','tabindex'=>'2')) !!}
                </div>
                <div class="form-group formrow">
                    {!!  Form::text('fromName', $username, array('id'=>'senderName','placeholder'=>'Your Name','class'=>'form-control bnameicon','readonly','tabindex'=>'3')) !!}
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div><!-- STEP 2 -->


    <!-- STEP 3LIST FILTER -->
    <div class="col-md-12 stepform3 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '3' ? 'currentForm':''}}" id="3">
        <div class="col-md-7">
            <div class="form-group formrow rediobtn">
                <div class="col-md-6">
                    <!--<input id="radio1" type="radio" name="selectList" value="customList" checked="{{isset($campaignData->selectList) &&  $campaignData->selectList == '' ? '' : 'checked'}}{{isset($campaignData->selectList) && $campaignData->selectList == 'customList' ? 'checked':''}}" ><label for="radio1">{{ Lang::get('auth.customlist') }} :</label>-->
                    <label for="radio1">{{ Lang::get('auth.customlist') }} :</label>
                </div>
                <div class="col-md-6">
                    <div class="selectbox">
                        <i class="fa fa-caret-down droparrow"></i>
                        {!!  Form::select('emailListId', $emailList, null, ['id'=>'emailListId','tabindex'=>'5']) !!}

                    </div>
                </div>
            </div>
            <div class="form-group formrow rediobtn">
                <div class="col-md-12">
                    <!--<input id="radio2" type="radio" name="selectList" value="quickList" checked="{{isset($campaignData->selectList) && $campaignData->selectList == 'quickList' ? 'checked':''}}" ><label for="radio2">{{ Lang::get('auth.quicklist') }}</label>-->
                    <label for="radio2">{{ Lang::get('auth.quicklist') }}</label>
                </div>
                <div class="quiklistblock">
                    <div class="row fliterrow quiklistrow"><!-- added by me@diegopucci.com @pucci_diego BEGIN-->
                        <div class="col-md-2">
                            <input id="starsFilterStatus" class="includeRecipient starsFilterStatus" type="checkbox"  value="" name="starsFilterStatus" checkstatus="1" checked>
                            <label for="starsFilterStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.recrating')}} :</label>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="starsFilter" data-score="2"></div>
                            </div>
                        </div>
                    </div><!-- added by me@diegopucci.com @pucci_diego END-->

                    <div class="row fliterrow quiklistrow"><!-- added by me@diegopucci.com @pucci_diego BEGIN-->
                        <div class="col-md-2">
                            <input id="langFilterStatus" class="includeRecipient langFilterStatus" checked type="checkbox"  value="" name="langFilterStatus" checkstatus="1">
                            <label for="langFilterStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.languages')}} :</label>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="selectbox">
                                    {!!  Form::select('languages[]', $languages, null, ['multiple' => 'multiple','id'=>'languages','tabindex'=>'13']) !!}
                                </div>
                            </div>
                        </div>
                    </div><!-- added by me@diegopucci.com @pucci_diego END-->
                    <div class="row fliterrow quiklistrow">
                        <div class="col-md-2">
                            <input id="recipientsAgeRangeFltrStatus" class="includeRecipient recipientsAgeRangeFltrStatus" checked type="checkbox"  value="" name="recipientsAgeRange" checkstatus="1">
                            <label for="recipientsAgeRangeFltrStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.agerange')}}</label>
                        </div>
                        <div class="col-md-5">
                            <div class="ageblock">
                                <div class="col-md-6">
                                    {!!  Form::text('age', "", array('data-from'=>isset($campaignData->age[0])? $campaignData->age[0]:'15','data-to'=>isset($campaignData->age[1])? $campaignData->age[1]:'55','data-type'=>'double','id'=>'age','tabindex'=>'7')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row fliterrow quiklistrow">
                        <div class="col-md-2">
                            <input id="routerFltrStatus" class="includeRecipient routerFltrStatus" checked type="checkbox"  value="" name="recipientsAgeRange" checkstatus="1">
                            <label for="routerFltrStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.router')}} :</label>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="selectbox">
                                    {!!  Form::select('router[]', $routers, null, ['multiple' => 'multiple','id'=>'router','tabindex'=>'8']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fliterrow quiklistrow">
                        <div class="col-md-2">
                            <input id="visitsFltrStatus" class="includeRecipient visitsFltrStatus" checked type="checkbox"  value="" name="recipientsAgeRange" checkstatus="1">
                            <label for="visitsFltrStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.visits')}}</label>
                        </div>
                        <div class="col-md-5">
                            <div class="ageblock">
                                <div class="col-md-6">
                                    {!!  Form::text('numberofvisit', "", array('data-from'=>isset($campaignData->numberofvisit[0])? $campaignData->numberofvisit[0]:'1','data-to'=>isset($campaignData->numberofvisit[1])? $campaignData->numberofvisit[1]:'20','data-type'=>'double','id'=>'numberofvisit','class'=>'form-control','tabindex'=>'9')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fliterrow quiklistrow">
                        <div class="col-md-2">
                            <input id="duringFltrStatus" class="includeRecipient duringFltrStatus" checked type="checkbox"  value="" name="recipientsAgeRange" checkstatus="1">
                            <label for="duringFltrStatus">O</label>
                        </div>
                        <div class="col-md-5">
                            <label>{{ Lang::get('auth.during')}}</label>
                        </div>
                        <div class="col-md-5">
                            <div class="ageblock">
                                <div class="col-md-6">
                                    {!!  Form::text('duringRecipientLastVisit', null, array('id'=>'duringRecipientLastVisit','placeholder'=>'0','class'=>'form-control','tabindex'=>'10')) !!}

                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="datequickselection" value="" id="datequickselection">
                                    <div class="selectbox">
                                        <i class="fa fa-caret-down droparrow"></i>
                                        {!!  Form::select('noOfDays', array('1' => Lang::get("auth.day"),'7' => Lang::get("auth.week"), '30' =>Lang::get("auth.month"),'365' => Lang::get("auth.year")), null , ['id'=>'noOfDays','tabindex'=>'11']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="col-md-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-facebook"></i></span>
                    <img class="user-icon" alt="" src="/img/user-icon.png" style="height:25px;float: right">
                    <h2 id="fb_count" style="padding-top:31px;text-align: center;">0</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa  fa-envelope"></i></span>
                    <img class="user-icon" alt="" src="/img/user-icon.png" style="height:25px;float: right">
                    <h2 id="mail_count" style="padding-top:31px;text-align: center;">0</h2>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <table class="emailCampaign" id="emailCampaign-Table">
                <thead>
                <tr>
                    <th>Rating</th>
                    <th>Name</th>
                    <th>Language</th>
                    <th>Last Visit</th>
                    <th>Visits</th>
                    <th>Include</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <br>
        </div>
    </div> <!-- STEP 3 -->






    <div class="col-md-12 stepform4 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '4' ? 'currentForm':''}}" id="4">
        <div class="form-group formrow">
            <label>{{ Lang::get('auth.confirmoption')}}</label>
            {!!  Form::hidden('templatePreview', null, array('id'=>'templatePreviewHidden')) !!}

            <div class="confimgblk">
                <iframe src="{{ isset($campaignData->templatePreview) && $campaignData->templatePreview !='' ? $campaignData->templatePreview:''}}" id="templatePreview"></iframe>
            </div>
        </div>
        <div class="form-group formrow sendformrow">
            <label>{{ Lang::get('auth.sendtest')}}</label>
            <div class="form-group">
                <div class="sendbox">
                    <input class="form-control" type="email" placeholder="{{ Lang::get('auth.enteremail')}}" name="testEmailAddress" id="testEmailAddress"/>
                    <a href="javascript:void(0)" id="sendTestAddress">{{ Lang::get('auth.send')}}</a>
                </div>
            </div>
        </div>
        <div class="form-group formrow sendformrow">
            <label>Select date & time</label>
            <div class="form-group">
                <div class="input-group date">
                    <input type="text" data-provide="datepicker" class="form-control " name="scheduleTime" id="scheduleTime" style="width: 145px">
                    <input type="text" class="form-control timepicker" id="timepicker" name="timepicker" style="width: 100px;margin-left:10px">
                    <span class="stepbtn" style=""><a href="javascript:void(0)" class="schedule" tabindex="16" style="margin-top:0px;position: absolute " >Schedule</a> </span>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
        <div class="stepbtn">
            <button class="backbtnaa" type="submit" tabindex="13"><i><img src="{{asset("img/savebtn.png")}}" /></i>{{ Lang::get('auth.savequite')}}</button>
            <a href="javascript:void(0)" class="backbtn" tabindex="14"> <i><img src="{{asset("img/backicon.png")}}" /></i> {{ Lang::get('auth.back')}} </a>
            <a href="javascript:void(0)" class="nextbtn" tabindex="15"><i><img src="{{asset("img/sendallicon.png")}}" /></i><span class="nxtButton">{{ Lang::get('auth.next')}} </span></a>

        </div>
    </div>
</div>
@push('scripts')


<script type="text/javascript" src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $(function () {
        //Timepicker
        $("#timepicker").timepicker();
        $('#scheduleTime').datepicker('setDate', new Date());
        $('#timepicker').timepicker('setTime', new Date());
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.js"></script>
<!-- DataTables -->
@endpush