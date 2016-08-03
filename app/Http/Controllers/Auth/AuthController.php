<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Users;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Connection;
use GoCardless;
use Mail;
use Session;
use App;
use DB;
class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister() {

        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request) {


        $this->validate($request, [
                'username' => 'required|unique:admin_user',
                'businessname' => 'required',
                'email' => 'required|email|unique:admin_user',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required|same:password',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'country' => 'required',
                'siren'=>'required',
                'nvat'=>'required'
            ]
        );
        $formFields = Input::all();
        session(
            [
                'formFields' => $formFields
            ]
        );
        $paBill = url("/") . "/gocardlessproDemo";
        return redirect($paBill);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request) {

//         $confirmationCode = str_random(60);
//         $email="garachankur@yahoo.in";
//         $firstName="ankur";
//         
//        if(App::getLocale()=="en"){
//               $languageTemplate='emails.activationTemplate'; 
//            }else if(App::getLocale()=="fr"){
//               $languageTemplate='emails.activationTemplateFR'; 
//            }
//            $data=array('confirmationCode' => $confirmationCode,'pathToFile'=>"clicspot.png");
//            Mail::later(3600, $languageTemplate, $data, function($message)
//{
//    $message->to('garachankur@yahoo.in', 'John Smith')->subject('Welcome!');
//});
//
//         exit;   
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        $credentials = $request->only('email', 'password');
        $credentials['isemailconfirmed'] = 1;
        $credentials['isactivated'] = 1;
        //return json_encode($credentials);
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    public function verify($confirmation_code) {
        $valid = "true";
        if (!$confirmation_code) {
            $valid = "verifyError";
        }
        $user = User::where('confirmationcode', '=', $confirmation_code)->first();
        if (!$user) {
            $valid = "verifyError";
        } else {
            if ($user->isemailconfirmed) {
                $valid = 'verifySuccess';
            } else {
                $user->isemailconfirmed = 1;
                $user->save();
                $valid = "verifySuccess";
            }
        }
        if ($valid == "verifySuccess")
            $msg = "Your Account is Verified Successfully.";
        else
            $msg = "There is a Problem in verifying Your Account .";
        return redirect($this->loginPath())->with($valid, $msg);
    }


    /*
     * me@diegopucci.com
     * Confirm email address after hotspot login
     */

    public function getUsername($feedback_code) {
        if (($pos = strpos($feedback_code, "+")) !== FALSE) {
            return substr($feedback_code, $pos+1);
        }
    }

    public function getHotspotId($feedback_code) {
        $pos = strpos($feedback_code, "+");
        if ($pos === false)
            return false;
        else
            return(substr($feedback_code, 0, $pos));
    }

    public function feedback($feedback_code) {
        if (!$feedback_code) {
            die;
        }

        $username = $this->getUsername($feedback_code);
        $hotspotId = $this->getHotspotId($feedback_code);

        if($username && $hotspotId) {

            $nasData = \App\Hotspot::where(['id' => $hotspotId])->first();

            if($nasData){
                $adminId = $nasData->adminid;
                $user = Users::where('username', '=', $username)->first();
                
                if($user){
                    if($user->isemailconfirmed == 0){

                        $hasRating = \App\StarsRating::where(['email_id' => $user->email, 'admin_id' => $adminId])->first();

                        //giving a star to this user since the email is confirmed
                        $hasRating->points = $hasRating->points + 6;
                        $hasRating->stars = \App\StarsRating::returnStarsByPoints($hasRating->points + 6);
                        /*
                        \App\StarsRating::where(['email_id' => $emailId, 'admin_id' => $adminId])
                            ->update(['points' => $hasRating->points + 6, 'stars' => \App\StarsRating::returnStarsByPoints($hasRating->points + 6)]);
*/
                        $hasRating->save();

                        $user->isemailconfirmed = 1;
                        $user->save();
                    }

                    header("Location:" . $nasData->tripAdvisorId);
                    die;
                }else{
                    echo "here1";
                    die;
                }
            }else{
                echo "here2";
                die;
            }
        }else{
            echo "here3";
            die;
        }

    }


    public function getLogout() {
        Session::flush('listId');
        Session::flush('locale');
        $this->auth->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function goCardlessPayment(request $request) {

        $formValue = Session::get('formFields');
        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        \GoCardless::set_account_details($account_details);

        if (isset($_GET['resource_id']) && isset($_GET['resource_type'])) {
            session([
                'resource_id' => $_GET['resource_id']
            ]);
            $confirm_params = array(
                'resource_id' => $_GET['resource_id'],
                'resource_type' => $_GET['resource_type'],
                'resource_uri' => $_GET['resource_uri'],
                'signature' => $_GET['signature']
            );

// State is optional
            if (isset($_GET['state'])) {
                $confirm_params['state'] = $_GET['state'];
            }
            $confirmed_resource = \GoCardless::confirm_resource($confirm_params);
            $this->registerGoCartUser($confirm_params);
            $paBill = url("/") . "/auth/login";
            return redirect($paBill);
        }

        $payment_details = array(
            'max_amount' => '3000.00',
            'interval_length' => 12,
            'interval_unit' => 'month',
            'user' => array(
                'first_name' => $formValue['username'],
                'last_name' => $formValue['username'],
                'email' => $formValue['email'],
                'address_line1' => $formValue['address'],
                'city' => $formValue['city'],
                'postal_code' => $formValue['zip'],
            )
        );
        echo 'gocard';
        $pre_auth_url = \GoCardless::new_pre_authorization_url($payment_details);
        return redirect($pre_auth_url);
    }


    public function goCardlessPayment2(request $request) {

        $formValue = Session::get('formFields');
        $url = 'https://api.gocardless.com/redirect_flows';
        /*$url = 'https://api-sandbox.gocardless.com/redirect_flows';*/
        $curl = 'https://api-sandbox.gocardless.com/customers';
        $path = "/redirect_flows";
        session_start();
        $session_token = session_id().rand();

        $headers = array();
        /*$headers[] = 'Authorization: Bearer vcf8_V7cpH3Wv8VdcnGyu9UShrDurLuct96AHOoL';*/
        $headers[] = 'Authorization: Bearer qgxwZ80AGQudBuP_mICb1BMYS9h8bbhzuS7MScZF';

        $headers[] = 'GoCardless-Version: 2015-07-06';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';

        //$json = '{"redirect_flows":{"description":"Standard User Register","session_token":"SESS_'.$session_token.'","scheme":"bacs","success_redirect_url":"http://admin.clicspot.com/pay/confirm"}}';
        $json = '{"redirect_flows":{"description":"Standard User Register","session_token":"SESS_'.$session_token.'","success_redirect_url":"https://pay.clicspot.com"}}';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $responcedata = (array)$response;
        if(array_key_exists('redirect_flows',$responcedata)) {
            if($response->redirect_flows) {
                $session_token = 'SESS_'.$session_token;
                $paBill = $response->redirect_flows->redirect_url;
                $redirect_flow_id = $response->redirect_flows->id;
                $confirm_params = array('session_token' => $session_token,'redirect_flow_id' => $redirect_flow_id);
                if($formValue['username']) {
                    $this->registerGoCartUser2($confirm_params);
                }
                return redirect($paBill);
            } elseif($response->error) {
                return redirect::to('/')->with('message', $response->error->message);
            }
            return redirect($paBill);
        }
        return redirect::to('/')->with('message', $response->error->message);

        /*$access_token = 'qgxwZ80AGQudBuP_mICb1BMYS9h8bbhzuS7MScZF';
        $client = $client = new \GoCardlessPro\Client(array(
          'access_token' => $access_token,
          'environment'  => \GoCardlessPro\Environment::SANDBOX
        ));
        echo "<pre>";print_r($client);
        exit;*/

        $pre_auth_url = \GoCardless::new_pre_authorization_url($payment_details);
        return redirect($pre_auth_url);
    }
    public function goCardlessPayment3() {

        $headers = array();
        $headers[] = 'Authorization: Bearer vcf8_V7cpH3Wv8VdcnGyu9UShrDurLuct96AHOoL';
        $headers[] = 'Authorization: Bearer qgxwZ80AGQudBuP_mICb1BMYS9h8bbhzuS7MScZF';
        //$headers[] = 'Authorization: Bearer 1spGeO_dcSSCD5b55KBq6SM1QnI7iFsF3ky-u0YK';
        /*7ULGEmkRQgXLQaHUCkZzHzm8yFdggr4VCs505lEe*/
        $headers[] = 'GoCardless-Version: 2015-07-06';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        session_start();
        $session_token = session_id();
        $formFields = Session::get('formFields');
        $url = 'https://api.gocardless.com/redirect_flows/'.$_REQUEST['redirect_flow_id'].'/actions/complete';
        $json = '{"data":{"session_token":"SESS_'.$session_token.'"}}';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $formValue = Session::get('formFields');
        $responcedata = (array)$response;
        if(array_key_exists('redirect_flows',$responcedata)) {
            session([
                'resource_id' => $response->redirect_flows->links->mandate
            ]);
            $confirm_params = array(
                'creditor' => $response->redirect_flows->links->creditor,
                'mandate' => $response->redirect_flows->links->mandate,
                'customer' => $response->redirect_flows->links->customer,
                'customer_bank_account' => $response->redirect_flows->links->customer_bank_account
            );
// State is optional
            if ($response->redirect_flows->session_token) {
                $confirm_params['session_token'] = $response->redirect_flows->session_token;
            }
            $this->registerGoCartUser($confirm_params);
            $paBill = url("/") . "/auth/login";
            return redirect($paBill);
        }
        $msg = "There is a Problem in Register Your Account .";
        session([
            'registerSuccess' => $msg
        ]);
        $paBill = url("/") . "/auth/login";
        return redirect($paBill);

    }
    public function payconfirmgo2() {
        if(isset($_REQUEST['redirect_flow_id'])) {
            $usersenddata = json_decode($_REQUEST['redirect_flow_id']);
            if($usersenddata->redirect_flows->id) {
                $users = DB::table('admin_user')
                    ->where('redirect_flow_id', $usersenddata->redirect_flows->id)
                    ->get();
                if(!empty($users[0])) {
                    //echo json_encode($users[0]);
                    DB::table('admin_user')
                        ->where('id', $users[0]->id)
                        ->update(array('resourceid' => '"'.$usersenddata->redirect_flows->links->mandate.'"','isactivated' => 1,'userslinks' => '"'.json_encode($usersenddata->redirect_flows->links).'"'));
                    $email = $users[0]->email;
                    $firstName = $users[0]->businessname;
                    $confirmationCode = $users[0]->confirmationcode;
                    if(App::getLocale()=="en"){
                        $languageTemplate='emails.activationTemplate';
                    }else if(App::getLocale()=="fr"){
                        $languageTemplate='emails.activationTemplateFR';
                    }else{
                        $languageTemplate='emails.activationTemplate';
                    }
                    Mail::send($languageTemplate, array('confirmationCode' => $confirmationCode), function ($message) use ($email, $firstName) {
                        $message->to($email, $firstName);
                        $message->from('activation@clicspot.com', 'Clicspot');
                        $message->subject('Thank you for registering for Clicspot! Please confirm your email');
                    });
                    echo json_encode(array('successuser' => '1'));
                } else {
                    //echo json_encode(array());
                }
            } else {
                echo json_encode(array());
            }
            exit;
        }
    }

    public function getUsersession_token() {

        if(isset($_REQUEST['redirect_flow_id'])) {
            $users = DB::table('admin_user')
                ->where('redirect_flow_id', $_REQUEST['redirect_flow_id'])
                ->get();
            if(!empty($users[0])) {
                echo json_encode($users[0]);
            } else {
                echo json_encode(array());
            }
        } else {
            echo json_encode(array());
        }
        exit;
    }


    public function registerGoCartUser2($param) {
        $formFields = Session::get('formFields');
        $user = new User();
        $confirmationCode = str_random(60);
        $user->confirmationcode = $confirmationCode;
        $user->username = $formFields["username"];
        $user->password = Hash::make($formFields["password"]);
        $user->email = $formFields["email"];
        $user->businessname = $formFields["businessname"];
        $user->address = $formFields["address"];
        $user->city = $formFields["city"];
        $user->zip = $formFields["zip"];
        $user->country = $formFields["country"];
        $user->phone = $formFields["phone"];
        $user->siren = $formFields["siren"];
        $user->nvat = $formFields["nvat"];
        //$user->resourceid = Session::get('resource_id');
        $user->isactivated = 0;
        $user->session_token = $param["session_token"];
        $user->redirect_flow_id = $param["redirect_flow_id"];
        if ($user->save()) {
            $valid = "registerSuccess";
            $email = $formFields["email"];
            $firstName = $formFields["businessname"];
            if(App::getLocale()=="en"){
                $languageTemplate='emails.activationTemplate';
            }else if(App::getLocale()=="fr"){
                $languageTemplate='emails.activationTemplateFR';
            }else{
                $languageTemplate='emails.activationTemplate';
            }
            /*Mail::send($languageTemplate, array('confirmationCode' => $confirmationCode), function ($message) use ($email, $firstName) {
                $message->to($email, $firstName);
                $message->from('activation@clicspot.com', 'Clicspot');
                $message->subject('Thank you for registering for Clicspot! Please confirm your email');
            });*/
        } else {
            $valid = "registerError";
        }
        //  echo $valid;exit;
        if ($valid == "registerSuccess")
            $msg = "Your Account is Registered Successfully.";
        else
            $msg = "There is a Problem in Register Your Account .";

        session([
            'registerSuccess' => $msg
        ]);

        //  return redirect($this->loginPath())->with($valid, $msg);
    }

    public function registerGoCartUser($param) {
        $formFields = Session::get('formFields');
        $user = new User();
        $confirmationCode = str_random(60);
        $user->confirmationcode = $confirmationCode;
        $user->username = $formFields["username"];
        $user->password = Hash::make($formFields["password"]);
        $user->email = $formFields["email"];
        $user->businessname = $formFields["businessname"];
        $user->address = $formFields["address"];
        $user->city = $formFields["city"];
        $user->zip = $formFields["zip"];
        $user->country = $formFields["country"];
        $user->phone = $formFields["phone"];
        $user->siren = $formFields["siren"];
        $user->nvat = $formFields["nvat"];
        $user->resourceid = Session::get('resource_id');
        if ($user->save()) {
            $valid = "registerSuccess";
            $email = $formFields["email"];
            $firstName = $formFields["businessname"];
            if(App::getLocale()=="en"){
                $languageTemplate='emails.activationTemplate';
            }else if(App::getLocale()=="fr"){
                $languageTemplate='emails.activationTemplateFR';
            }else{
                $languageTemplate='emails.activationTemplate';
            }
            Mail::send($languageTemplate, array('confirmationCode' => $confirmationCode), function ($message) use ($email, $firstName) {
                $message->to($email, $firstName);
                $message->from('activation@clicspot.com', 'Clicspot');
                $message->subject('Thank you for registering for Clicspot! Please confirm your email');
            });
        } else {
            $valid = "registerError";
        }
        //  echo $valid;exit;
        if ($valid == "registerSuccess")
            $msg = "Your Account is Registered Successfully.";
        else
            $msg = "There is a Problem in Register Your Account .";

        session([
            'registerSuccess' => $msg
        ]);

        //  return redirect($this->loginPath())->with($valid, $msg);
    }

}
