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
//        $latestUsers = Radacct::select(DB::raw('radacct.radacctid,users.avatar,users.gender,users.id as userId,users.username as username,users.name,DATE_FORMAT(created_at,"%b %d") as joinDate'))
//                ->join('users', 'radacct.username', '=', 'users.username')
//                ->groupBy('radacct.username')
//                ->orderBy('users.created_at', 'desc');
        
        if (Auth::user()->type == 'superadmin') {
         
            $latestUsers = Radacct::select(DB::raw('radacct.radacctid,users.avatar,users.gender,users.id as userId,users.username as username,CONCAT(users.firstname," ", users.lastname) as name,DATE_FORMAT(users.created_at,"%b %d") as joinDate'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('nas','radacct.calledstationid','=','nas.nasidentifier')
                ->groupBy('radacct.username')
                ->orderBy('users.created_at', 'desc');
        
        }else{
                $latestUsers = Radacct::select(DB::raw('radacct.radacctid,users.avatar,users.gender,users.id as userId,users.username as username,CONCAT(users.firstname," ", users.lastname) as name,DATE_FORMAT(users.created_at,"%b %d") as joinDate'))
                ->where('nas.adminid', '=', Auth::user()->id)
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('nas','radacct.calledstationid','=','nas.nasidentifier')
                ->groupBy('radacct.username')
                ->orderBy('users.created_at', 'desc');
        }
        $getLatestUsers = $latestUsers->take(8)->get();
        return view('home', ['facebookCount' => $users['fbCount'], 'googleCount' => $users['gCount'], 'emailCount' => $users['eCount'], 'emailList' => $emailList, 'getLatestUsers' => $getLatestUsers]);
    }

    public function routerConnections(Request $request) {
        $input = $request->only('type');
        $type = $input['type'];
        $getAllData = $request->only('AllData');
        $routerConnections = array();
        $allData = array();
        $routerStatus = array();
        $tempData = array();
        $weekNoOne = array();
        $routerDayData = array();
        $routerData = array();
        $dateArray = array();
        $weekData = array();
        $week = array();
        if (Auth::user()->type == 'superadmin') {
            $users = Radacct::select([DB::raw('radacct.radacctid,WEEK(acctstarttime) AS period,count( radacct.calledstationid ) AS totalAccess,count(acctstarttime) as total,users.id as userId,count(users.id) as `countId`,users.gender,users.profileurl,users.email,users.type as favoredconnection, CONCAT(users.firstname," ", users.lastname) as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'), DB::raw('DATE(acctstarttime) as day')])->groupBy('day')
                    ->join('users', 'radacct.username', '=', 'users.username')
                    ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier');
        } else {
            $users = Radacct::select([DB::raw('radacct.radacctid,WEEK(acctstarttime) AS period,count( radacct.calledstationid ) AS totalAccess,count(acctstarttime) as total,users.id as userId,count(users.id) as `countId`,users.gender,users.profileurl,users.email,users.type as favoredconnection, CONCAT(users.firstname," ", users.lastname) as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'), DB::raw('DATE(acctstarttime) as day')])->groupBy('day')
                    ->join('users', 'radacct.username', '=', 'users.username')
                    ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                    ->where('nas.adminid', '=', Auth::user()->id);
        }

        if ($getAllData['AllData'] == "all") {
            $routerStatus = array();
            $activeCount = $activeCountPercentage = 0;
            $deActiveCount = $deActiveCountPercentage = 0;
            // Router Status Data for Router Chart Starts Here========================================================
            if (Auth::user()->type == 'superadmin') {
                $hotspot = Hotspot::with(['status'])->select(['id', 'shortname', 'nasidentifier'])->get();
            } else {
                $hotspot = Auth::user()->hotspots()->with(['status'])->select(['id', 'shortname', 'nasidentifier'])->get();
            }
            $totalRoter = $hotspot->count();
            foreach ($hotspot as $key => $value) {
                if (isset($hotspot->status) && (time() - strtotime($value->status->updated_at)) < 180) {
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
            $routerStatus[0]["value"] = ceil($activeCountPercentage) . "%";
            $routerStatus[1]["label"] = "InActive";
            $routerStatus[1]["value"] = floor($deActiveCountPercentage) . "%";
            if ($routerStatus[0]["value"] == "0%" && $routerStatus[1]["value"] == "0%") {
                $routerStatus[1]["value"] = "100%";
            }
            // Router Status Data for Router Chart Ends Here========================================================
        }
        if ($type == "months") {
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
                $months[$date->format("M")][] = $item;
            }
          
//        Count Actual Data according to month
           
            for ($i=0; $i<=12; $i++) { 
               $month[date("M",strtotime(date('Y-m-d', strtotime("-$i month"))))]=0;
            }
            $month=  array_reverse($month);
//            $month = array(
//                "Jan" => 0,
//                "Feb" => 0,
//                "Mar" => 0,
//                "Apr" => 0,
//                "May" => 0,
//                "June" => 0,
//                "July" => 0,
//                "Aug" => 0,
//                "Sept" => 0,
//                "Oct" => 0,
//                "Nov" => 0,
//                "Dec" => 0
//            );
         
            foreach ($months as $key => $item) {
                $totalConnection[$key] = count($item);
            }
           
            $tempConnections = array_merge($month, $totalConnection);
            $i = 0;
//           foreach ($month as $keyMonth => $valueMonth) {
//                foreach ($tempConnections as $key => $value) {
//
//                    if ($key == $keyMonth) {
//                        $routerConnections[$i][$key] =$value;
//                    } else {
//                        if (!isset($routerConnections[$i][$key])) {
//                             $routerConnections[$i][$key] =0;
//                        }
//                    }
//                }
//            }
               
            foreach ($tempConnections as $key => $item) {
                $routerConnections[$i][$key] = $item;
                $i++;
            }
        } elseif ($type == "weeks") {
            
            //$lastweekdates = $this->getLastNDays(7,5,4);
            
            //print_r($arr); exit;
            $users->whereRaw("acctstarttime >= date_sub(now(),INTERVAL 4 WEEK) and now()");
            $users->orderBy('period', 'ASC');
            $router = $users->get();
            //echo '<pre>'; print_r($router); exit;
            //echo count($router); exit;
            $users->groupBy('period');
            $Week[0]['date'] = Date('Y-m-d', strtotime("-21 days"));
            $Week[0]['week'] = '1';
            $Week[1]['date'] = Date('Y-m-d', strtotime("-14 days"));
            $Week[1]['week'] = '2';
            $Week[2]['date'] = Date('Y-m-d', strtotime("-7 days"));
            $Week[2]['week'] = '3';
//            $Week[3]['date'] = Date('Y-m-d', strtotime("-7 days"));
            $Week[3]['date'] = Date('Y-m-d');
            $Week[3]['week'] = '4';
            //print_r($Week); exit;
            for ($i = 0; $i < count($Week); $i++) {
                $date = new \DateTime($Week[$i]['date']);
                $weekNoOne[$i]['period'] = $date->format("W");
                $weekNoOne[$i]['week'] = $Week[$i]['date'];
                $weekNoOne[$i]['count']=0;
               // $weekNoOne[$i]['totalAccess'] = "0";
                $week[$i] = $date->format("W");
            }
            //echo '<pre>';
            //print_r($weekNoOne); exit;
            //echo count($weekNoOne);
            //echo count($router); exit;
            ////print_r($router); exit;
            //$count=0;
            
            for($i=0;$i<count($router);$i++){
                for($j=0;$j<count($weekNoOne);$j++){
                    if(strtotime($router[$i]['day'])<=strtotime($weekNoOne[$j]['week'])){
                         $weekNoOne[$j]['count'] = $weekNoOne[$j]['count'] + $router[$i]['total'];
                         break;
                    }
                }
                
            }
           // print_r($weekNoOne); exit;
            for($k=0;$k<count($weekNoOne);$k++){
                    $routerConnections[$k][$weekNoOne[$k]['week']] = $weekNoOne[$k]['count']-1;
                }
            //echo '<pre>'; print_r($routerConnections); exit;
        } elseif ($type == "days") {
            $users->whereRaw("acctstarttime between date_sub(now(),INTERVAL 1 WEEK) and now()");
             $users->groupBy(DB::raw('DATE_FORMAT(`acctstarttime`,"%Y-%d-%c %H:%i:%s")'));
            $router = $users->get();
            $m = date("m");
            $de = date("d");
            $y = date("Y");

            for ($i = 0; $i <= 6; $i++) {
                $dateArray[$i]['day'] = date('Y-m-d', mktime(0, 0, 0, $m, ($de - $i), $y));
                 $dateArray[$i]['count']=0;
            }
            $LidtofDates = array_reverse($dateArray);
//            print_r($LidtofDates); 
            //print_r($router); exit;
            for ($i = 0; $i < count($router); $i++) {
                for($j=0;$j<count($LidtofDates);$j++){
                    if($router[$i]['day']==$LidtofDates[$j]['day'])
                    {
                        $LidtofDates[$j]['count']=$LidtofDates[$j]['count']+1;
                    }
                }
            }
            //print_r($LidtofDates); exit;
            //$dayList = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
            for($day=0;$day<count($LidtofDates);$day++){
                
                  $LidtofDates[$day]['day']=date('D',strtotime($LidtofDates[$day]['day']));
            }
            for($days=0;$days<count($LidtofDates);$days++){
                $routerConnections[$days][$LidtofDates[$days]['day']]=$LidtofDates[$days]['count'];
            }
//            print_r($routerConnections);
//            exit;
//            
//            for ($i = 0; $i < count($router); $i++) {
//                if (in_array($router[$i]['day'], $LidtofDates)) {
//
//                    $routerData[$i]['day'] = $router[$i]['day'];
//                    $routerData[$i]['totalAccess'] = $router[$i]['totalAccess'];
//                }
//            }
//            print_r($routerData); exit;
//            
//            for ($i = 0; $i < count($LidtofDates); $i++) {
//                foreach ($routerData as $key => $value) {
//                    $timestamp = strtotime($LidtofDates[$i]);
//                    $day = date('D', $timestamp);
//                    if ($value['day'] == $LidtofDates[$i]) {
//                        $routerConnections[$i][$day] = $value['totalAccess'];
//                    } else {
//                        if (!isset($routerDayData[$i][$LidtofDates[$i]])) {
//                            $routerConnections[$i][$day] = 0;
//                        }
//                    }
//                }
//            }
//            if (empty($routerConnections)) {
//                for ($i = 0; $i < count($LidtofDates); $i++) {
//                    $timestamp = strtotime($LidtofDates[$i]);
//                    $day = date('D', $timestamp);
//                    $routerConnections[$i][$day] = 0;
//                }
//            }
        }
        $allData['routerConnection'] = $routerConnections;
        $allData['routerStatus'] = $routerStatus;
        return Response::json($allData);
    }

    function getLastNDays($days,$date,$month){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = '"' . date('d-m-y',mktime(0,0,0,$month,($date-$i),$y))  . '"'; 
    }
    return array_reverse($dateArray);
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
