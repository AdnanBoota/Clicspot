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
                            ->addColumn('edit', function ($emailTemplate) {
                                return '<a href="' . url("emails/{$emailTemplate->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
                            })
                            ->addColumn('description', function ($emailTemplate) {
                                return 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';
                            })
                            ->make(true);
        } else {

            return view('email.index');
        }
    }

    public function getEmail() {
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
        return View::make('email.create', compact('getAllTemplates', 'images'));
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
        return View::make('email.create', compact('templates', 'userId', 'images'));
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
        $id=$data['templateId'];
        if ($data['templateName'] == '') {
            $length = 8;
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            $templateName = $randomString;
        } else {
            $templateName = $data['templateName'];
        }
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

}
