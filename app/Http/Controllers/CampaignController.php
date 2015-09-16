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
//                $campaign = Campaign::get()->select(['id','name', 'backgroundimage', 'logoimage', 'fontcolor']);
            } else {
                $campaign = Auth::user()->campaigns()->select(['id', 'name', 'backgroundimage', 'logoimage', 'fontcolor']);
            }
            return Datatables::of($campaign)
                ->editColumn('backgroundimage', '<img src="uploads/campaign/{{$backgroundimage}}" height="50" width="50" />')
                ->editColumn('logoimage', '<img src="uploads/campaign/{{$logoimage}}" height="50" width="50" />')
                ->editColumn('fontcolor', '<p><font color="{{$fontcolor}}">{{$fontcolor}}</font></p>')
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
        return View::make('campaign.create', ['campaign' => array()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $input = $request->only('name', 'fontcolor');
        $bgfileName = "";
        if (Input::hasFile('backgroundimage')) {
            $bgdestinationPath = 'uploads/campaign'; // upload path
            $bgextension = Input::file('backgroundimage')->getClientOriginalExtension(); // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // renameing image
            Input::file('backgroundimage')->move($bgdestinationPath, $bgfileName); // uploading file to given path
        }
        $logofileName = "";
        if (Input::hasFile('logoimage')) {
            $logodestinationPath = 'uploads/campaign'; // upload path
            $logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // renameing image
            Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
        }

        $this->validate($request,
            [
                'name' => 'required',
                'backgroundimage' => 'required',
                'logoimage' => 'required',
                'fontcolor' => 'required']
        );

        $input['backgroundimage'] = $bgfileName;
        $input['logoimage'] = $logofileName;

        $res = Auth::user()->campaigns()->save(new Campaign($input));

        $campainId = $res->id;

        $campAttrUpload = new CampaignAttributes;
        $campAttrUpload->campaignid = $campainId;
        $campAttrUpload->attribute = 'ChilliSpot-Bandwidth-Max-Up';
        $campAttrUpload->value = $request->input('ChilliSpot-Bandwidth-Max-Up');
        $campAttrUpload->save();

        $campAttrDownload = new CampaignAttributes;
        $campAttrDownload->campaignid = $campainId;
        $campAttrDownload->attribute = 'ChilliSpot-Bandwidth-Max-Down';
        $campAttrDownload->value = $request->input('ChilliSpot-Bandwidth-Max-Down');
        $campAttrDownload->save();

        $campAttrTimeout = new CampaignAttributes;
        $campAttrTimeout->campaignid = $campainId;
        $campAttrTimeout->attribute = 'Session-Timeout';
        $campAttrTimeout->value = $request->input('Session-Timeout');
        $campAttrTimeout->save();

        $campAttrTimeout = new CampaignAttributes;
        $campAttrTimeout->campaignid = $campainId;
        $campAttrTimeout->attribute = 'Idle-Timeout';
        $campAttrTimeout->value = $request->input('Idle-Timeout');
        $campAttrTimeout->save();

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
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //return $request->all();
        $input = $request->only('name', 'fontcolor');

        $bgfileName = $request->input('oldbackgroundimage');
        if (Input::hasFile('backgroundimage')) {
            $bgdestinationPath = 'uploads/campaign'; // upload path
            $bgextension = Input::file('backgroundimage')->getClientOriginalExtension(); // getting image extension
            $bgfileName = md5(time()) . rand(11111, 99999) . '.' . $bgextension; // re-nameing image
            Input::file('backgroundimage')->move($bgdestinationPath, $bgfileName); // uploading file to given path
            if (File::exists($bgdestinationPath . '/' . $request->input('oldbackgroundimage'))) {
                File::delete($bgdestinationPath . '/' . $request->input('oldbackgroundimage'));
            }

        }

        $logofileName = $request->input('oldlogoimage');
        if (Input::hasFile('logoimage')) {
            $logodestinationPath = 'uploads/campaign'; // upload path
            $logoextension = Input::file('logoimage')->getClientOriginalExtension(); // getting image extension
            $logofileName = md5(time()) . rand(11111, 99999) . '.' . $logoextension; // re-nameing image
            Input::file('logoimage')->move($logodestinationPath, $logofileName); // uploading file to given path
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
        $campaign = Auth::user()->campaigns()->findOrFail($id)->update($input);

        $campAttrUpload = $campaign->campaignAttributes()->where('attribute', '=', 'ChilliSpot-Bandwidth-Max-Up');
        $campAttrUpload->value = $request->input('ChilliSpot-Bandwidth-Max-Up');
        $campAttrUpload->save();

        $campAttrDownload = $campaign->campaignAttributes()->where('attribute', '=', 'ChilliSpot-Bandwidth-Max-Down');
        $campAttrDownload->value = $request->input('ChilliSpot-Bandwidth-Max-Down');
        $campAttrDownload->save();

        $campAttrSessionTimeout = $campaign->campaignAttributes()->where('attribute', '=', 'Session-Timeout');
        $campAttrSessionTimeout->value = $request->input('Session-Timeout');
        $campAttrSessionTimeout->save();

        $campAttrIdleTimeout = $campaign->campaignAttributes()->where('attribute', '=', 'Idle-Timeout');
        $campAttrIdleTimeout->value = $request->input('Idle-Timeout');
        $campAttrIdleTimeout->save();

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
}
