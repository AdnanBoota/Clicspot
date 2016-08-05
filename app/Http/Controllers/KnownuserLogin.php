<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Users;
use App;
use Session;

class KnownuserLogin extends Controller
{
    function login()
    {
	$username = Session::get('mac');
	return redirect(action('HotspotLoginController@login') . "?username=" . $username);
    }

}
