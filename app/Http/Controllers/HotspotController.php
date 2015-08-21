<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Response;
use App\User,Auth,Input;
use App\Hotspot,Redirect,Session;
use yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class HotspotController extends Controller {

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
            
            return Datatables::of(User::find(Auth::user()->id)->Hotspot)
            ->addColumn('edit', function ($hotspot) {
                return '<a href="' . url("hotspot/{$hotspot->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            })
            ->addColumn('delete', function ($hotspot) {
                return '<a id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $hotspot->id . ' class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            })->make(true);
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
		return View::make('hotspot.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        
		
        $input = Input::all();
        $id = $input['id'];
        $nasRule = 'required|exists:routers,macaddress|unique:nas';
        if($id)
            $nasRule .= ',nasidentifier,'.$id;
        
        $this->validate($request,
            [
            'shortname' => 'required',
            'nasidentifier' =>$nasRule ,
            'secret' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required']
        );
        
        if(!$id)
        {
            $hotspot = new Hotspot();
            $successMsg = "New Hotspot added successfully";
        }else{
            $hotspot = Hotspot::find($id);
            $successMsg = "Hotspot update successfully";
        }
        $hotspot->adminid = Auth::user()->id;
        $hotspot->shortname = $input["shortname"];
        $hotspot->nasidentifier = $input["nasidentifier"];
        $hotspot->secret = $input["secret"];
        $hotspot->address = $input["address"];
        $hotspot->latitude = $input["latitude"];
        $hotspot->longitude = $input["longitude"];
        
        
        $hotspot->save();
        Session::flash('flash_message_success', $successMsg);
        return Redirect::route('hotspot.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$hotspot = Hotspot::find($id);
        return View::make('hotspot.create', ['hotspotDetails' => $hotspot]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$hotsopt = Hotspot::find($id);
        $res =  $hotsopt->delete();
        if($res){
            $success = true;
            $msg = "Record Deleted Successfully.";
        }
        else{
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }
        return Response::json(array(
            'success' => $success,
            'message' => $msg, 
        ));
	}

}
