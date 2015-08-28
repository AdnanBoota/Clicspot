<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\RadCheck;
use App\Users;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class FacebookLogin extends Controller
{

    public function login(LaravelFacebookSdk $fb)
    {
        $login_url = $fb
            ->getRedirectLoginHelper()
            ->getLoginUrl(url('/facebook/callback'), ['email', 'public_profile', 'user_friends']);
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
            $response = $fb->get('me?fields=id,name,email,gender');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();

        $data = array(
            'username' => \Session::get('mac'),
            'name' => $facebook_user->getName(),
            'email' => $facebook_user->getField('email'),
            'gender' => $facebook_user->getField('gender'),
            'profileurl' => 'https://www.facebook.com/' . $facebook_user->getId()
        );
        $users = Users::where('username', $data['username'])->first();
        if ($users) {
            $users->update($data);
        } else {
            $users = Users::create($data);
        }

        if ($users->RadCheckRecord) {
            $users->RadCheckRecord()->update(['attribute' => 'Password', 'op' => ":=", 'value' => "1"]);
        } else {
            $users->RadCheckRecord()->save(new RadCheck(['attribute' => 'Password', 'op' => ":=", 'value' => "1"]));
        }


        return action('HotspotLoginController@login');
    }

}
