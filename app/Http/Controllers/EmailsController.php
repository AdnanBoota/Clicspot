<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Emails;
use App\Hotspot;
use App\HotspotAttributes;
use App\EmailCampaign;
use yajra\Datatables\Datatables;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Auth;
use DB;
use File;
use Input;
use Response;
use Session;
use Mail;

class EmailsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    public function index(Request $request) {
        if (Auth::user()->type == 'superadmin') {
            $draftCount = EmailCampaign::select(DB::raw('count(campaignStatus) as totalDraftCount'))->where('campaignStatus', '=', 'draft')->get();
            $sentCount = EmailCampaign::select(DB::raw('count(campaignStatus) as totalSentCountCount'))->where('campaignStatus', '=', 'sent')->get();
        } else {
            $draftCount = Auth::user()->emailCampaign()->select(DB::raw('count(campaignStatus) as totalDraftCount'))->where('campaignStatus', '=', 'draft')->get();
            $sentCount = Auth::user()->emailCampaign()->select(DB::raw('count(campaignStatus) as totalSentCountCount'))->where('campaignStatus', '=', 'sent')->get();
        }
        $userId = Auth::user()->id;
        $hotspot = Hotspot::where("adminid", "=", $userId)->select('reviewstatus')->first();
        if ($request->ajax()) {

            if (Auth::user()->type == 'superadmin') {
                $emailTemplate = Emails::select(['id', 'adminid', 'templateName', 'description']);
            } else {
                $emailTemplate = Auth::user()->emailTemplates()->select(['id', 'adminid', 'templateName', 'description']);
            }

            return Datatables::of($emailTemplate)
                            ->addColumn('checkbox', function ($emailTemplate) {
                                return ' <label class="">
                              <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" value="' . $emailTemplate->id . '" name="emailTemplateDelete[]"  class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>';
                            })
//                            ->addColumn('edit', function ($emailTemplate) {
//                                return '<a href="' . url("emails/{$emailTemplate->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
//                            })
                            ->addColumn('edit', function ($emailTemplate) {
                                return '  <td class="tselectbox">
                        <div class="dropdown editbtn">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span>Edit</span>
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><span><a href="' . url("emails/{$emailTemplate->id}/edit") . '">View Template</a></span></li>
                        <li><span><a href="javascript:void(0)" class="duplicateTemplate" id="' . $emailTemplate->id . '">Duplicate</a></span></li>
                        <li><span><a href="javascript:void(0)" class="renameTemplate" id="' . $emailTemplate->id . '" templateName="' . $emailTemplate->templateName . '">Rename</a></span></li>
                      </ul>
                    </div>
                    </td>';
                            })
                            ->make(true);
        } else {

            return view('email.index', compact('draftCount', 'sentCount', 'hotspot'));
        }
    }

    public function getEmail() {
//        echo "hii";
//        exit;
//        $id = "b470705790394325a4a53c81be49fd25";
//        $response = \MandrillMail::messages()->info($id);
//        echo "<pre>";
//        print_r($response);
//        exit;
        return View::make('email.email');
    }

    public function postEmail(Request $request) {

        $msgBody = $request->msgBody;
        $subject = $request->subject;
//        dd($request);
        $sendToUser = array(array('email' => 'pritesh@logisticinfotech.com', 'firstName' => 'pritesh'));
        $response = Mail::send('emails.emailTemplate', array('msgBody' => $msgBody), function ($message) use ($sendToUser, $subject) {
                    foreach ($sendToUser as $singleUser) {
                        $message->to($singleUser['email'], $singleUser['firstName']);
                    }
                    //set track open true header text
                    // $headers = $message->getHeaders();
                    //$headers->addTextHeader('X-MC-MergeVars', json_encode($mergevars));
                    //$headers->addTextHeader('X-MC-Template', 'my-template');
                    // $headers->addTextHeader('X-MC-Track', 'opens');
                    $message->from('info@clicspot.com', 'Clicspot');
                    $message->subject($subject);
                });

        $successMsg = "Email send successfully";
        echo "<pre>";
        //dd($response->getBody()->getContents());
        $resBody = json_decode($response->getBody()->getContents());
        print_r($resBody);
        echo $resBody[0]->status;
        echo $resBody[0]->_id;
        exit;
        return $response;
        //Session::flash('flash_message_success', $successMsg);
        //return redirect('emails');
    }

    public function create() {
        $data['images'] = array();
        $directory = 'uploads/templateImages/' . Auth::user()->id;

        $total_templates = ['marketing', 'event', 'info', 'promotion'];
        //Marketing Data
        $files = File::files($directory);
        foreach ($files as $file) {
            $data['images'][] = "/" . (string) $file;
        }
        $current_language = \App::getLocale();

        foreach ($total_templates as $template) {
            $directory = 'uploads/defaultTemplate/' . $template . '/' . $current_language;
            $files = File::files($directory);
//            dd($template);
            $data[$template] = array();
            foreach ($files as $file) {
                $data[$template]['images'][] = url() . '/' . $file;
                $data[$template]['files'][] = pathinfo($file)['filename'];
            }
        }
//dd($data);
        //Some code for changing the Email Template file based on the selected Language
        $data['lang_email_template'] = '';
//        dd($current_language);
        if ($current_language == 'en') {
            $data['lang_email_template'] = 'default_EN.html';
        } else if ($current_language == 'es') {
            $data['lang_email_template'] = 'default_ES.html';
        } else if ($current_language == 'fr') {
            $data['lang_email_template'] = 'default_FR.html';
        } else if ($current_language == 'ae') {
            $data['lang_email_template'] = 'default_AE.html';
        }

        return View::make('email.create', $data);
    }

    public function edit($id) {
        $templates = Emails::findOrFail($id);
        $userId = Auth::id();
        $images = array();
        $directory = 'uploads/templateImages/' . Auth::user()->id;
        $files = File::files($directory);
        foreach ($files as $file) {
            $images[] = "/" . (string) $file;
        }
        $directory = 'uploads/defaultTemplate/images';
        $files = File::files($directory);
        foreach ($files as $file) {
            $defaultTemplate[] = "/" . (string) $file;
        }
        $getFileName = scandir($directory, 0);
        $templateFileName = array_diff($getFileName, array('.', '..'));

        //event
        $directoryEvent = 'uploads/defaultTemplate/event';
        $filesEvent = File::files($directoryEvent);
        foreach ($filesEvent as $fileEvent) {
            $eventTemplate[] = "/" . (string) $fileEvent;
        }
        $getFileNameEvent = scandir($directoryEvent, 0);
        $templateFileNameEvent = array_diff($getFileNameEvent, array('.', '..'));

        //info
        $directoryInfo = 'uploads/defaultTemplate/info';
        $filesInfo = File::files($directoryInfo);
        foreach ($filesInfo as $fileInfo) {
            $infoTemplate[] = "/" . (string) $fileInfo;
        }
        $getFileNameInfo = scandir($directoryInfo, 0);
        $templateFileNameInfo = array_diff($getFileNameInfo, array('.', '..'));

        //promotion
        $directoryPromotion = 'uploads/defaultTemplate/promotion';
        $filesPromotion = File::files($directoryPromotion);
        foreach ($filesPromotion as $filePromotion) {
            $promotionTemplate[] = "/" . (string) $filePromotion;
        }
        $getFileNamePromotion = scandir($directoryPromotion, 0);
        $templateFileNamePromotion = array_diff($getFileNamePromotion, array('.', '..'));

        return View::make('email.create', compact('templates', 'userId', 'images', 'defaultTemplate', 'templateFileName', 'eventTemplate', 'templateFileNameEvent', 'infoTemplate', 'templateFileNameInfo', 'promotionTemplate', 'templateFileNamePromotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {
        
    }

    public function store(Request $request) {


        $data = Input::all();
        $input = array();
        $id = $data['templateId'];
        $templateName = $data['templateName'];
        $input['description'] = $data['templateDescription'];
        $input['templateName'] = $templateName;
        $input['firstname'] = $data['firstname'];
        $directory = 'template_builder/html/' . Auth::user()->id . '/';
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true, true);
            $files = File::files($directory);
            $filePath = $directory . $templateName . ".html";
            File::put($filePath, $data['content']);
        } else {
            $files = File::files($directory);
            $filePath = $directory . $templateName . ".html";
            File::put($filePath, $data['content']);
        }
        if ($data['templateId'] == '') {
            $emails = new Emails($input);
            Auth::user()->emailTemplates()->save($emails);
            $id = $emails->id;
        } else {
            $templates = Auth::user()->emailTemplates()->findOrFail($id);

            $templates->update($input);
            $id = $templates->id;
        }
        //$emails->save();


        return Response::json(array(
                    'id' => $id
        ));
    }

    public function gallery() {
        $images = array();
        $directory = 'uploads/templateImages/' . Auth::user()->id;
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        } else {
            $files = File::files($directory);
            foreach ($files as $file) {
                $images[] = (string) $file;
            }
        }

        return View::make('campaign.galleryList', compact('images'));
    }

    public function galleryFileUpload(Request $request) {

        if ($request->ajax()) {
            if (Input::hasFile('upl')) {
                $gallerydestinationPath = 'uploads/templateImages/' . Auth::user()->id;
                if (!File::exists($gallerydestinationPath)) {
                    File::makeDirectory($gallerydestinationPath, 0777, true, true);
                }
                $gextension = Input::file('upl')->getClientOriginalExtension(); // getting image extension
                $gfileName = md5(time()) . rand(11111, 99999) . '.' . $gextension; // renameing image
                Input::file('upl')->move($gallerydestinationPath, $gfileName); // uploading file to given path
                return Response::json(array('success' => true, 'filePath' => "/" . $gallerydestinationPath . '/' . $gfileName));
            }
        }
    }

    public function destroy($id) {

        $emailTemplateId = explode(",", $id);
        $EmailTemplates = Emails::whereIn('id', $emailTemplateId);
        $email = $EmailTemplates->get();
        //Delete File From Server
        foreach ($email as $templateName) {
            unlink(public_path("/template_builder/html/{$templateName['adminid']}/{$templateName['templateName']}.html"));
            $EmailTemplatesDelete = Emails::find($templateName['id']);
            $res = $EmailTemplatesDelete->delete();
        }
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

    public function destroyEmailcampaign(Request $request) {
        $data = Input::all();

        $emailTemplateId = $data['checkBoxValue'];

        $EmailTemplates = EmailCampaign::whereIn('id', $emailTemplateId);
        $email = $EmailTemplates->get();
        //Delete File From Server
        foreach ($email as $templateName) {
            //    unlink(public_path("/template_builder/html/{$templateName['adminid']}/{$templateName['templateName']}.html"));
            $EmailTemplatesDelete = EmailCampaign::find($templateName['id']);
            $res = $EmailTemplatesDelete->delete();
        }
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

    public function duplicateTemplate($id) {

        $email = Emails::where('id', $id);
        $originalTemplate = $email->get();
        $fileName = "/template_builder/html/{$originalTemplate[0]['adminid']}/" . $originalTemplate[0]['templateName'] . ".html";
        $originalDile = $fileName;
        $pathInfo = pathinfo($fileName);
        $extension = isset($pathInfo['extension']) ? ('.' . $pathInfo['extension']) : '';
        if (preg_match('/(.*?)(\d+)$/', $pathInfo['filename'], $match)) {
            $base = $match[1];
            $number = intVal($match[2]);
        } else {
            $base = $pathInfo['filename'];
            $number = 0;
        }
        do {
            $fileName = $pathInfo['dirname'] . "/" . $base . ++$number . $extension;
        } while (file::exists($fileName));
        $targetpath = substr($fileName, 1);
        $contents = File::get(public_path($originalDile));
        File::put($targetpath, $contents);
        $EmailTemplates = Emails::findOrFail($id);
        $email = $EmailTemplates->get();
        $input['templateName'] = $number;
        $input['description'] = $originalTemplate[0]['description'];
        $input['adminid'] = $originalTemplate[0]['adminid'];
        $emailsResult = new Emails($input);
        $res = $emailsResult->save($input);
        if ($res) {
            $success = true;
            $msg = "Record Duplicated Successfully.";
        } else {
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }
        return Response::json(array(
                    'success' => $success,
                    'message' => $msg,
        ));
    }

    public function rename($id) {
        $input['templateName'] = $_POST['templateName'];
        $templates = Emails::findOrFail($id);

        $templates->update($input);
    }

    public function campaignTable(Request $request) {
        $dataToFetch = $request->input('mailType');
        if (Auth::user()->type == 'superadmin') {
            if ($dataToFetch == "") {
                $campaignList = EmailCampaign::select(['id', 'adminid', 'campaignName', 'campaignStatus']);
            } else {
                $campaignList = EmailCampaign::select(['id', 'adminid', 'campaignName', 'campaignStatus'])->where('campaignStatus', '=', $dataToFetch);
            }
        } else {
            if ($dataToFetch == "") {
                $campaignList = Auth::user()->emailCampaign()->select(['id', 'adminid', 'campaignName', 'campaignStatus']);
            } else {
                $campaignList = Auth::user()->emailCampaign()->select(['id', 'adminid', 'campaignName', 'campaignStatus'])->where('campaignStatus', '=', $dataToFetch);
            }
        }

        return Datatables::of($campaignList)
                        ->addColumn('checkbox', function ($campaignList) {
                            return ' <label class="">
                              <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" value="' . $campaignList->id . '" name="emailTemplateDelete[]"  class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>';
                        })
                        ->addColumn('statistics', function ($campaignList) {
                            return 'Statistics';
                        })
                        ->addColumn('edit', function ($campaignList) {
                            return '  <td class="tselectbox">
                        <div class="dropdown editbtn">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span>Actions</span>
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><span><a href="' . url("emails/emailSetup/{$campaignList->id}/edit") . '">Edit</a></span></li>

                      </ul>
                    </div>
                    </td>';
                        })
                        ->make(true);
    }

    public function reviewState($id) {
        $userId = Auth::user()->id;
        $hotspot = Hotspot::where("adminid", "=", $userId)->get();
        foreach ($hotspot as $hotspot) {
            $hotspot->reviewstatus = $id;
            $hotspot->save();
        }
        if ($hotspot) {
            return Response::json(array(
                        'status' => 'success'
            ));
        } else {
            return Response::json(array(
                        'status' => 'Fail'
            ));
        }
    }

    public function emailReviews() {
        $routers = Auth::user()->hotspots()->select('shortname', 'id')->lists('shortname', 'id');
        $email = Auth::user()->email;
        //$routers = Auth::user()->hotspots()->select('ssid')->lists('ssid', 'ssid');
        //$calledmac = Session::get('calledmac'); 
        //$usrFeedData = UsersFeedback::where("username","=",$username)->where("nasidentifier","=",$calledmac)->first(); 
        $routers = array('' => "Select Router") + $routers;


        /*
         * me@diegopucci.com
         * Get Chart Data
         */
        return View::make("email.review", compact("routers", "email"));
    }

    //public function emailReviewsUpdate($nasId,$fieldName,$fieldVal) {
    public function emailReviewsUpdate() {
        $input = Input::all();
        $id = $input['nasId'];
        $fieldName = $input['fieldName'];
        $fieldVal = $input['fieldVal'];
        $hotspot = Hotspot::where("id", "=", $id)->first();
        $hotspot->$fieldName = $fieldVal;
        $hotspot->save();
        if ($hotspot) {
            return Response::json(array(
                        'status' => 'success'
            ));
        } else {
            return Response::json(array(
                        'status' => 'fail'
            ));
        }
    }

    public function getHotspotDetail($routerID) {
        $hotspot = Hotspot::where("id", "=", $routerID)->first();
        return Response::json(array(
                    'hotspot' => $hotspot
        ));
    }

    /*
     * me@diegopucci.com
     * Return transactionals report for logged in admin
     */

    public function reportTransactionals() {

        $input = Input::all();

        if (!isset($input["router"])) {
            die;
        }

        $stats = [];
        $reportData = \App\EmailEvents::reportData("transactionals", $input["router"]);

        $statsArr = [];
        if (count($reportData) > 0) {
            $stats = $reportData["statictic"];
            foreach ($stats as $stat => $value) {
                switch ($stat) {
                    /*
                      case "deliver":
                      array_push($statsArr, array(
                      "value" => $value,
                      "color" => "#00a65a",
                      "highlight" => "#00a65a",
                      "label" => "Delivered"
                      ));
                      break;
                     */
                    case "open":
                        array_push($statsArr, array(
                            "value" => $value,
                            "color" => "#f39c12",
                            "highlight" => "#f39c12",
                            "label" => "Opened"
                        ));
                        break;
                    case "click":
                        array_push($statsArr, array(
                            "value" => $value,
                            "color" => "#00c0ef",
                            "highlight" => "#00c0ef",
                            "label" => "Clicked"
                        ));
                        break;
                    case "bounce":
                        array_push($statsArr, array(
                            "value" => $value,
                            "color" => "#3c8dbc",
                            "highlight" => "#3c8dbc",
                            "label" => "Bounced"
                        ));
                        break;
                }
            }
        }
        return json_encode($statsArr);
        die;
    }

    //  <li><span><a href="javascript:void(0)" class="duplicateTemplate" id="' . $campaignList->id . '">Duplicate</a></span></li>
//                        <li><span><a href="javascript:void(0)" class="renameTemplate" id="' . $campaignList->id . '" templateName="' . $campaignList->campaignName . '">Rename</a></span></li>
}
