<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Users;
use App\EmailList;
use App\Radacct;
use Auth;
use DB;

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
       
       $users = app('App\Http\Controllers\UsersController')->getStatistics('', 'indexCount');
           $emailList = Auth::user()->emailList()->select('listname', 'id')->get();
              $latestUsers = Radacct::select(DB::raw('radacct.radacctid,users.avatar,users.gender,users.id as userId,users.username as username,users.name,DATE_FORMAT(created_at,"%b %d") as joinDate'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->groupBy('radacct.username')
                ->orderBy('users.created_at', 'desc');
        $getLatestUsers = $latestUsers->take(8)->get();
           return view('home',['facebookCount' => $users['fbCount'], 'googleCount' => $users['gCount'], 'emailCount' => $users['eCount'], 'emailList' => $emailList,'getLatestUsers'=>$getLatestUsers]);
    }
    


}
