<?php namespace App\Http\Controllers;


use App\Campaign;
use App\Hotspot;
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
        $readonly = Session::has('mac');
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
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required']
        );

        Auth::user()->hotspots()->save(new Hotspot($input));

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
        $readonly = Session::has('mac');
        return view('hotspot.edit', compact('hotspot', 'campaign','readonly'));
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
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required']
        );
        if (Auth::user()->type == 'superadmin') {
            Hotspot::findOrFail($id)->update($input);
        } else {
            Auth::user()->hotspots()->findOrFail($id)->update($input);
        }
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
