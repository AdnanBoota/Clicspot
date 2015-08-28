<?php namespace App\Http\Controllers;

use App\Hotspot;
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
        $mac = Request::get('called');
        $hotspot = Hotspot::where('nasidentifier', "=", $mac)->first();
        if ($hotspot) {
            $res = Request::get('res');
            if ($res == 'notyet' || $res == 'failed' || $res == 'logoff') {
                return $this->display_notyet(Request::all(), $hotspot);
            } elseif ($res == 'already' || $res == 'success') {
                return $this->display_success(Request::all(), $hotspot);
            }
        } else {
            return redirect('/hotspot/create');
        }
    }

    public function login()
    {
        $username = Request::get('username');
        $password = 1;
        return view('hotspotlogin.login', compact('username', 'password'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_notyet($request, $hotspot)
    {
        session(
            [
                'uamip' => $request['uamip'],
                'uamport' => $request['uamport'],
                'mac' => $request['mac'],
                'challenge' => $request['challenge']
            ]
        );
        return view('hotspotlogin.notyet', compact('request', 'hotspot'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_success($request, $hotspot)
    {
        return view('hotspotlogin.success', compact('request', 'hotspot'));
    }


}
