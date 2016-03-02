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
            ->getLoginUrl(url('/facebook/callback'), ['email', 'public_profile', 'user_friends','user_birthday']);
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
            $response = $fb->get('me?fields=id,name,email,gender,picture,birthday');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();
        //dd($facebook_user);
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 1,
            'name' => $facebook_user->getName(),
            'email' => $facebook_user->getField('email'),
            'gender' => $facebook_user->getField('gender'),
            'profileurl' => 'https://www.facebook.com/' . $facebook_user->getId(),
            'language'=>App::getLocale()
        );
        $users = Users::where('username', $data['username'])->first();
        if ($users) {
             if($users['type']==1 && strpos($users['profileurl'], 'facebook') !== false){
                $users->update($data);
             }
        } else {
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }

}
