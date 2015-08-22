<?php namespace App\Http\Controllers;

use App\Hotspot;
use App\Http\Requests;
use Request;
use Session;

class HotspotLoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mac = Request::get('mac');
        $hotspot = Hotspot::where('nasidentifier', $mac)->first();
        if ($hotspot) {
            $res = Request::get('res');
            if ($res == 'notyet' || $res == 'failed' || $res == 'logoff') {
                return $this->display_notyet(Request::all());
            } elseif ($res == 'already' || $res == 'success') {
                return $this->display_success(Request::all());
            }
        } else {
            Session::flash('flash_message_error', 'Hotspot not registered, Please Login and add hotspot');
            return redirect('/');
        }
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_notyet($request)
    {
        return view('hotspot.notyet', compact('request'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_success($request)
    {
        return view('hotspot.success', compact('request'));
    }

}
