<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request,
    Illuminate\Support\Facades\Input;
use App\User,
    Hash,
    Mail;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
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
     * @param  \Illuminate\Http\Request  $request
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
            'country' => 'required']);
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
        if($user->save()){
        $valid = "registerSuccess";
        $email = $formFields["email"];
        $firstName = $formFields["businessname"];
        Mail::send('emails.activationTemplate', array('confirmationCode' => $confirmationCode), function($message) use ($email, $firstName) {
            $message->to($email, $firstName);
            $message->from('activation@clickspot.com', 'ClickSpot');
            $message->subject('Thank you for registering for ClickSpot! Please confirm your email');
        });
        }else{
            $valid = "registerError";
        }
        if($valid == "registerSuccess")
                $msg = "Your Account is Registered Successfully.";
            else
                $msg = "There is a Problem in Register Your Account .";
        return redirect($this->loginPath())->with($valid,$msg);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

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
         if($valid == "verifySuccess")
                $msg = "Your Account is Verified Successfully.";
            else
                $msg = "There is a Problem in verifying Your Account .";
            return redirect($this->loginPath())->with($valid,$msg);
    }

}
