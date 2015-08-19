<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::share('projectTitle', 'Nifty Targets');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function verify($confirmation_code){
        $valid = "true";
        if(!$confirmation_code)
        {
            $valid = "error";
        }
        $user = User::where('confirmationcode','=',$confirmation_code)->first();
        if (!$user)
        {
            $valid = "error";
            //return view('admin.welcome',['valid'=>$valid]);
            return redirect('auth/login');
        } else {
            if($user->isemailconfirmed)
            {
                $valid = 'confirmed';
            }else{
                $user->isemailconfirmed = 1;
                $user->save();
            }
            //return view('admin.welcome',['valid'=>$valid]);
            return redirect('auth/login');
           
        }
    }

}
