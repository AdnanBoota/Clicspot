<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignAttributes;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;

class CampaignController extends Controller {

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
            if (Auth::user()->type == 'superadmin') {
                $campaign = Campaign::all();
            } else {
                $campaign = Auth::user()->campaigns()->select(['id', 'name', 'backgroundimage', 'logoimage', 'fontcolor']);
            }
            return Datatables::of($campaign)
                            ->editColumn('backgroundimage', '<img src="uploads/campaign/{{$backgroundimage}}" height="150" width="300" />')
                            ->editColumn('logoimage', '<img src="uploads/campaign/{{$logoimage}}" height="75" width="150" />')
                            ->editColumn('fontcolor', '<span class="btn btn-default"><i class="fa fa-font" style="color: {{$fontcolor}}"></i></span> {{$fontcolor}}')
                            ->addColumn('edit', function ($campaign) {
                                return '<a href="' . url("campaign/{$campaign->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
                            })
                            ->addColumn('delete', function ($campaign) {
                                return '<a class="btn btn-xs btn-danger" id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $campaign->id . '><i class="glyphicon glyphicon-trash"></i></a>';
                            })
                            ->make(true);
        } else {
            return view('campaign.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //return View::make('campaign.create');
        $images = array();
        $directory = 'uploads/gallery';
        $files = File::files($directory);
        foreach ($files as $file) {
            $images[] = "/" . (string) $file;
        }
        $directory = 'uploads/gallery/' . Auth::user()->id;
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        } else {
            $files = File::files($directory);
            foreach ($files as $file) {
                $images[] = "/" . (string) $file;
            }
        }
        
        $campaignnas= \App\Hotspot::where("nas.adminid",Auth::user()->id)
                    ->select('nas.ssid','campaign.name','nas.id as nasid')
                    ->leftJoin('campaign','campaign.id','=','nas.campaignid')
                    ->get();
        
        $campaign=array();
        return View::make('campaign.create', compact('images','campaignnas','campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $input=Input::all();
//        echo '<pre>';
//        print_r($input); exit;
         $campaign = new Campaign();
         if($input['backgroundimage']){
             $bgdestinationPath = 'uploads/campaign'; // upload path
            $bgpath_parts = pathinfo($input['backgroundimage']);
            $bgextension = $bgpath_parts['extension']; // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // re-nameing image
            File::copy(ltrim($input['backgroundimage'], '/'), $bgdestinationPath . '/' . $bgfileName);
         }
         $logofileName = "";
        if ($request->input('logoimage')) {
//            $logodestinationPath = 'uploads/campaign'; // upload path
//            $logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
//            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // renameing image
//            Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
            $logodestinationPath = 'uploads/campaign'; // upload path
            $lgpath_parts = pathinfo($input['logoimage']);
            $logoextension = $lgpath_parts['extension'];
            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // re-nameing image
            File::copy(ltrim($input['logoimage'], '/'), $logodestinationPath . '/' . $logofileName);
        }
        $adfileName="";
         if ($request->input('advertimage')) {
             
            $addestinationPath = 'uploads/campaign'; // upload path
            $adpath_parts = pathinfo($input['advertimage']);
            $adextension = $adpath_parts['extension'];
            $adfileName = md5(time()) . rand(11111, 99999) . '.' . $adextension; // re-nameing image
            File::copy(ltrim($input['advertimage'], '/'), $addestinationPath . '/' . $adfileName);
        }
          $this->validate($request, [
            'name' => 'required',
            'fontcolor' => 'required',
            'fakebrowser'=>'required'  
              ]
        );
        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;
        $input['advertimage']=$adfileName;
         $campaign->adminid=Auth::user()->id;
         $campaign->name=$input['name'];
         $campaign->backgroundimage=$input['backgroundimage'];
         $campaign->logoimage=$input['logoimage'];
         $campaign->fontcolor=$input['fontcolor'];
         $campaign->description=$input['description'];
         $campaign->logoposition=$input['logoposition'];
         $campaign->backgroundzoom=$input['backgroundzoom'];
         $campaign->blurImg=$input['blurImg'];
         $campaign->advertcheck=$input['advertcheck'];
        $campaign->advertimage=$input['advertimage'];
        $campaign->delayPeriod=$input['delayPeriod'];
        $campaign->fakebrowser=$input['fakebrowser'];
        if(isset($input['fkNasId']))
            $campaign->fkNasId=  implode(",",$input['fkNasId']);
        
        $campaign->adverturl=$input['adverturl'];
        $campaign->save();
        $campaginId=$campaign->id; 
        if(!empty($campaign->fkNasId)){
            $nascamp=explode(",",$campaign->fkNasId);
            $count=count($nascamp); 
            if($count>0){
                foreach($nascamp as $nasval){
                    $hotspot= \App\Hotspot::find($nasval);
                    $hotspot->campaignid=$campaginId;
                    $hotspot->save();
                }
            }
        }
         $successMsg = "New Campaign added successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('campaign');
        exit;
         $input = $request->only('name', 'fontcolor', 'description', 'logoposition', 'backgroundzoom');
        $bgfileName = "";
        if ($request->input('backgroundimage')) {
//            $bgdestinationPath = 'uploads/campaign'; // upload path
//            $bgextension = Input::file('backgroundimage')->getClientOriginalExtension(); // getting image extension
//            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // renameing image
//            Input::file('backgroundimage')->move($bgdestinationPath, $bgfileName); // uploading file to given path
            $bgdestinationPath = 'uploads/campaign'; // upload path
            $bgpath_parts = pathinfo($request->input('backgroundimage'));
            $bgextension = $bgpath_parts['extension']; // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // re-nameing image
            File::copy(ltrim($request->input('backgroundimage'), '/'), $bgdestinationPath . '/' . $bgfileName);
        }
        $logofileName = "";
        if ($request->input('logoimage')) {
//            $logodestinationPath = 'uploads/campaign'; // upload path
//            $logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
//            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // renameing image
//            Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
            $logodestinationPath = 'uploads/campaign'; // upload path
            $lgpath_parts = pathinfo($request->input('logoimage'));
            $logoextension = $lgpath_parts['extension'];
            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // re-nameing image
            File::copy(ltrim($request->input('logoimage'), '/'), $logodestinationPath . '/' . $logofileName);
        }
        if($input['advertimage']){
            
        }

        $this->validate($request, [
            'name' => 'required',
            'fontcolor' => 'required',
            'fakebrowser'=>'required' ]
        );

        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;
        $campaign = new Campaign($input);
        Auth::user()->campaigns()->save($campaign);
        $successMsg = "New Campaign added successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('campaign');
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
        
        $campaign = Campaign::findOrFail($id);
        $attributes = $campaign->campaignAttributes;
        foreach ($attributes as $key => $value) {
            $campaign[$value['attribute']] = $value['value'];
        }
        $images = array();
        $directory = 'uploads/gallery';
        $files = File::files($directory);
        foreach ($files as $file) {
            $images[] = "/" . (string) $file;
        }
        $directory = 'uploads/gallery/' . Auth::user()->id;
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        } else {
            $files = File::files($directory);
            foreach ($files as $file) {
                $images[] = "/" . (string) $file;
            }
        }
         $campaignnas= \App\Hotspot::where("nas.adminid",Auth::user()->id)
                    ->select('nas.ssid','campaign.name','nas.id as nasid')
                    ->leftJoin('campaign','campaign.id','=','nas.campaignid')
                    ->get();
        return view('campaign.edit', compact('campaign', 'images','campaignnas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {
//        echo '<pre>';
//        $input=Input::all();
//        print_r($input); exit;
       $input=Input::all();
        if (Auth::user()->type == 'superadmin') {
            $campaign = Campaign::findOrFail($id);
        } else {
            $campaign = Auth::user()->campaigns()->findOrFail($id);
        }
        $bgfileName = $input['oldbackgroundimage'];
        
        if ($input['oldbackgroundimage'] != $input['backgroundimage']) {
            $bgdestinationPath = 'uploads/campaign'; // upload path
            
            $bgpath_parts = pathinfo($input['backgroundimage']);
            $bgextension = $bgpath_parts['extension']; // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // re-nameing image
            File::copy(ltrim($input['backgroundimage'], '/'), $bgdestinationPath . '/' . $bgfileName);
            
            //Input::file('backgroundimage')->move($bgdestinationPath, $bgfileName); // uploading file to given path
            if (File::exists($bgdestinationPath . '/' . $input['oldbackgroundimage'])) {
                File::delete($bgdestinationPath . '/' . $input['oldbackgroundimage']);
            }
            }
        
        
            $logofileName = $input['oldlogoimage'];
            if ($input['oldlogoimage'] != $input['logoimage']) {
                $logodestinationPath = 'uploads/campaign'; // upload path
                $lgpath_parts = pathinfo($input['logoimage']);
                $logoextension = $lgpath_parts['extension'];
                //$logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
                $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // re-nameing image
                //Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
                File::copy(ltrim($input['logoimage'], '/'), $logodestinationPath . '/' . $logofileName);
                if (File::exists($logodestinationPath . '/' . $input['oldlogoimage'])) {
                    File::delete($logodestinationPath . '/' . $input['oldlogoimage']);
                }
            }
        
        $adfileName=$input['oldadvertimage'];
         if ($input['oldadvertimage'] != $input['advertimage']) {
             
            $addestinationPath = 'uploads/campaign'; // upload path
            $adpath_parts = pathinfo($input['advertimage']);
            $adextension = $adpath_parts['extension'];
            $adfileName = md5(time()) . rand(11111, 99999) . '.' . $adextension; // re-nameing image
            File::copy(ltrim($input['advertimage'], '/'), $addestinationPath . '/' . $adfileName);
            if (File::exists($addestinationPath . '/' . $input['oldadvertimage'])) {
                File::delete($addestinationPath . '/' . $input['oldadvertimage']);
            }
        }
       
//        if($input['backgroundimage']!="")
//            $input['backgroundimage'] = $bgfileName;
//        else
//            $input['backgroundimage'] = $input['oldbackgroundimage'];
//        
//        if($input['logoimage']!=""){
//            
//            $input['logoimage'] = $logofileName;
//        }else
//            $input['logoimage'] = $input['oldlogoimage'];
//        
        if($input['adverturl']!=""){
            
        }
        else if($input['advertimage']!=""){
            $input['adverturl']="";
            $input['advertimage'] = $adfileName;
        }
//        }else
//            $input['advertimage'] = $input['oldadvertimage'];
//        
        if(isset($input['fkNasId']))
            $input['fkNasId']=  implode (",",$input['fkNasId']);
        
        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;
        $input['advertimage'] = $adfileName;
        
         $campaign->update($input);
//          $campaginId=$campaign->id; 
//          if(!empty($campaign->fkNasId)){
//            $nascamp=explode(",",$campaign->fkNasId);
//            $count=count($nascamp); 
//            if($count>0){
//                foreach($nascamp as $nasval){
//                    $hotspot= \App\Hotspot::find($nasval);
//                    $hotspot->campaignid=$campaginId;
//                    $hotspot->save();
//                }
//            }
//        }
        $successMsg = "Campaign updated successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('campaign');
        exit;
        
        $input = $request->only('name', 'fontcolor', 'description', 'logoposition', 'backgroundzoom','blurImg','advertcheck','advertimage','delayPeriod','delayPeriod','fakebrowser','fkNasId');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $campaign = Campaign::find($id);
        $res = $campaign->delete();
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

    public function datatable() {
        return "";
    }

    public function gallery() {
        $images = array();
        $directory = 'uploads/gallery/' . Auth::user()->id;
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

    public function addgallery() {
        return View::make('campaign.gallery');
    }

    public function galleryFileUpload(Request $request) {
        if ($request->ajax()) {
            if (Input::hasFile('upl')) {
                $gallerydestinationPath = 'uploads/gallery/' . Auth::user()->id;
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

    public function deleteImage(Request $request) {

        if ($request->input('imagePath')) {
            if (File::exists($request->input('imagePath'))) {
                File::delete($request->input('imagePath'));
                $success = true;
                $msg = "Record Deleted Successfully.";
            } else {
                $success = false;
                $msg = "Something went wrong , Please try again later.";
            }
        } else {
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }
        return Response::json(array(
                    'success' => $success,
                    'message' => $msg,
        ));
    }
    public function updatecampaign($id,$campid){
         $hotspot= \App\Hotspot::find($id);
                    $hotspot->campaignid=$campid;
                    $hotspot->save();
    }


}
