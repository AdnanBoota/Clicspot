<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Emails;
use App\Hotspot;
use App\HotspotAttributes;
use Auth;
use DB;
use File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;
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

            return view('email.index');
        }
    }

    public function getEmail() {
        echo "hii";
        exit;
        return View::make('email.email');
    }

    public function postEmail(Request $request) {

        $msgBody = $request->msgBody;
        $subject = $request->subject;
//        dd($request);
        $sendToUser = array(array('email' => 'pritesh@logisticinfotech.com', 'firstName' => 'pritesh'), array('email' => 'nans.noel@gmail.com', 'firstName' => 'Nans'));
        Mail::send('emails.emailTemplate', array('msgBody' => $msgBody), function ($message) use ($sendToUser, $subject) {
            foreach ($sendToUser as $singleUser) {
                $message->to($singleUser['email'], $singleUser['firstName']);
            }
            $message->from('info@clicspot.com', 'Clicspot');
            $message->subject($subject);
        });

        $successMsg = "Email send successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('emails');
    }

    public function create() {
        $images = array();
        $getAllTemplates = Emails::select(DB::raw('id,adminid,templateName'))->get();
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
        return View::make('email.create', compact('getAllTemplates', 'images','defaultTemplate','templateFileName'));
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
        return View::make('email.create', compact('templates', 'userId', 'images','defaultTemplate','templateFileName'));
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
        } else {
            $templates = Auth::user()->emailTemplates()->findOrFail($id);

            $templates->update($input);
        }
        //$emails->save();


        return Response::json(array(
                    'success' => "hi",
                    'message' => "called",
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
     $res=$emailsResult->save($input);
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

}
