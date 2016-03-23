<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignAttributes;
use App\Emails;
use App\EmailCampaign;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
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


                return Datatables::of($users)
                                ->addColumn('include', function ($users) {
                                    return '<input id="checkbox' . $users->id . '" class="includeRecipient" type="checkbox" name="checkbox[]" value="' . $users->email . '"><label for="checkbox1">O</label>';
                                })
                                ->make(true);
            } else {
                return "hi";
            }
        } else {
            return redirect("emails/emailSetup/create");
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
        return View::make('email.emailSetup', compact('emailTemplate', 'emailList', 'routers','adminid','email','username'));
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
        return View::make('email.emailSetupEdit', compact('campaignData', 'emailTemplate', 'emailList', 'routers','adminid','email','username','emailListId','emailTemp'));
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

    public function scheduleEmail() {
        $input = Input::all();
 // return Response ::json(array('data'=>$input));
        $userId = Auth::user()->id;
        
        
        
        if (isset($input['router'])) {
            $input['router'] = implode(",", $input['router']);
        }
        $emailAr=array();
        if (isset($input['emailAddress'])) {
            $emailAdd=$input['emailAddress'];
            foreach($emailAdd as $emailadd){
                $emailAr[]=$emailadd['email'];
            }
            
            $input['checkbox'] = implode(",", $emailAr);
        }
        if ($input['age'] == "") {
            $input['age'] = "15;55";
        }
        if ($input['numberofvisit'] == "") {
            $input['numberofvisit'] = "1;20";
        }
        
          $input['scheduleTime']=date("Y-m-d H:i:s",strtotime($input['scheduleTime'].$input['timepicker'])); 
       
       
        
        if($input['fromEmail']){
            $input['senderEmail']=$input['fromEmail'];
        }
        if($input['radio1']){
            $input['selectList']=$input['radio1'];
        }
        if($input['radio2']){
            $input['selectList']=$input['radio2'];
        }
            
       if($input['testEmailAddress']==""){
           $input['testEmailAddress']="";
       }
        
        //return Response ::json(array('data'=>$input));
        //echo '<pre>'; print_r($data); exit;
       if(isset($input['campignId']) && $input['campignId']!=""){
        $EmailCampaign = EmailCampaign::findOrFail($input['campignId']);
        $EmailCampaign->update($input);
       }else{
       $EmailCampaign = new EmailCampaign($input);
       Auth::user()->emailCampaign()->save($EmailCampaign);
       }

        
       
        $successMsg = "Email schedule created successfully";
        Session::flash('flash_message_success', $successMsg);
    }
    
    public function sendEmail() {
        $input = Input::all();
 // return Response ::json(array('data'=>$input));
        $userId = Auth::user()->id;
        
        
        
        if (isset($input['router'])) {
            $input['router'] = implode(",", $input['router']);
        }
        $emailAr=array();
        if (isset($input['emailAddress'])) {
            $emailAdd=$input['emailAddress'];
            foreach($emailAdd as $emailadd){
                $emailAr[]=$emailadd['email'];
            }
            
            $input['checkbox'] = implode(",", $emailAr);
        }
        if ($input['age'] == "") {
            $input['age'] = "15;55";
        }
        if ($input['numberofvisit'] == "") {
            $input['numberofvisit'] = "1;20";
        }
        
          $input['scheduleTime']=date("Y-m-d H:i:s",strtotime($input['scheduleTime'].$input['timepicker'])); 
       
       
        
        if($input['fromEmail']){
            $input['senderEmail']=$input['fromEmail'];
        }
        if($input['radio1']){
            $input['selectList']=$input['radio1'];
        }
        if($input['radio2']){
            $input['selectList']=$input['radio2'];
        }
            
       if($input['testEmailAddress']==""){
           $input['testEmailAddress']="";
       }
        
        //return Response ::json(array('data'=>$input));
        //echo '<pre>'; print_r($data); exit;
       if(isset($input['campignId']) && $input['campignId']!=""){
        $EmailCampaign = EmailCampaign::findOrFail($input['campignId']);
        $EmailCampaign->update($input);
       }else{
       $EmailCampaign = new EmailCampaign($input);
       Auth::user()->emailCampaign()->save($EmailCampaign);
       }

        
        $msgBody = "";
        
        //$subject = "Email Template For ClicSpot";
        $subject=$input['subjectEmail'];
        $message = "this is testing";
        $sendToUser = $input['emailAddress'];
        
        Mail::send('email.emailTemplate', array('msgBody' => $msgBody, 'templateId' => $input['templateId'], 'templateName' => $input['templateName'], 'userId' => $userId), function ($message) use ($sendToUser, $subject, $input) {
            foreach ($sendToUser as $singleUser) {
                $message->to($singleUser['email']);
            }
            $message->from($input['fromEmail'], $input['fromName']);
            $message->subject($subject);
        });
        

        $successMsg = "Email send successfully";
        Session::flash('flash_message_success', $successMsg);
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
          $input['scheduleTime']=date("Y-m-d H:i:s",strtotime($input['scheduleTime'].$input['timepicker'])); 
            $EmailCampaign->update($input);
            return Response::json(array(
                        'success' => true,
                        'message' => "Form Update Successfully",
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
            $emailData=  EmailCampaign::all();
        else
            $emailData=  EmailCampaign::where('campaignStatus',$id)->get();
        $eventArr=array();
        foreach($emailData as $email){
            $event=array();
            $event['id']=$email->id;
            $event['title']=$email->campaignName;
            $event['start']=$email->scheduleTime;
            $event['allDay'] =true;
            $event['backgroundColor']=$email->campaignStatus=='draft' ? $event['className'][]="draft" : $event['className'][]="send" ;
            
               
            array_push($eventArr, $event);
        }
        
        return Response::json($eventArr);
    }

}
