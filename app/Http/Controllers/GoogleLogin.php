<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Users;
use Socialize;

class GoogleLogin extends Controller
{

    public function login()
    {
        return Socialize::with('google')->redirect();
    }

    function callback()
    {
        $user = Socialize::with('google')->user();
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 1,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'gender' => $user->user['gender'],
            'profileurl' => $user->getAvatar()
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
