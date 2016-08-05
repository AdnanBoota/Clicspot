<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Users;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use App;
class FacebookLogin extends Controller
{

    public function login(LaravelFacebookSdk $fb)
    {
        $login_url = $fb
            ->getRedirectLoginHelper()
            ->getLoginUrl(url('/facebook/callback'), ['email', 'public_profile', 'user_friends, user_location']);
        return redirect($login_url);
    }

    function callback(LaravelFacebookSdk $fb)
    {
        // Obtain an access token.
        try {
            $token = $fb
                ->getRedirectLoginHelper()
                ->getAccessToken();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (!$token) {
            // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (!$token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('me/?fields=id,name,email,birthday,picture{height,is_silhouette,url,width},gender,location');

        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        
        $facebook_user = $response->getGraphUser();
       
        $img_profile_src = $fb->get($facebook_user->getField('id') . "/picture?type=large&redirect=false");
        
        $img = $img_profile_src->getGraphUser();
        $fullname=$facebook_user->getName();
        $fullnm=explode(' ',$fullname);
        $fname=$fullnm[0];
        $lname=$fullnm[1];
        if ($facebook_user->getField('email')) {
            $facebookusername = $facebook_user->getField('email');
            }else{
            $facebookusername = $fname . "@facebook.com";
            }
        if ($facebook_user->getField('birthday')) {
            $facebookbirthday = $facebook_user->getField('birthday');
            // $d=$facebookbirthday->getTimestamp();
           // $facebookbirthdayUTC= date('Y-d-m', $d);
            }else{
            $facebookbirthday = "";
            }
           $location = $facebook_user->getField('location');
           $local = json_decode($location);
   
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 1,
            //'name' => $facebook_user->getName(),
            'firstname'=>$fname,
            'lastname'=>$lname,
            'birthday' => $facebookbirthday,
            'avatar' =>$img,
            'location' => $local->name,
            'email'  => $facebookusername,
            'gender' => $facebook_user->getField('gender'),
            'profileurl' => 'https://www.facebook.com/' . $facebook_user->getId(),
            'language'=>App::getLocale()
        );
        $users = Users::where('username', $data['username'])->first();
        if ($users){
             if($users['type']==1 && strpos($users['profileurl'], 'facebook') !== false){
                $users->update($data);
             }
        }else{
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }

}
