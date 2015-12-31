<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Users;
use App\EmailList;
use App\Radacct;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Hotspot;
use App\HotspotAttributes;
use App\Campaign;
use App\RouterStatus;
use Response;
use Auth;
use DB;

class HomeController extends Controller {
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
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'Nifty Targets');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {

        $users = app('App\Http\Controllers\UsersController')->getStatistics('', 'indexCount');
        $emailList = Auth::user()->emailList()->select('listname', 'id')->get();
        $latestUsers = Radacct::select(DB::raw('radacct.radacctid,users.avatar,users.gender,users.id as userId,users.username as username,users.name,DATE_FORMAT(created_at,"%b %d") as joinDate'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->groupBy('radacct.username')
                ->orderBy('users.created_at', 'desc');
        $getLatestUsers = $latestUsers->take(8)->get();
        return view('home', ['facebookCount' => $users['fbCount'], 'googleCount' => $users['gCount'], 'emailCount' => $users['eCount'], 'emailList' => $emailList, 'getLatestUsers' => $getLatestUsers]);
    }

    public function routerConnections(Request $request) {
        $input = $request->only('type');

        $routerConnections = array();
        if (Auth::user()->type == 'superadmin') {
            $users = Radacct::select([DB::raw('radacct.radacctid,WEEK(acctstarttime) AS period,count( radacct.calledstationid ) AS totalAccess,users.id as userId,count(users.id) as `countId`,users.gender,users.profileurl,users.email,users.type as favoredconnection, users.name as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'), DB::raw('DATE(acctstarttime) as day')])->groupBy('day')
                    ->join('users', 'radacct.username', '=', 'users.username')
                    ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier');
        } else {
            $users = Radacct::select([DB::raw('radacct.radacctid,WEEK(acctstarttime) AS period,count( radacct.calledstationid ) AS totalAccess,users.id as userId,count(users.id) as `countId`,users.gender,users.profileurl,users.email,users.type as favoredconnection, users.name as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'), DB::raw('DATE(acctstarttime) as day')])->groupBy('day')
                    ->join('users', 'radacct.username', '=', 'users.username')
                    ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                    ->where('nas.adminid', '=', Auth::user()->id);
        }


        if ($input['type'] == "months") {
            $users->groupBy('radacct.username');
            $users->orderBy('acctstarttime', 'desc');
            $router = $users->get();
            //        To fetch the data according to Month
            $month = '';
            $months = array();
            $totalConnection = array();
            $routerConnections = array();
            foreach ($router as $item) {
                $date = new Carbon($item['lastvisit']);
                $months[$date->format("F")][] = $item;
            }
//        Count Actual Data according to month
            $month = array(
                "January" => 0,
                "February" => 0,
                "March" => 0,
                "April" => 0,
                "May" => 0,
                "June" => 0,
                "July" => 0,
                "August" => 0,
                "September" => 0,
                "October" => 0,
                "November" => 0,
                "December" => 0
            );
            foreach ($months as $key => $item) {
                $totalConnection[$key] = count($item);
            }

            $tempConnections = array_merge($month, $totalConnection);
            $i = 0;

            foreach ($tempConnections as $key => $item) {
                $routerConnections[$i][$key] = $item;
                $i++;
            }
            return Response::json($routerConnections);
        } elseif ($input['type'] == "weeks") {

            $users->whereRaw("acctstarttime >= date_sub(now(),INTERVAL 4 WEEK) and now()");
            $users->orderBy('period', 'ASC');
            $router = $users->get();
            $users->groupBy('period');
            $Week[0]['date'] = Date('Y-m-d', strtotime("-28 days"));
            $Week[0]['week'] = '1';
            $Week[1]['date'] = Date('Y-m-d', strtotime("-21 days"));
            $Week[1]['week'] = '2';
            $Week[2]['date'] = Date('Y-m-d', strtotime("-14 days"));
            $Week[2]['week'] = '3';
            $Week[3]['date'] = Date('Y-m-d', strtotime("-7 days"));
            $Week[3]['week'] = '4';

            for ($i = 0; $i < count($Week); $i++) {
                $date = new \DateTime($Week[$i]['date']);
                $weekNoOne[$i]['period'] = $date->format("W");
                $weekNoOne[$i]['week'] = $Week[$i]['date'];
                $weekNoOne[$i]['totalAccess'] = "0";
                $week[$i] = $date->format("W");
            }


            for ($i = 0; $i < count($router); $i++) {
                if (in_array($router[$i]['period'], $week)) {

                    $var[$i]['period'] = $router[$i]['period'];
                    $var[$i]['totalAccess'] = $router[$i]['totalAccess'];
                }
            }

            for ($i = 0; $i < count($weekNoOne); $i++) {
                foreach ($var as $key => $value) {

                    if ($value['period'] == $weekNoOne[$i]['period']) {
                        $weekData[$i][$weekNoOne[$i]['week']] = $value['totalAccess'];
                    } else {
                        if (!isset($weekData[$i][$weekNoOne[$i]['week']])) {
                            $weekData[$i][$weekNoOne[$i]['week']] = 0;
                        }
                    }
                }
            }

            return Response::json($weekData);
        } elseif ($input['type'] == "days") {
            $users->whereRaw("acctstarttime between date_sub(now(),INTERVAL 1 WEEK) and now()");
            $users->groupBy(DB::raw('DATE(`acctstarttime`)'));
            $router = $users->get();
            $dayList = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
            for ($i = 0; $i < count($router); $i++) {
                $timestamp = strtotime($router[$i]['day']);
                $day = date('D', $timestamp);
                if (in_array($day, $dayList)) {

                    $routerData[$i]['day'] = $day;
                    $routerData[$i]['totalAccess'] = $router[$i]['totalAccess'];
                }
            }

            for ($i = 0; $i < count($dayList); $i++) {
                foreach ($routerData as $key => $value) {
                    if ($value['day'] == $dayList[$i]) {
                        $routerDayData[$i][$dayList[$i]] = $value['totalAccess'];
                    } else {
                        if (!isset($routerDayData[$i][$dayList[$i]])) {
                            $routerDayData[$i][$dayList[$i]] = 0;
                        }
                    }
                }
            }

            return Response::json($routerDayData);
        }
    }

    function routerStatus(Request $request) {
        $routerStatus = array();
        $activeCount = $activeCountPercentage = 0;
        $deActiveCount = $deActiveCountPercentage = 0;
        if (Auth::user()->type == 'superadmin') {
            $hotspot = Hotspot::with(['status'])->select(['id', 'shortname', 'nasidentifier'])->get();
        } else {
            $hotspot = Auth::user()->hotspots()->with(['status'])->select(['id', 'shortname', 'nasidentifier'])->get();
        }
        $totalRoter = $hotspot->count();
        foreach ($hotspot as $key => $value) {
            if ((time() - strtotime($value->status->updated_at)) < 180) {
                $activeCount++;
            } else {
                $deActiveCount++;
            }
        }
        if ($totalRoter != 0 && !empty($totalRoter)) {
            $activeCountPercentage = ($activeCount / $totalRoter) * 100;
            $deActiveCountPercentage = ($deActiveCount / $totalRoter) * 100;
        }
        $routerStatus[0]["label"] = "Active";
        $routerStatus[0]["value"] = $activeCountPercentage . "%";
        $routerStatus[1]["label"] = "InActive";
        $routerStatus[1]["value"] = $deActiveCountPercentage . "%";
        return Response::json($routerStatus);
    }

}
