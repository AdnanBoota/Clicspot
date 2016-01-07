<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GoCardless;
use Mail;
use Session;

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
            //'password_confirmation' => 'required|same:password',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required']
        );
        $formFields = Input::all();

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
        if ($user->save()) {
            $valid = "registerSuccess";
            $email = $formFields["email"];
            $firstName = $formFields["businessname"];
            Mail::send('emails.activationTemplate', array('confirmationCode' => $confirmationCode), function ($message) use ($email, $firstName) {
                $message->to($email, $firstName);
                $message->from('activation@clicspot.com', 'Clicspot');
                $message->subject('Thank you for registering for Clicspot! Please confirm your email');
            });
        } else {
            $valid = "registerError";
        }
        if ($valid == "registerSuccess")
            $msg = "Your Account is Registered Successfully.";
        else
            $msg = "There is a Problem in Register Your Account .";
        return redirect($this->loginPath())->with($valid, $msg);
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

    public function getLogout() {
        Session::flush('listId');
        $this->auth->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function goCardlessDemo(Request $request) {

        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "F23GVSVSMB5HFW4CTPDX8644MDRN16R85DYFSWDP7FJAW32TJXNQ2ACSJ57XNFM8",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        \GoCardless::set_account_details($account_details);

        if (isset($_GET['resource_id']) && isset($_GET['resource_type'])) {
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
              echo '<pre>';
            print_r($confirm_params);
           
            $confirmed_resource =  \GoCardless::confirm_resource($confirm_params);
        }

        $payment_details = array(
            'max_amount' => '100.00',
            'interval_length' => 12,
            'interval_unit' => 'month',
            'user' => array(
                'first_name' => 'jay',
                'last_name' => 'bhupatani',
                'email' => 'jay@logisticinfotech.com',
                'address_line1' => 'rajkot',
                'address_line1' => 'rajkot',
                'city' => 'rajkot',
            )
        );
        $pre_auth_url = \GoCardless::new_pre_authorization_url($payment_details);
        return redirect($pre_auth_url);
    }

}
