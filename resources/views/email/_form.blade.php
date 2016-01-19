<input type="hidden" name="campaignStatus" value="draft" id="emailDraft"/>
<div class="col-md-9 campaingnState">
    {!!  Form::hidden('currentForm', null, array('id'=>'currentFormIndex')) !!}

    <div class="col-md-9 stepform1 {{isset($campaignData->currentForm) ? '':'currentForm' }}{{isset($campaignData->currentForm) && $campaignData->currentForm == '1' ? 'currentForm':''}}" id="1">
        <div class="form-group formrow">
            <label>Campaign Name</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('campaignName', null, array('id'=>'campaignName','placeholder'=>'MyCampaign','class'=>'form-control','required'=>'true')) !!}
            
        </div>
        <div class="form-group formrow">
            <label>Sender Email</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('senderEmail', null, array('id'=>'senderEmail','placeholder'=>'Email Address','class'=>'form-control','required'=>'true')) !!}
    
        </div>
        <div class="form-group formrow">
            <label>From Name</label><a href="#"><i class="anyque"></i></a>
            {!!  Form::text('fromName', null, array('id'=>'senderName','placeholder'=>'Your Name','class'=>'form-control','required'=>'true')) !!}
    
        </div>
    </div>
    <div class="col-md-10 stepform2 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '2' ? 'currentForm':''}}" id="2">
        <div class="form-group formrow">
            <label>Campaign Name</label>
            <p>Create a mobile-friendly email that looks great on any device or screen size.</p>
            <!--<a href="{{url('emails/create')}}" class="crtbtn">Create Campaign</a>-->
            <a href="javascript:void(0);" id='crtTempBtn' class="crtbtn">Create Campaign</a>
        </div>
        <div class="form-group formrow">
            <div class="selectbox">
                <i class="fa fa-caret-down droparrow"></i>
                {!!  Form::select('templateId', $emailTemplate, null, ['id'=>'templateId','required'=>'true']) !!}

            </div>
        </div>
    </div>
    <div class="col-md-12 stepform3 {{ isset($campaignData->currentForm) && $campaignData->currentForm == '3' ? 'currentForm':''}}" id="3">
        <div class="form-group formrow rediobtn">
            <div class="col-md-6">
                <input id="radio1" type="radio" name="selectList" value="customList" checked="{{isset($campaignData->selectList) &&  $campaignData->selectList == '' ? '' : 'checked'}}{{isset($campaignData->selectList) && $campaignData->selectList == 'customList' ? 'checked':''}}" ><label for="radio1">Custom List :</label>
            </div>
            <div class="col-md-6">
                <div class="selectbox">
                    <i class="fa fa-caret-down droparrow"></i>
                    {!!  Form::select('emailListId', $emailList, null, ['id'=>'emailListId','required'=>'true']) !!}

                </div>
            </div>
        </div>
        <div class="form-group formrow rediobtn">
            <div class="col-md-12">
                <input id="radio2" type="radio" name="selectList" value="quickList" checked="{{isset($campaignData->selectList) && $campaignData->selectList == 'quickList' ? 'checked':''}}" ><label for="radio2">Quick List</label>
            </div>
            <div class="quiklistblock">
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>Recipients gender</label>
                    </div>
                    <div class="col-md-6">
                        <div class="selectbox">
                            <i class="fa fa-caret-down droparrow"></i>
                            {!!  Form::select('gender', array('both' => 'Male & Female','male' => 'Male', 'female' => 'Female') , null, ['id'=>'gender','required'=>'true']) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>Recipients’ age range</label>
                    </div>
                    <div class="col-md-6">
                        <div class="ageblock">
                            <div class="col-md-6">
                                {!!  Form::text('age', "", array('data-from'=>isset($campaignData->age[0])? $campaignData->age[0]:'15','data-to'=>isset($campaignData->age[1])? $campaignData->age[1]:'55','data-type'=>'double','id'=>'age','class'=>'','required'=>'true')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row fliterrow quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>Router :</label>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="selectbox">
                               
                                {!!  Form::select('router[]', $routers, null, ['multiple' => 'multiple','id'=>'router','required'=>'true']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>Number of visits</label>
                    </div>
                    <div class="col-md-6">
                        <div class="ageblock">
                            <div class="col-md-6">
                                {!!  Form::text('numberofvisit', "", array('data-from'=>isset($campaignData->numberofvisit[0])? $campaignData->numberofvisit[0]:'1','data-to'=>isset($campaignData->numberofvisit[1])? $campaignData->numberofvisit[1]:'20','data-type'=>'double','id'=>'numberofvisit','class'=>'form-control','required'=>'true')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group quiklistrow">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <label>During the last</label>
                    </div>
                    <div class="col-md-6">
                        <div class="ageblock">
                            <div class="col-md-6">
                                {!!  Form::text('duringRecipientLastVisit', null, array('id'=>'duringRecipientLastVisit','placeholder'=>'0','class'=>'form-control','required'=>'true')) !!}

                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="datequickselection" value="" id="datequickselection">
                                <div class="selectbox">
                                    <i class="fa fa-caret-down droparrow"></i>
                                    {!!  Form::select('noOfDays', array('1' => 'Day(s)','7' => 'Week(s)', '30' => 'Month(s)','365' => 'year(s)'), null , ['id'=>'noOfDays','required'=>'true']) !!}
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
            <label>Confirm yours options</label>
            {!!  Form::hidden('templatePreview', null, array('id'=>'templatePreviewHidden')) !!}

            <div class="confimgblk">
                <iframe src="{{ isset($campaignData->templatePreview) && $campaignData->templatePreview !='' ? $campaignData->templatePreview:''}}" id="templatePreview"></iframe> 
            </div>
        </div>
        <div class="form-group formrow sendformrow">
            <label>Send a test</label>
            <div class="form-group">
                <div class="sendbox">
                    <input class="form-control" type="email" placeholder="Enter an email address" name="testEmailAddress" id="testEmailAddress"/>
                    <a href="javascript:void(0)" id="sendTestAddress">Send</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12">
        <div class="stepbtn">
            <button class="backbtnaa" type="submit"><i><img src="{{asset("img/savebtn.png")}}" /></i> Save &amp; Exit</button>
            <a href="javascript:void(0)" class="backbtn"> <i><img src="{{asset("img/backicon.png")}}" /></i> Back </a>
            <a href="javascript:void(0)" class="nextbtn"><i><img src="{{asset("img/sendallicon.png")}}" /></i><span class="nxtButton">Next </span></a>

        </div>
    </div>
</div>