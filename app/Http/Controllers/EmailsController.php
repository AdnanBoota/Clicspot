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
        $getAllTemplates = Emails::select(DB::raw('adminid,templateName'))->get();


        return View::make('email.create', compact('getAllTemplates'));
    }

    public function edit($id) {
        $templates = Emails::findOrFail($id);
        $userId = Auth::id();
        return View::make('email.create', compact('templates', 'userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {
        if (Auth::user()->type == 'superadmin') {
            $campaign = Campaign::findOrFail($id);
        } else {
            $campaign = Auth::user()->campaigns()->findOrFail($id);
        }

        $input = $request->only('name', 'fontcolor', 'description', 'logoposition', 'backgroundzoom');
        //dd($request->input('description'));
        $bgfileName = $request->input('oldbackgroundimage');
        if ($request->input('oldbackgroundimage') != $request->input('backgroundimage')) {
            $bgdestinationPath = 'uploads/campaign'; // upload path
            $bgpath_parts = pathinfo($request->input('backgroundimage'));
            $bgextension = $bgpath_parts['extension']; // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // re-nameing image
            File::copy(ltrim($request->input('backgroundimage'), '/'), $bgdestinationPath . '/' . $bgfileName);
            //Input::file('backgroundimage')->move($bgdestinationPath, $bgfileName); // uploading file to given path
            if (File::exists($bgdestinationPath . '/' . $request->input('oldbackgroundimage'))) {
                File::delete($bgdestinationPath . '/' . $request->input('oldbackgroundimage'));
            }
        }

        $logofileName = $request->input('oldlogoimage');
        if ($request->input('oldlogoimage') != $request->input('logoimage')) {
            $logodestinationPath = 'uploads/campaign'; // upload path
            $lgpath_parts = pathinfo($request->input('logoimage'));
            $logoextension = $lgpath_parts['extension'];
            //$logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // re-nameing image
            //Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
            File::copy(ltrim($request->input('logoimage'), '/'), $logodestinationPath . '/' . $logofileName);
            if (File::exists($logodestinationPath . '/' . $request->input('oldlogoimage'))) {
                File::delete($logodestinationPath . '/' . $request->input('oldlogoimage'));
            }
        }
        $this->validate($request, [
            'name' => 'required',
            'fontcolor' => 'required'
                ]
        );
        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;

        $campaign->update($input);
        $successMsg = "Campaign updated successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('campaign');
    }

    public function store(Request $request) {
        $data = Input::all();
        $input = array();

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


        $emails = new Emails($input);

        Auth::user()->emailTemplates()->save($emails);
        //$emails->save();


        return Response::json(array(
                    'success' => "hi",
                    'message' => "called",
        ));
    }

}
