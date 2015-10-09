<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EMailLoginController extends Controller
{
    public function login(Request $request)
    {
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 2,
            'name' => $request->input('fname')." ".$request->input('lname'),
            'email' => $request->input('email'),
            'gender' => null,
            'profileurl' => null
        );
        $users = Users::where('username', $data['username'])->first();
        if ($users) {
            $users->update($data);
        } else {
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }
}
