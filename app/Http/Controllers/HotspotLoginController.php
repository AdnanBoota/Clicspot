<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Hotspot;
use App\Http\Requests;
use App\HotspotAttributes;
use Request;
use Session;
use DB;

class HotspotLoginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
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
            Session::put('mac', $mac);
            return redirect('/hotspot/create');
        }
    }

    public function login() {
        //  echo Session::get('mac');
        $mac = Session::get('mac');
        $hotspot = Hotspot::where('nasidentifier', "=", $mac)->first();
        $hotspotAttr=array();
        $redirectURL="https://www.google.com";
        if ($hotspot) {
            $hotspotAttr = HotspotAttributes::select(DB::raw('users.username,users.type,nas_attributes.nasid,nas_attributes.type,nas_attributes.attribute,nas_attributes.value'))
                    ->join('nas', 'nas_attributes.nasid', '=', 'nas.id')
                    ->join('users', 'nas_attributes.type', '=', 'users.type')
                    ->where('users.username', '=', Request::get('username'))
                    ->where('nas.id', '=', $hotspot->id)
                    ->get();

            if ($hotspot->redirectUrl && $hotspot->redirectUrl != "") {
                $redirectURL = $hotspot->redirectUrl;
            } else {
                $redirectURL = "https://www.google.com";
            }
        }
        $username = Request::get('username');
        $password = 1;
        return view('hotspotlogin.login', compact('username', 'password', 'redirectURL', 'hotspotAttr'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_notyet($request, $hotspot) {
        session(
                [
                    'uamip' => $request['uamip'],
                    'uamport' => $request['uamport'],
                    'mac' => $request['mac'],
                    'challenge' => $request['challenge']
                ]
        );
        $campaign = $hotspot->campaign;
        return view('hotspotlogin.notyet', compact('request', 'hotspot', 'campaign'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_success($request, $hotspot) {
        return view('hotspotlogin.success', compact('request', 'hotspot'));
    }

}
