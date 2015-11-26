<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Users;
use Socialize;

class GoogleLogin extends Controller
{

    public function login()
    {
        
//        $scopes = [
//            'https://www.googleapis.com/auth/plus.me',
//            'https://www.googleapis.com/auth/plus.profile.emails.read',
//        ];
//        return Socialize::with('google')->scopes($scopes)->redirect();
          return Socialize::with('google')->redirect();
    }

    function callback()
    {
        $user = Socialize::with('google')->user();
        //dd($user);
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 1,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'gender' => $user->user['gender'],
            'profileurl' => $user->user['url'],
            'avatar'=>$user->getAvatar(),
            'birthday'=>isset($user->user['birthday'])?$user->user['birthday']:''
        );
        //dd($data);
        $users = Users::where('username', $data['username'])->first();
        if ($users) {
            $users->update($data);
        } else {
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }

}
