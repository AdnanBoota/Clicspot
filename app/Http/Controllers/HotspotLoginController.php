<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Request;

class HotspotLoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $res = Request::get('res');
        if ($res == 'notyet' || $res == 'failed' || $res == 'logoff') {
            return $this->display_notyet(Request::all());
        } elseif ($res == 'already' || $res == 'success') {
            return $this->display_success(Request::all());
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
