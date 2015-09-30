<?php namespace App\Http\Controllers;


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

class CampaignController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
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
    public function create()
    {
        //return View::make('campaign.create');
        $images = array();
        $directory = 'uploads/gallery/' . Auth::user()->id;
        $files = File::allFiles($directory);
        foreach ($files as $file) {
            $images[] = "/" . (string)$file;
        }
        return View::make('campaign.create', compact('images'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $input = $request->only('name', 'fontcolor', 'description');
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

        $this->validate($request,
            [
                'name' => 'required',
                'fontcolor' => 'required']
        );

        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;
        $campaign = new Campaign($input);
        Auth::user()->campaigns()->save($campaign);

        $campAttrArr = array(
            new CampaignAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'value' => $request->input('ChilliSpot-Bandwidth-Max-Up'))),
            new CampaignAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'value' => $request->input('ChilliSpot-Bandwidth-Max-Down'))),
            new CampaignAttributes(array('attribute' => 'Session-Timeout', 'value' => $request->input('Session-Timeout'))),
            new CampaignAttributes(array('attribute' => 'Idle-Timeout', 'value' => $request->input('Idle-Timeout')))
        );

        $campaign->campaignAttributes()->saveMany($campAttrArr);

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $attributes = $campaign->campaignAttributes;
        foreach ($attributes as $key => $value) {
            $campaign[$value['attribute']] = $value['value'];
        }
        $images = array();
        $directory = 'uploads/' . Auth::user()->id;
        $files = File::allFiles($directory);
        foreach ($files as $file) {
            $images[] = "/" . (string)$file;
        }
        $directory = 'uploads/gallery/' . Auth::user()->id;
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 777, true, true);
        } else {
            $files = File::allFiles($directory);
            foreach ($files as $file) {
                $images[] = "/" . (string)$file;
            }
        }

        return view('campaign.edit', compact('campaign', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        if (Auth::user()->type == 'superadmin') {
            $campaign = Campaign::findOrFail($id);
        } else {
            $campaign = Auth::user()->campaigns()->findOrFail($id);
        }

        $input = $request->only('name', 'fontcolor', 'description');
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
        $this->validate($request,
            [
                'name' => 'required',
                'fontcolor' => 'required'
            ]
        );
        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;

        $campaign->update($input);

        $campaign->campaignAttributes()->where('attribute', '=', 'ChilliSpot-Bandwidth-Max-Up')
            ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Up')]);

        $campaign->campaignAttributes()->where('attribute', '=', 'ChilliSpot-Bandwidth-Max-Down')
            ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Down')]);

        $campaign->campaignAttributes()->where('attribute', '=', 'Session-Timeout')
            ->update(['value' => $request->input('Session-Timeout')]);

        $campaign->campaignAttributes()->where('attribute', '=', 'Idle-Timeout')
            ->update(['value' => $request->input('Idle-Timeout')]);

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
    public function destroy($id)
    {
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

    public function datatable()
    {
        return "";
    }

    public function gallery()
    {
        $images = array();
        $directory = 'uploads/gallery/' . Auth::user()->id;
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 777, true, true);
        } else {
            $files = File::allFiles($directory);
            foreach ($files as $file) {
                $images[] = (string)$file;
            }
        }

        return View::make('campaign.galleryList', compact('images'));
    }

    public function addgallery()
    {
        return View::make('campaign.gallery');
    }

    public function galleryFileUpload(Request $request)
    {
        if ($request->ajax()) {
            if (Input::hasFile('upl')) {
                $gallerydestinationPath = 'uploads/gallery/' . Auth::user()->id;
                if (!File::exists($gallerydestinationPath)) {
                    File::makeDirectory($gallerydestinationPath, 0777, true, true);
                }
                $gextension = Input::file('upl')->getClientOriginalExtension(); // getting image extension
                $gfileName = md5(time()) . rand(11111, 99999) . '.' . $gextension; // renameing image
                Input::file('upl')->move($gallerydestinationPath, $gfileName); // uploading file to given path
                return Response::json(array('success' => true));
            }
        }
    }

    public function deleteImage(Request $request)
    {

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

}
