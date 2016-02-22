<input type="hidden" name="campaignStatus" value="draft" id="emailDraft"/>
<div class="col-md-9 campaingnState">
    {!!  Form::hidden('currentForm', null, array('id'=>'currentFormIndex')) !!}

    <div class="col-md-9 stepform1 {{isset($campaignData->currentForm) ? '':'currentForm' }}{{isset($campaignData->currentForm) && $campaignData->currentForm == '1' ? 'currentForm':''}}" id="1">
        <div class="form-group formrow">
            <label>{{ Lang::get('auth.campaignnm')}}</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('campaignName', null, array('id'=>'campaignName','placeholder'=>Lang::get("auth.mycampaign"),'class'=>'form-control','tabindex'=>'1')) !!}
            
        </div>
        <div class="form-group formrow">
            <label>{{ Lang::get('auth.sendermail')}}</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('senderEmail', $email, array('id'=>'senderEmail','placeholder'=>'Email Address','class'=>'form-control','readonly','tabindex'=>'2')) !!}
    
        </div>
        <div class="form-group formrow">
            <label>{{ Lang::get('auth.Formname')}}</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('fromName', $username, array('id'=>'senderName','placeholder'=>'Your Name','class'=>'form-control','readonly','tabindex'=>'3')) !!}
    
        </div>
    </div>
    <div class="col-md-10 stepform2 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '2' ? 'currentForm':''}}" id="2">
        <div class="form-group formrow">
            <label>{{ Lang::get('auth.campaignnm')}}</label>
            <p>{{ Lang::get('auth.createmobile') }}</p>
            <!--<a href="{{url('emails/create')}}" class="crtbtn">Create Campaign</a>-->
            <a href="javascript:void(0);" id='crtTempBtn' class="crtbtn">{{ Lang::get('auth.createCampaign') }}</a>
        </div>
        <div class="form-group formrow">
            <div class="selectbox">
                <i class="fa fa-caret-down droparrow"></i>
                {!!  Form::select('templateId', $emailTemplate, null, ['id'=>'templateId','tabindex'=>'4']) !!}

            </div>
        </div>
    </div>
    <div class="col-md-12 stepform3 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '3' ? 'currentForm':''}}" id="3">
        <div class="form-group formrow rediobtn">
            <div class="col-md-6">
                <input id="radio1" type="radio" name="selectList" value="customList" checked="{{isset($campaignData->selectList) &&  $campaignData->selectList == '' ? '' : 'checked'}}{{isset($campaignData->selectList) && $campaignData->selectList == 'customList' ? 'checked':''}}" ><label for="radio1">{{ Lang::get('auth.customlist') }} :</label>
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
                <input id="radio2" type="radio" name="selectList" value="quickList" checked="{{isset($campaignData->selectList) && $campaignData->selectList == 'quickList' ? 'checked':''}}" ><label for="radio2">{{ Lang::get('auth.quicklist') }}</label>
            </div>
            <div class="quiklistblock">
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>{{ Lang::get('auth.recgender')}}</label>
                    </div>
                    <div class="col-md-6">
                        <div class="selectbox">
                            <i class="fa fa-caret-down droparrow"></i>
                            {!!  Form::select('gender', array('both' => Lang::get("auth.malefemale"),'male' => Lang::get("auth.male"), 'female' => Lang::get("auth.female")) , null, ['id'=>'gender','tabindex'=>'6']) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>{{ Lang::get('auth.agerange')}}</label>
                    </div>
                    <div class="col-md-6">
                        <div class="ageblock">
                            <div class="col-md-6">
                                {!!  Form::text('age', "", array('data-from'=>isset($campaignData->age[0])? $campaignData->age[0]:'15','data-to'=>isset($campaignData->age[1])? $campaignData->age[1]:'55','data-type'=>'double','id'=>'age','tabindex'=>'7')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row fliterrow quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>{{ Lang::get('auth.router')}} :</label>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="selectbox">
                               
                                {!!  Form::select('router[]', $routers, null, ['multiple' => 'multiple','id'=>'router','tabindex'=>'8']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>{{ Lang::get('auth.visits')}}</label>
                    </div>
                    <div class="col-md-6">
                        <div class="ageblock">
                            <div class="col-md-6">
                                {!!  Form::text('numberofvisit', "", array('data-from'=>isset($campaignData->numberofvisit[0])? $campaignData->numberofvisit[0]:'1','data-to'=>isset($campaignData->numberofvisit[1])? $campaignData->numberofvisit[1]:'20','data-type'=>'double','id'=>'numberofvisit','class'=>'form-control','tabindex'=>'9')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>{{ Lang::get('auth.during')}}</label>
                    </div>
                    <div class="col-md-6">
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

        <table class="emailCampaign" id="emailCampaign-Table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Last Visit</th>
                    <th>Visits</th>
                    <th>Include</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


    </div>
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