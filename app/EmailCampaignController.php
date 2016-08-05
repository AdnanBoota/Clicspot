<?php

namespace App\Http\Controllers;

use App\EmailEvents;
use GuzzleHttp;
use App\Campaign;
use App\CampaignAttributes;
use App\Emails;
use App\EmailCampaign;
use App\EmailCampaignFeedback;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use PhpSpec\Exception\Exception;
use Response;
use Session;
use DB;
use App\Radacct;
use yajra\Datatables\Datatables;
use App\EmailList;
use App\Users;
use App\User;
use Mail;
use App\Hotspot;

class EmailCampaignController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {

            $listVal = $request->input('listVal');
            if ($listVal != "Select List") {
                $users = app('App\Http\Controllers\UsersController')->getStatistics($listVal, 'datatable');
                $mailCount = 0;
                $fbCount = 0;
                $gplusCount = 0;
                foreach ($users as $user) {
                    //edited by me@diegopucci.com
                    switch($user->favoredconnection){
                        case 2:
                        case 3:
                        case 4:
                            $mailCount++;
                            break;
                        default:
                            if ($user->profileurl != '' AND strpos($user->profileurl, 'facebook') !== false) {
                                $fbCount++;
                            } else{
                                $gplusCount++;
                            }
                    }
                    //edited by me@diegopucci.com END
                }

                $datatableData = Datatables::of($users)
                    ->addColumn('include', function ($users) {
                        $visitorFname = explode(" ", $users->visitor);
                        if ($users->favoredconnection == '2') {
                            // mail
                            return '<input id="checkbox' . $users->id . '" class="includeRecipient mailCheckBox" checkstatus = "1" type="checkbox" name="checkbox[]" value="' . $users->email . '" data-name="' . $visitorFname[0] . '" checked><label for="checkbox'.$users->id.'">O</label>';
                        } else {
                            if ($users->profileurl != '' AND strpos($users->profileurl, 'facebook') !== false) {
                                // fb
                                return '<input id="checkbox' . $users->id . '" class="includeRecipient fbCheckBox" checkstatus = "1" type="checkbox" name="checkbox[]" value="' . $users->email . '" data-name="' . $visitorFname[0] . '" checked><label for="checkbox'.$users->id.'">O</label>';
                            } else {
                                // gplus
                                return '<input id="checkbox' . $users->id . '" class="includeRecipient gplusCheckBox" checkstatus = "1" type="checkbox" name="checkbox[]" value="' . $users->email . '" data-name="' . $visitorFname[0] . '" checked><label for="checkbox'.$users->id.'">O</label>';
                            }
                        }

                    })
                    ->addColumn('review', function ($users) {
                        $starsRating = \App\StarsRating::getStarsRating($users->userId);
                        return '<div class="raty readonly" data-score="'.$starsRating.'"></div>';
                    })
                    ->editColumn('language',function($users){
                        if ($users->language == 'fr')
                            return '<div class="flag-icon flag-icon-fr" title="Français" id="fr">';
                        else {
                            if ($users->language == 'en')
                                return '<div class="flag-icon flag-icon-gb" title="Anglais" id="gb">';
                            else {
                                if ($users->language == 'es')
                                    return '<div class="flag-icon flag-icon-es" title="Espagnol" id="es">';
                                else {
                                    if ($users->language == 'de')
                                        return '<div class="flag-icon flag-icon-de" title="Allemagne" id="de">';

                                    else {
                                        if ($users->language == 'nl')
                                            return '<div class="flag-icon flag-icon-nl" title="Hollandais" id="nl">';

                                        else {
                                            if ($users->language == 'pt')
                                                return '<div class="flag-icon flag-icon-pt" title="Portugais" id="pt">';
                                            else {
                                                if ($users->language == 'it')
                                                    return '<div class="flag-icon flag-icon-it" title="Italien" id="it">';

                                                else
                                                    return '<div class="flag-icon flag-icon-us" title="Default" id="us">';

                                            }}}}}}
                    })
                    ->addColumn('mailCount', $mailCount)
                    ->addColumn('fbCount', $fbCount)
                    ->addColumn('gplusCount', $gplusCount)
                    ->make(true);

                return $datatableData;


            } else {
                return "hi";
            }
        } else {
            return redirect("emails/emailSetup/create");
        }
    }

    public function socialCount(Request $request)
    {

        $listVal = $request->input('listVal');
        if ($listVal != "Select List") {
            $users = app('App\Http\Controllers\UsersController')->getStatistics($listVal, 'datatable');
            $mail=0;
            $fb=0;
            $gplus=0;
            foreach($users as $counter)
            {
                if($counter->favoredconnection== '2')
                {
                    $mail=$mail+1;
                }
                else {
                    if($counter->profileurl != '' AND strpos($counter->profileurl, 'facebook') !== false)
                    {
                        $fb=$fb+1;

                    }
                    else{
                        $gplus=$gplus+1;
                    }
                }
            }

            $data=array('fbcount' =>$fb,'gpluscount'=>$gplus,'mailcount'=>$mail);
            return json_encode($data);
        } else {
            return "hi";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $adminid= Auth::user()->id;
        $userDetails = User::findOrFail($adminid);
        $email=$userDetails->email;
        $username=$userDetails->username;
        //  $emailTemplate = Emails::select(DB::raw('id,adminid,templateName'))->get();
        $emailTemplate = Auth::user()->emailTemplates()->select('templateName', 'id')->lists('templateName', 'id');
        //$routers = Auth::user()->hotspots()->select('nasidentifier')->lists('nasidentifier', 'nasidentifier');
        $routers = Auth::user()->hotspots()->select('ssid')->lists('ssid', 'ssid');
        $emailList = Auth::user()->emailList()->select('listname', 'id')->lists('listname', 'id');
        //    $emailList = Auth::user()->emailList()->select('listname', 'id')->get();

        $languages = array( //added by me@diegopucci.com @pucci_diego
            'en' => '<div class="flag-icon flag-icon-gb" title="Anglais" id="gb">',
            'fr' => '<div class="flag-icon flag-icon-fr" title="Français" id="fr">',
            'es' => '<div class="flag-icon flag-icon-es" title="Espagnol" id="es">',
            'de' => '<div class="flag-icon flag-icon-de" title="Allemagne" id="de">',
            'nl' => '<div class="flag-icon flag-icon-nl" title="Hollandais" id="nl">',
            'it' => '<div class="flag-icon flag-icon-it" title="Italien" id="it">',
            'pt' => '<div class="flag-icon flag-icon-pt" title="Portugais" id="pt">'
        );

        return View::make('email.emailSetup', compact('emailTemplate', 'emailList', 'routers', 'languages', 'adminid','email','username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {



        $data = Input::all();
        if (isset($data['router'])) {
            $data['router'] = implode(",", $data['router']);
        }
        if (isset($data['checkbox'])) {
            $data['checkbox'] = implode(",", $data['checkbox']);
        }
        if ($data['age'] == "") {
            $data['age'] = "15;55";
        }
        if ($data['numberofvisit'] == "") {
            $data['numberofvisit'] = "1;20";
        }


//            echo date('H:i:s', strtotime($data['timepicker']));
        $data['scheduleTime']=date("Y-m-d H:i:s",strtotime($data['scheduleTime'].$data['timepicker']));

//        echo '<pre>'; print_r($data); exit;
        $EmailCampaign = new EmailCampaign($data);

        Auth::user()->emailCampaign()->save($EmailCampaign);
        return redirect("emails");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {

        $adminid= Auth::user()->id;
        $userDetails = User::findOrFail($adminid);
        $email=$userDetails->email;
        $username=$userDetails->username;
        $campaignData = EmailCampaign::findOrFail($id);
        $campaignData->recipientNoOfVisit = explode(';', $campaignData->recipientNoOfVisit);
        $campaignData->router = explode(',', $campaignData->router);
        $campaignData->age = explode(';', $campaignData->age);
        $emailTemplate = Auth::user()->emailTemplates()->select('templateName', 'id')->lists('templateName', 'id');
        //$routers = Auth::user()->hotspots()->select('nasidentifier')->lists('nasidentifier', 'nasidentifier');
        $routers = Auth::user()->hotspots()->select('ssid')->lists('ssid', 'ssid');
        $emailList = Auth::user()->emailList()->select('listname', 'id')->lists('listname', 'id');
        $emailListId=  EmailList::where("id",$campaignData->emailListId)->select('listname')->first();
        $emailTemp=  Emails::where("id",$campaignData->templateId)->select('templateName')->first();
        $languages = array( //added by me@diegopucci.com @pucci_diego
            'en' => '<div class="flag-icon flag-icon-gb" title="Anglais" id="gb">',
            'fr' => '<div class="flag-icon flag-icon-fr" title="Français" id="fr">',
            'es' => '<div class="flag-icon flag-icon-es" title="Espagnol" id="es">',
            'de' => '<div class="flag-icon flag-icon-de" title="Allemagne" id="de">',
            'nl' => '<div class="flag-icon flag-icon-nl" title="Hollandais" id="nl">',
            'it' => '<div class="flag-icon flag-icon-it" title="Italien" id="it">',
            'pt' => '<div class="flag-icon flag-icon-pt" title="Portugais" id="pt">'
        );

        return View::make('email.emailSetupEdit', compact('campaignData', 'emailTemplate', 'emailList', 'routers','languages','adminid','email','username','emailListId','emailTemp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {

        $EmailCampaign = EmailCampaign::findOrFail($id);
        $data = Input::all();
        if (isset($data['router'])) {
            $data['router'] = implode(",", $data['router']);
        }
        if (isset($data['checkbox'])) {
            $data['checkbox'] = implode(",", $data['checkbox']);
        }
        if ($data['age'] == "") {
            $data['age'] = "15;55";
        }
        if ($data['numberofvisit'] == "") {
            $data['numberofvisit'] = "1;20";
        }

        $data['scheduleTime']=date("Y-m-d H:i:s",strtotime($data['scheduleTime'].$data['timepicker']));

        $EmailCampaign->update($data);
        return redirect('emails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $EmailCampaign = EmailCampaign::find($id);
        $res = $EmailCampaign->delete();
        if ($res) {
            $success = true;
            $msg = "Record Deleted Successfully.";
        } else {
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }
        return Response::json(array(
            'success' => $success,
            'message' => $msg,
        ));

    }


    /*
     * Me@diegopucci.com @pucci_diego
     * This function will serve to send campaigns right away as well as scheduling them
     */
    public function scheduleEmail($campaignMoveData = false) {

        $input = $campaignMoveData != false ? $campaignMoveData : Input::all();
        $usersReceivers = $input['emailAddress'];
        $adminId = Auth::user()->id;
        $adminBusiness = Auth::user()->businessname;

        if(count($usersReceivers)>0){

            $campaignSender = 'postmaster@clicspot.com';
            $campaignSenderName = !empty($input['fromName']) ? $input['fromName'] : "";
            $campaignSubject = $input['subjectEmail'];

            /*
             * me@diegopucci.com @pucci_diego
             * This is where the differentiation between sending and scheduling emails happens
             */
            $scheduleDate = date("Y-m-d"); //send now
            if(isset($input['scheduleTime']) && $input['scheduleTime'] != ""){
                $scheduleDate = date("Y-m-d",strtotime($input['scheduleTime'])).' '.$input['timepicker'];
            }
            $scheduleDateSparkPost = date('c',strtotime($scheduleDate));

            $html = file_get_contents(public_path().'/template_builder/html/'.$adminId.'/'.$input['templateName'].'.html');

            //TODO (will need to be changed inside the templates)
            //REFACTORING HTML to match SparkPost requirements on substitution_data
            $tags = array("{firstname}","{business_name}","{UNSUBSCRIBE}");
            $replaceTags = array("{{firstname}}","{{businessname}}", "{{unsubscribelink}}");
            $html = str_replace($tags, $replaceTags, $html);

            //preparing the data for SparkPost. Will be populated later on with recipients data
            $sparkPost = array(
                'content' => array(
                    'from' => array(
                        'name' => $campaignSenderName,
                        'email' => $campaignSender
                    ),
                    'subject' => $campaignSubject,
                    'html'=> $html //to be filled
                ),
                'options' => array(
                    'start_time' => $scheduleDateSparkPost,
                    'open_tracking' => true,
                    'click_tracking' => true

                ),
                'recipients' => array() //to be filled
            );

            foreach($usersReceivers as $user) {
                $unsubscribe = url().'/unsubscribe/'. $user['email'];

                // preparing data for SparkPost
                array_push($sparkPost["recipients"], array(
                        'address' => array(
                            'email' => $user['email']
                        ),
                        "substitution_data" => array(
                            "firstname" => $user['emailname'],
                            "businessname" => $adminBusiness,
                            "unsubscribelink" => $unsubscribe
                        )
                    )
                );
            }

            //now saving on SparkPost
            $auth = "ac0acd4c1cb4665cd46edb4ada4aea6d24c2f278";
            $client = new GuzzleHttp\Client();

            $doSpark = $client->post('https://api.sparkpost.com/api/v1/transmissions', array(
                'headers' => array(
                    'Accept' => 'application/json',
                    'Authorization' => $auth
                ),
                'body' => json_encode($sparkPost)
            ));

            $sparkRes = json_decode($doSpark->getBody(), true);

            if(array_key_exists('results', $sparkRes)) {

                //now saving the campaign into the DB
                $campaignData = array(
                    "adminid" => $adminId,
                    "emailListId" => $input['emailListId'],
                    "templateId" => $input['templateId'],
                    "campaignName" => $input['campaignName'],
                    "campaignStatus" => $input['campaignStatus'],
                    "senderEmail" => $input['fromEmail'],
                    "fromName" => $input['fromName'],
                    "subjectEmail" => $input['subjectEmail'],
                    "selectList" => "",
                    "gender" => "",
                    "age" => $input['age'] == "" ? "15;55" : $input['age'],
                    "checkbox" => json_encode($usersReceivers), //TODO
                    "router" => isset($input['router']) && !empty($input['router']) ? implode(",", $input['router']) : $input['router'],
                    "datequickselection" => $input['datequickselection'],
                    "recipientNoOfVisit" => $input['numberofvisit'] == "" ? "1;20" : $input['numberofvisit'], //TODO
                    "currentForm" => $input['currentForm'],
                    "duringRecipientLastVisit" => $input['duringRecipientLastVisit'],
                    "templatePreview" => $input['templatePreview'],
                    "noOfDays" => $input['noOfDays'],
                    "testEmailAddress" => $input['testEmailAddress'],
                    "scheduleTime" => $campaignMoveData != false ? $input['scheduleTime'] : date("Y-m-d H:i:s",strtotime($input['scheduleTime'].$input['timepicker'])),
                    "transmission_id" => $sparkRes["results"]["id"],
                    "formObject" => json_encode($input)
                );

                if(isset($input['campignId']) && $input['campignId']!=""){
                    $campaignID = $input['campignId'];
                    $EmailCampaign = EmailCampaign::findOrFail($input['campignId']);
                    $EmailCampaign->update($campaignData);
                }else{
                    $EmailCampaign = new EmailCampaign($campaignData);
                    $campaignID = Auth::user()->emailCampaign()->save($EmailCampaign);
                }

                foreach($usersReceivers as $user) {
                    //populating the email_events table for future processes on emailTrack() function CronController.php
                    $emailEvent = new EmailEvents();
                    $emailEvent->transmission_id = $sparkRes["results"]["id"];
                    $emailEvent->transmission_type = "campaign";
                    $emailEvent->adminid = $adminId;
                    $emailEvent->emailid = $user['email'];
                    $emailEvent->feedback_confirm = 0;
                    $emailEvent->save();
                }

                $successMsg = "Email planifié avec succès";
                Session::flash('flash_message_success', $successMsg);

            }else{
                echo json_encode($sparkRes);
                die;
            }
        }else{
            echo "ERROR";
        }
    }

    public function getTemplate() {
        //$contents['template'] = file_get_contents(url()."/template_builder/html/4/bindesh.html");
//        View::addExtension('html', 'php');
//        return View::make('email.emailTemplate');
    }

    public function updateForm() {
        $input = Input::all();
        //print_r($input);exit;
        if (isset($input['id'])) {
            $EmailCampaign = EmailCampaign::findOrFail($input['id']);
            $input['scheduleTime']= date("Y-m-d H:i:s",strtotime($input['scheduleTime'].$input['timepicker']));
            $EmailCampaign->update($input);
            return Response::json(array(
                'success' => true,
                'message' => "Formulaire mis à jour",
            ));
        } else {
            $emailCampaign = new EmailCampaign($input);
            //$result = $emailCampaign->save();
            Auth::user()->emailCampaign()->save($emailCampaign);
            return Response::json(array(

                'id' => $emailCampaign->id
            ));

        }
    }

    public function manualMailing($id){

        $emailData="";
        if($id=="all")
            $emailData=  EmailCampaign::where('adminid','=',Auth::user()->id)->get();
        else
            $emailData=  EmailCampaign::where('campaignStatus','=',$id)->where('adminid','=',Auth::user()->id)->get();
        $eventArr=array();
        foreach($emailData as $email){
            if($email->scheduleTime!='0000-00-00 00:00:00') {
                $event=array();
                $event['id']=$email->id;
                $event['title']=$email->campaignName;
                /*$event['start']= implode("T",explode(" ",$email->scheduleTime));*/
                $event['start']= $email->scheduleTime;
                /*$event['allDay'] =true;*/
                $event['backgroundColor']=$email->campaignStatus=='draft' ? $event['className'][]="draft" : $event['className'][]="send" ;
                array_push($eventArr, $event);
            }
        }

        return Response::json($eventArr);
    }


    function campaignmove(){
        $success = true;
        $cid = $_REQUEST['id'];
        $edate = $_REQUEST['edate'];
        $etimeslot = $_REQUEST['timeslot'];
        $EmailCampaign = EmailCampaign::findOrFail($cid);
        $edateo = explode("T",$edate);

        if($EmailCampaign){
            $listVal = json_decode($EmailCampaign->formObject, true);
            $listVal["transmission_id"] = $EmailCampaign->transmission_id; //will be used by the UsersController getStatistics function to exclude previous sends
            //$listVal["router"] = is_array($listVal["router"]) ? implode(";", $listVal["router"]) : ""; //to mantain retro compatibility with UsersController getStatistics function
            //$listVal["languages"] = is_array($listVal["languages"]) ? implode(";", $listVal["languages"]) : ""; //to mantain retro compatibility with UsersController getStatistics function

            //get new users to send this campaign to and exclude previous ones
            $users = app('App\Http\Controllers\UsersController')->getStatistics($listVal, 'campaignmove');
            $listVal["scheduleTime"] = $edateo[0].' '.$etimeslot.':00';

            if(count($listVal["emailAddress"]) > 0){
                $msg = "Campagne mis à jour avec succès.";
                $this->scheduleEmail($listVal);
            }else{
                $msg = "Sorry there are no users available for this campaign";
                $success = false;
            }
        }else{
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }

        return Response::json(array(
            'success' => $success,
            'message' => $msg,
        ));

    }


    public function unsubscribeEmail($email){
        $data=array('subscribe'=>'0');
        $users= \App\Users::where('email','=',$email)
            ->update($data);
        if($users){
            $data = array('success'=>'Unsubscribe Successfully.');
            //me@diegopucci.com user unsubscribed gets 1 star, so - 6 points
            try{
                \App\StarsRating::where("email_id", "=", $email)->update(array(
                    "points" => -6,
                    "stars" => \App\StarsRating::returnStarsByPoints(-6)
                ));
            }catch(Exception $e){
                echo $e->getMessage();
            }

        }else{
            $data=array('success'=>'Sory Try Again Leter Pls Contact Support');
        }
        return view('email.unsubscribe',  compact('data'));
    }



    /*
     * me@diegopucci.com
     * Return campaign report
     */
    public function reportView($id){

        $statictic = [];
        $rateuser = [];
        $filteredUsers = [];
        $reportData = \App\EmailEvents::reportData("campaign", $id);

        if(count($reportData) > 0 ){
            $statictic = $reportData["statictic"];
            $rateuser = $reportData["rateuser"];
            $filteredUsers = $reportData["filteredUsers"];
        }

        return view('email.reportView',  compact('statictic','rateuser', 'filteredUsers'));
    }
}