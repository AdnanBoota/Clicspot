<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Users;
use Socialize;
use App;

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
        //echo '<pre>'; print_r($user); exit;
        //dd($user); exit;
        $fullname=$user->getName();
        $fullnm=explode(' ',$fullname);
        //print_r($fullnm); exit;
        $fname=""; $lname="";
        $fname=$fullnm[0];
        if(isset($fullnm[1]))
            $lname=$fullnm[1];
        else
            $lname='';
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 1,
            'firstname'=>$fname,
            'lastname'=>$lname,
            'email' => $user->getEmail(),
            'gender' => isset($user->user['gender']) ? $user->user['gender'] : '',
            'profileurl' => isset($user->user['url']) ? $user->user['url'] : '',
            'avatar'=>$user->getAvatar(),
            'birthday'=>isset($user->user['birthday'])?$user->user['birthday']:'',
            'language'=>App::getLocale()
        );
//        dd($data);
//        exit;
        $users = Users::where('username', $data['username'])->first();
        if ($users) {
            if($users['type']==1 && strpos($users['profileurl'], 'google') !== false){
                $users->update($data);
            }
            
            
        } else {
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }

}
