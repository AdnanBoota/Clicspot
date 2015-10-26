<?php namespace App\Http\Controllers;


use App\Campaign;
use App\Hotspot;
use App\HotspotAttributes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;

class HotspotController extends Controller
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
                $hotspot = Hotspot::with(['status'])->select(['id', 'shortname', 'nasidentifier']);
            } else {
                $hotspot = Auth::user()->hotspots()->with(['status'])->select(['id', 'shortname', 'nasidentifier']);
            }
            return Datatables::of($hotspot)
                ->addColumn('edit', function ($hotspot) {
                    return '<a href="' . url("hotspot/{$hotspot->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
                })
                ->addColumn('delete', function ($hotspot) {
                    return '<a class="btn btn-xs btn-danger" id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $hotspot->id . '><i class="glyphicon glyphicon-trash"></i></a>';
                })
                ->addColumn('publicip', function ($hotspot) {
                    return $hotspot->status->publicip;
                })
                ->setRowClass(function ($hotspot) {
                    if ((time() - strtotime($hotspot->status->updated_at)) < 180) {
                        return 'success';
                    } else {
                        return 'danger';
                    }
                })
                ->addColumn('lastcheckin', function ($hotspot) {
                    return $hotspot->status->updated_at->diffForHumans();
                })
                ->addColumn('status', function ($hotspot) {
                    if ((time() - strtotime($hotspot->status->updated_at)) < 180) {
                        return '<i class="fa fa-circle" style="color: green;"></i> Up';
                    } else {
                        return '<i class="fa fa-circle" style="color: red;"></i> Down';
                    }
                })
                ->make(true);
        } else {
            return view('hotspot.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->type == 'superadmin') {
            $campaign = Auth::user()->campaigns()->lists('name', 'id');
        } else {
            $campaign = Auth::user()->campaigns()->lists('name', 'id');
        }
        $hotspotDetails = array();
        $readonly = Session::has('mac') ? "readonly" : "";
        return View::make('hotspot.create', compact('campaign', 'hotspotDetails', 'readonly'));
    }

    public function createClone()
    {
        //return View::make('hotspot.create');
        return View::make('hotspot.create1');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $nasRule = 'required|exists:routers,macaddress|unique:nas';
//        if ($id) {
//            $nasRule .= ',nasidentifier,' . $id;
//        }

        $this->validate($request,
            [
                'shortname' => 'required',
                'nasidentifier' => $nasRule,
                'address' => 'required']
        );
        $hotspot = new Hotspot($input);
        Auth::user()->hotspots()->save($hotspot);
        Session::remove('mac');
        $hotAttrArr = array(
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 1, 'value' => $request->input('ChilliSpot-Bandwidth-Max-Up'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 1, 'value' => $request->input('ChilliSpot-Bandwidth-Max-Down'))),
            new HotspotAttributes(array('attribute' => 'Session-Timeout', 'type' => 1, 'value' => $request->input('Session-Timeout'))),
            new HotspotAttributes(array('attribute' => 'Idle-Timeout', 'type' => 1, 'value' => $request->input('Idle-Timeout'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 2, 'value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Up'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 2, 'value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Down'))),
            new HotspotAttributes(array('attribute' => 'Session-Timeout', 'type' => 2, 'value' => $request->input('EMail_Session-Timeout'))),
            new HotspotAttributes(array('attribute' => 'Idle-Timeout', 'type' => 2, 'value' => $request->input('EMail_Idle-Timeout')))
        );

        $hotspot->hotspotAttributes()->saveMany($hotAttrArr);

        $successMsg = "New Hotspot added successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('hotspot');
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
        $campaign = Campaign::getDefaultCampaign()->lists('name', 'id');
        if (Auth::user()->type == 'superadmin') {
            $userCampaign = Hotspot::find($id)->user->campaigns()->lists('name', 'id');
        } else {
            $userCampaign = Auth::user()->campaigns()->lists('name', 'id');
        }
        $campaign += $userCampaign;
        $hotspot = Hotspot::findOrFail($id);
        $attributes = $hotspot->hotspotAttributes;
        foreach ($attributes as $key => $value) {
            if($value['type'] == 1) {
                $hotspot[$value['attribute']] = $value['value'];
            }else{
                $hotspot["EMail_".$value['attribute']] = $value['value'];
            }
        }
        $readonly = Session::has('mac') ? "readonly" : "";
        return view('hotspot.edit', compact('hotspot', 'campaign', 'readonly'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = Input::all();
        $nasRule = 'required|exists:routers,macaddress|unique:nas,nasidentifier,' . $id;

        $this->validate($request,
            [
                'shortname' => 'required',
                'nasidentifier' => $nasRule,
                'address' => 'required']
        );
        if (Auth::user()->type == 'superadmin') {
            $hotspot = Hotspot::findOrFail($id);
        } else {
            $hotspot = Auth::user()->hotspots()->findOrFail($id);
        }

        $hotspot->update($input);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 1])
            ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Up')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 1])
            ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Down')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Session-Timeout', 'type' => 1])
            ->update(['value' => $request->input('Session-Timeout')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Idle-Timeout', 'type' => 1])
            ->update(['value' => $request->input('Idle-Timeout')]);


        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 2])
            ->update(['value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Up')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 2])
            ->update(['value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Down')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Session-Timeout', 'type' => 2])
            ->update(['value' => $request->input('EMail_Session-Timeout')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Idle-Timeout', 'type' => 2])
            ->update(['value' => $request->input('EMail_Idle-Timeout')]);

        $successMsg = "Hotspot updated successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('hotspot');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $hotsopt = Hotspot::find($id);
        $res = $hotsopt->delete();
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
