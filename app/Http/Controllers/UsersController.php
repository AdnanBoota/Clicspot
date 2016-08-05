<?php

namespace App\Http\Controllers;

use App\Users;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;
use App\Radacct;
use Illuminate\Support\Facades\DB;
use App\EmailList;

class UsersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'Clicspot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $listVal = $request->input('listVal');
            $gender = $request->input('gender');

            if ($listVal == '' AND Session::has('listId')) {
                $listVal = Session::get('listId');
            }

            $users = $this->getStatistics($listVal, 'datatable', $gender);

            return Datatables::of($users)
                ->editColumn('favoredconnection', function ($users) {
                    /*
                    if ($users->favoredconnection == '2')
                        //return '<i class="fa fa-envelope"></i>';
                        return "<img src='img/mail.png' />";
                    else {
                        if ($users->profileurl != '' AND strpos($users->profileurl, 'facebook') !== false) {
                            return "<img src='img/facebook.png' />";
                        } else
                            return "<img src='img/googleplus.png' />";
                    }
                    */
                    //edited by me@diegopucci.com
                    switch($users->favoredconnection){
                        case 2:
                        case 3:
                        case 4:
                            return "<img src='img/mail.png' />";
                        break;
                        default:
                            if ($users->profileurl != '' AND strpos($users->profileurl, 'facebook') !== false) {
                                return "<img src='img/facebook.png' />";
                            } else{
                                return "<img src='img/googleplus.png' />";
                            }
                    }
                })
                ->editColumn('visitor', function ($users) {

                    return "<a href='users/profile/{$users->userId}' />{$users->visitor}</a>";
                })
                ->addColumn('campaign', function ($users) {
                    return $users->campaignName;
                })
                ->addColumn('review', function ($users) {
                    $starsRating = \App\StarsRating::getStarsRating($users->userId);
                    return '<div class="raty readonly" data-score="'.$starsRating.'"></div>';
                })
                ->editColumn('language',function($users){
                    if ($users->language == 'fr')
                        return '<div class="flag-icon flag-icon-fr" title="Français" id="fr">';
                    else {
                        if ($users->language == 'en')
                            return '<div class="flag-icon flag-icon-gb" title="Anglais" id="gb">';
                        else {
                            if ($users->language == 'es')
                                return '<div class="flag-icon flag-icon-es" title="Espagnol" id="es">';
                            else {
                                if ($users->language == 'de')
                                    return '<div class="flag-icon flag-icon-de" title="Allemagne" id="de">';

                                else {
                                    if ($users->language == 'nl')
                                        return '<div class="flag-icon flag-icon-nl" title="Hollandais" id="nl">';

                                    else {
                                        if ($users->language == 'pt')
                                            return '<div class="flag-icon flag-icon-pt" title="Portugais" id="pt">';
                                        else {
                                            if ($users->language == 'it')
                                                return '<div class="flag-icon flag-icon-it" title="Italien" id="it">';

                                            else
                                                return '<div class="flag-icon flag-icon-us" title="Default" id="us">';

                                        }}}}}}


                    // return ($users->language=='en') ? '<div class="flag-icon flag-icon-gb" title="english" id="gb">' : '<div class="flag-icon flag-icon-pt" title="port" id="pt">';
                })
                ->make(true);
        } else {
            if(Session::has('listId')){
                $listVal = Session::get('listId');
                $users = $this->getStatistics($listVal, 'indexCount');
            }else{
                $users = $this->getStatistics('', 'indexCount');
            }
            $emailList = Auth::user()->emailList()->select('listname', 'id')->get();


            return view('users.index', ['facebookCount' => $users['fbCount'], 'googleCount' => $users['gCount'], 'emailCount' => $users['eCount'], 'emailList' => $emailList]);
        }
    }

    public function getStatistics($listId = '', $callFrom = '', $gender = '') {
        $inputs = Input::all();

        if ($callFrom == 'selList')
            Session::put('listId', $listId);

        /*
        * me@diegopucci.com
        */
        if ($callFrom == 'campaignmove') {
            //a bit of an hack to mantain compatibility with old stuff in this function
            $inputs = $listId;
            $listId = $inputs["emailListId"];
        }

        if($listId) {
            if($listId != 'static') {
                $emailListFilterData = EmailList::findOrFail($listId);
            }else{
                //default list data
                $emailListFilterData = new \stdClass();
                $emailListFilterData->favoredconnection = 'facebook;google;email;imported';
                $emailListFilterData->visitors = null;
                $emailListFilterData->numberofvisit = null;
                $emailListFilterData->router = null;
                $emailListFilterData->firstname = null;
                $emailListFilterData->lastname = null;
                $emailListFilterData->isdatequickselection = 0;
                $emailListFilterData->datequickselection = null;
                $emailListFilterData->datefrom = null;
                $emailListFilterData->dateto = null;
                $emailListFilterData->gender = null;
                $emailListFilterData->age = '15;55';
                $emailListFilterData->rate = 2;
            }

            $favConArr = isset($inputs['favoredconnection']) && $inputs['favoredconnection'] != "" ? $inputs['favoredconnection'] : explode(';', $emailListFilterData->favoredconnection);
            $visitorsArr = isset($inputs['visitors']) && $inputs['visitors'] != "" ? $inputs['visitors']  : ($emailListFilterData->visitors != null ? explode(';', $emailListFilterData->visitors) : false);
            $numVisitArr = isset($inputs['numberofvisit']) && $inputs['numberofvisit'] != "" ? explode(';', $inputs['numberofvisit']) : ($emailListFilterData->numberofvisit != null ? explode(';', $emailListFilterData->numberofvisit) : false);
            $routerArr = isset($inputs['router']) && $inputs['router'] != "" ? $inputs['router']  : ($emailListFilterData->router != null ? explode(';', $emailListFilterData->router) : false);
            $firstName = isset($inputs['firstname']) && $inputs['firstname'] != "" ? $inputs['firstname']  : ($emailListFilterData->firstname != null ? $emailListFilterData->firstname : false);
            $lastName = isset($inputs['lastname']) && $inputs['lastname'] != "" ? $inputs['lastname']  : ($emailListFilterData->lastname != null ? $emailListFilterData->lastname : false);
            $isDateQkSel = isset($inputs['isdatequickselection']) && $inputs['isdatequickselection'] != "" ? $inputs['isdatequickselection']  : ($emailListFilterData->isdatequickselection != 0 ? $emailListFilterData->isdatequickselection : false);
            $dateQkSel = isset($inputs['datequickselection']) && $inputs['datequickselection'] != "" ? $inputs['datequickselection']  : ($emailListFilterData->datequickselection != null ? $emailListFilterData->datequickselection : false);
            $datefrom = isset($inputs['datefrom']) && $inputs['datefrom'] != "" ? $inputs['datefrom']  : ($emailListFilterData->datefrom && $emailListFilterData->datefrom != "0000-00-00" ? $emailListFilterData->datefrom : false);
            $dateto = isset($inputs['dateto']) && $inputs['dateto'] != "" ? $inputs['dateto']  : ($emailListFilterData->dateto != null && $emailListFilterData->dateto != "0000-00-00" ? $emailListFilterData->dateto : false);
            $gender = isset($inputs['gender']) && $inputs['gender'] != "" ? $inputs['gender']  : ($emailListFilterData->gender != null ? $emailListFilterData->gender : false);
            $ageArr = (isset($inputs['age']) && $inputs['age'] != "") ? explode(';', $inputs['age']) : explode(';', $emailListFilterData->age);
            $starsInput = (isset($inputs['stars']) && $inputs['stars'] != "") ? $inputs['stars'] : $emailListFilterData->rate;
            $langArr = isset($inputs['languages']) && $inputs['languages']!= "" && !is_array($inputs['languages']) ? explode(';', $inputs['languages']) : (isset($inputs['languages']) && $inputs['languages'] != "" && is_array($inputs['languages']) && count($inputs['languages']) > 0 ? $inputs['languages'] : false);
        }
        //me@diegopucci.com END


        if (Auth::user()->type == 'superadmin') {// users.name
            $users = Radacct::select(DB::raw('radacct.radacctid,users.id as userId,users.gender,users.profileurl,users.email,users.type as favoredconnection,stars_rating.stars AS stars,campaign.name as campaignName, CONCAT(users.firstname," ", users.lastname) as visitor,users.language as language,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('stars_rating', 'stars_rating.email_id', '=', 'users.email')
                ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                ->join('campaign', 'nas.campaignid', '=', 'campaign.id')
                ->groupBy('users.email')
                ->orderBy('acctstarttime', 'desc');
        } else {
            $users = Radacct::select(DB::raw('radacct.radacctid,users.id as userId,users.gender,users.profileurl,users.email,users.type as favoredconnection, stars_rating.stars AS stars, campaign.name as campaignName, CONCAT(users.firstname," ", users.lastname) as visitor,users.language as language,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('stars_rating', 'stars_rating.email_id', '=', 'users.email')
                ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                ->join('campaign', 'nas.campaignid', '=', 'campaign.id')
                ->where('nas.adminid', '=', Auth::user()->id)
                ->groupBy('users.email')
                ->orderBy('acctstarttime', 'desc');
        }

        /*
        * me@diegopucci.com
        * Excluding previous sends when moving a campaign
        */
        if ($callFrom == 'campaignmove') {
            $emailEvents = \App\EmailEvents::where("transmission_id", $inputs["transmission_id"])
            ->where("feedback_confirm", ">=", 2)->lists("emailid");

            $excluded = count($emailEvents > 0) ? $emailEvents : [];
            $users->whereNotIn('users.email', $excluded);
        }
        //me@diegopucci.com END


        if (isset($favConArr)) {
            $users->where(function ($query) use ($favConArr) {
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('facebook', $favConArr)) {
                        $query->where('users.type', '1')->where('users.profileurl', 'like', '%facebook%');
                    }
                });
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('google', $favConArr)) {
                        $query->orWhere('users.type', '1')->where('users.profileurl', 'like', '%google%');
                    }
                });
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('email', $favConArr)) {
                        $query->orWhere('users.type', '2');
                    }
                });
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('imported', $favConArr)) {
                        $query->orWhere('users.type', '3');
                        $query->orWhere('users.type', '4');
                    }
                });
            });
        }


        if ($callFrom == 'datatable' || $callFrom == 'campaignmove') {
            $users->where('users.subscribe', '=', '1');
        }


        if (isset($visitorsArr) AND $visitorsArr != '') {
            $users->where(function ($query) use ($visitorsArr) {
                $query->orWhere(function ($query) use ($visitorsArr) {
                    //print_r($visitorsArr);
                    if (in_array('male', $visitorsArr))
                        $query->orWhere('users.gender', 'male');
                });
                $query->orWhere(function ($query) use ($visitorsArr) {

                    if (in_array('female', $visitorsArr))
                        $query->orWhere('users.gender', 'female');
                });
            });
        }


        if (isset($gender) AND $gender != '') {
            if ($gender == 'male') {
                $users->where(function ($query) use ($gender) {
                    $query->orWhere('users.gender', 'male');
                });
            } else if ($gender == 'female') {
                $users->where(function ($query) use ($gender) {
                    $query->orWhere('users.gender', 'female');
                });
            }
        }


        if (isset($firstName) AND $firstName != '') {
            $users->where('users.name', 'like', '%' . $firstName . '%');
        }
        if (isset($lastName) AND $lastName != '') {
            $users->where('users.name', 'like', '%' . $lastName . '%');
        }
        if (isset($numVisitArr) AND $numVisitArr != '') {
            $users->havingRaw('amountofvisit between ' . $numVisitArr[0] . ' and  ' . $numVisitArr[1] . '');
        }

        if (isset($isDateQkSel) &&  $isDateQkSel != 0 && !empty($isDateQkSel)) {
            $users->whereRaw('radacct.acctstarttime >= DATE(NOW()) - INTERVAL ' . $dateQkSel . ' DAY');
        } else if (isset($datefrom) && isset($dateto) && $datefrom != "0000-00-00" && $dateto != "0000-00-00" && $datefrom != "" && $dateto != "") {
            $users->whereRaw('DATE_FORMAT(radacct.acctstarttime,"%Y-%m-%d") between "' . $datefrom . '" and  "' . $dateto . '"');
        }

        if (isset($routerArr) AND $routerArr != '') {
            $users->whereIn('nas.ssid', $routerArr);
        }

        //added by me@diegopucci.com @pucci_diego
        if (isset($langArr) AND $langArr != '') {
            $users->whereIn('users.language', $langArr);
        }

        $stars = 2;
        if (isset($starsInput) && $starsInput != '' && $starsInput >= 2) {
            $stars = $starsInput;
        }
        $users->where('stars_rating.stars', '>=', $stars);
        $users->where('stars_rating.admin_id', '=', Auth::user()->id);
        //added by me@diegopucci.com @pucci_diego END

        //echo $users->getQuery()->toSql(); die;

        $users = $users->get();

        if ($callFrom == 'selList' OR $callFrom == 'indexCount' OR $callFrom == 'formList') {
            $fbCount = $gCount = $eCount = 0;
            foreach ($users as $user) {

                //edited by me@diegopucci.com
                switch($user->favoredconnection){
                    case 2:
                    case 3:
                    case 4:
                        $eCount++;
                        break;
                    default:
                        if ($user->profileurl != '' AND strpos($user->profileurl, 'facebook') !== false) {
                            $fbCount++;
                        } else{
                            $gCount++;
                        }
                }
                //edited by me@diegopucci.com END
            }
            $countRes = ['fbCount' => $fbCount, 'gCount' => $gCount, 'eCount' => $eCount];

            if ($callFrom == 'indexCount')
                return $countRes;
            else
                return Response::json($countRes);
        } else if ($callFrom == 'datatable' OR $callFrom == 'expList' OR $callFrom == 'emailSetup' OR $callFrom == 'campaignmove') {
            return $users;
        }
    }

    public function exportUsers($listId, $expType) {

        $fileName = md5(time()) . rand(11111, 99999) . '.' . $expType;
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-Disposition' => 'attachment; filename=' . $fileName
            , 'Expires' => '0'
            , 'Pragma' => 'public'
        ];

        $headers['Content-type'] = 'text/csv';
        if ($expType == 'txt')
            $headers['Content-type'] = 'text/plain';
        if ($expType == 'xls')
            $headers['Content-type'] = 'application/vnd.ms-excel; charset=utf-8';
        $list = $this->getStatistics($listId, 'expList');
        $list = $list->toArray();
        $callback = function() {

        };
        if (count($list)) {
            # add headers for each column in the CSV download
            $headRow = array_keys($list[0]);
            $radkey = array_search('radacctid', $headRow);
            $uidkey = array_search('userId', $headRow);
            unset($headRow[$radkey]);
            unset($headRow[$uidkey]);
            array_unshift($list, $headRow);

            $callback = function() use ($list) {
                $FH = fopen('php://output', 'w');
                //add BOM to fix UTF-8 in Excel
                fputs($FH, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
                foreach ($list as $row) {
                    unset($row['radacctid']);
                    unset($row['userId']);
                    fputcsv($FH, $row, ";");
                }
                fclose($FH);
            };
        }
        return Response::stream($callback, 200, $headers);
    }

    public function getProfile($id) {

        $getProfile = Users::findOrFail($id);

        $getLastVisit = Radacct::select(DB::raw('username, DATEDIFF(now(),max(acctstarttime)) as lastvisit,count(radacct.username) as connections,calledstationid'))->where('username', '=', $getProfile->username)->get();
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
        $getRouterInformation = Radacct::select(DB::raw('radacct.radacctid,username,count(radacct.calledstationid) as totalVisit,DATE_FORMAT(max(radacct.acctstarttime),"%b %d %Y %h:%i %p") as LastVisitDate,nas.nasidentifier,nas.shortname as routerName'))
            ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')->where('username', '=', $getProfile->username)->groupBy('radacct.calledstationid')->take(1)->get();
        $getRouterAllInfo = Radacct::select(DB::raw('radacct.radacctid,username,count(radacct.calledstationid) as totalVisit,DATE_FORMAT(max(radacct.acctstarttime),"%b %d %Y %h:%i %p") as LastVisitDate,nas.nasidentifier,nas.shortname as routerName'))
            ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')->where('username', '=', $getProfile->username)->groupBy('radacct.calledstationid')->get();
        $email=$getProfile->email;
        $emailCampignData =  \App\EmailCampaign::select(DB::raw('campaignName,campaignStatus,subjectEmail,checkbox,DATE_FORMAT(createdDate,"%b %d %Y %h:%i %p") as createdDate '))->whereRaw("find_in_set(checkbox,'$email') and campaignStatus='send'")->get();

        return view('users.profile', compact('getProfile', 'getLastVisit', 'getLatestUsers', 'totalConnections', 'getRouterInformation','emailCampignData','getRouterAllInfo'));
    }
    public function getRecord(){
        $users= \App\Users::whereRaw('firstname =" " and lastname =" " and name!="" ')
            ->get();
        //dd($users); exit;
        echo 'total rows='.count($users);
//        echo '<pre>';
//        print_r($users); exit;
        $i=0;
        foreach($users as $user){
            //echo $user->name;
            $name=explode(' ',$user->name);
            $user->firstname=$name[0];
            if(isset($name[1]))
                $user->lastname=$name[1];

            $status=$user->update();
            $i++;

        }
        echo ' affected rows='.$i;
        if(isset($status))
            echo ' records updated ';
        else
            echo 'error ';

        echo ' <a href="/">GOTO HOME PAGE</a>';
    }

}
