<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App;
use Mail;
use Illuminate\Support\Facades\Input;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}
    public function postEmail(Request $request)
	{
        //print_r($request->only('email')); exit;
        $this->validate($request, ['email' => 'required|email']);
       $user=  \App\User::where('email',$request->only('email'))->first();
//        view()->share('name', $user->username);
//        
//		$response = $this->passwords->sendResetLink($request->only('email'), function($m) 
//		{
//			$m->subject($this->getEmailSubject());
//		});
       if(isset($user->username)){
        $input=Input::all();
        
        $token=$input['_token'];
        $email=$input['email'];
//        print_r($input); exit;
        if(App::getLocale()=="en"){
             $languageTemplate='emails.password'; 
            }else if(App::getLocale()=="fr"){
               $languageTemplate='emails.passwordFR'; 
            }
            $data=array('name' => $user->username,'token'=>$token);
            $response= Mail::send($languageTemplate, $data, function($message) use($email)
{
    $message->to($email)->subject($this->getEmailSubject());
});
       
       
            $password=new App\ResetPass();
            $password->email=$email;
            $password->token=$token;
            $password->save();
            if($password->id)
            {
                 $successMsg = "We have e-mailed your password reset link!";
               
                return view('auth.password',array('msg'=>$successMsg));
            }
            
       }else{
                 $errorMsg = "We can't find a user with that e-mail address.";
               
                return view('auth.password',array('errormsg'=>$errorMsg));
       }
       exit;
		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
				return redirect()->back()->with('status', trans($response));

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => trans($response)]);
		}
	}

}
