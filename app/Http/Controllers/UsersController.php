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
        View::share('projectTitle', 'ClicSpot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {

        if ($request->ajax()) {
            $listVal = $request->input('listVal');
            $users = $this->getStatistics($listVal,'datatable');
            return Datatables::of($users)
                            ->editColumn('favoredconnection', function ($users) {
                                if ($users->favoredconnection == '2')
                                    //return '<i class="fa fa-envelope"></i>';
                                    return "<img src='img/mail.png' />";
                                else {
                                    if ($users->profileurl != '' AND strpos($users->profileurl, 'facebook') !== false) {
                                        return "<img src='img/facebook.png' />";
                                    } else
                                        return "<img src='img/googleplus.png' />";
                                }
                            })
                            ->addColumn('campaign', function ($users) {
                                return $users->campaignName;
                            })
                            ->addColumn('review', function ($users) {
                                return "Review Here";
                            })
                            ->make(true);
        } else {
            $users = $this->getStatistics('','indexCount');
            $emailList = Auth::user()->emailList()->select('listname', 'id')->get();
            return view('users.index', ['facebookCount' => $users['fbCount'], 'googleCount' => $users['gCount'], 'emailCount' => $users['eCount'], 'emailList' => $emailList]);
        }
    }

    public function getStatistics($listId = '',$callFrom='') {
        if ($listId AND $listId != 'static') {
            $emailListFilterData = EmailList::findOrFail($listId);
            $favConArr = explode(';', $emailListFilterData->favoredconnection);
            $visitorsArr = ($emailListFilterData->visitors) ? explode(';', $emailListFilterData->visitors) : '';
            $numVisitArr = ($emailListFilterData->numberofvisit) ? explode(';', $emailListFilterData->numberofvisit) : '';
            $routerArr = ($emailListFilterData->router) ? explode(';', $emailListFilterData->router) : '';
            $firstName = $emailListFilterData->firstname;
            $lastName = $emailListFilterData->lastname;
            $isDateQkSel = $emailListFilterData->isdatequickselection;
            $dateQkSel = $emailListFilterData->datequickselection;
            $datefrom = $emailListFilterData->datefrom;
            $dateto = $emailListFilterData->dateto;
        }else if($callFrom == 'formList'){
            $inputs = Input::all();
            if(isset($inputs['favoredconnection']))
                $favConArr = $inputs['favoredconnection'];
            if(isset($inputs['visitors']))
                $visitorsArr = $inputs['visitors'];
            $numVisitArr = ($inputs['numberofvisit']) ? explode(';', $inputs['numberofvisit']) : '';
            if(isset($inputs['router']))
                $routerArr = $inputs['router'];
                $firstName = $inputs['firstname'];
                $lastName = $inputs['lastname'];
            $isDateQkSel = $inputs['isdatequickselection'];
            $dateQkSel = $inputs['datequickselection'];
            if(isset($inputs['datefrom']))
                $datefrom = $inputs['datefrom'];
            if(isset($inputs['dateto']))
                $dateto = $inputs['dateto'];
        }
        if (Auth::user()->type == 'superadmin') {
        $users = Radacct::select(DB::raw('radacct.radacctid,users.id as userId,users.profileurl,users.type as favoredconnection,campaign.name as campaignName, users.name as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                ->join('campaign', 'nas.campaignid', '=', 'campaign.id')
                ->groupBy('radacct.username')
                ->orderBy('acctstarttime', 'desc');
        }  else {
            $users = Radacct::select(DB::raw('radacct.radacctid,users.id as userId,users.profileurl,users.type as favoredconnection,campaign.name as campaignName, users.name as visitor,DATE_FORMAT(max(acctstarttime),"%b %d") as lastvisit,count(radacct.username) as `amountofvisit`'))
                ->join('users', 'radacct.username', '=', 'users.username')
                ->join('nas', 'radacct.calledstationid', '=', 'nas.nasidentifier')
                ->join('campaign', 'nas.campaignid', '=', 'campaign.id')
                ->where('nas.adminid', '=', Auth::user()->id)
                ->groupBy('radacct.username')
                ->orderBy('acctstarttime', 'desc');
        }
        if (isset($favConArr)) {
            $users->where(function ($query) use ($favConArr) {
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('facebook', $favConArr))
                        $query->where('users.type', '1')->where('users.profileurl', 'like', '%facebook%');
                });
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('google', $favConArr))
                        $query->orWhere('users.type', '1')->where('users.profileurl', 'like', '%google%');
                });
                $query->orWhere(function ($query) use ($favConArr) {
                    if (in_array('email', $favConArr))
                        $query->orWhere('users.type', '2');
                });
            });
        }
        if (isset($visitorsArr) AND $visitorsArr != '') {
            $users->where(function ($query) use ($visitorsArr) {
                $query->orWhere(function ($query) use ($visitorsArr) {
                    if (in_array('male', $visitorsArr))
                        $query->orWhere('users.gender', 'male');
                });
                $query->orWhere(function ($query) use ($visitorsArr) {
                    if (in_array('female', $visitorsArr))
                        $query->orWhere('users.gender', 'female');
                });
            });
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
        if (isset($isDateQkSel)) {
            if ($isDateQkSel) {
                $users->whereRaw('acctstarttime >= DATE(NOW()) - INTERVAL ' . $dateQkSel . ' DAY');
            } else if (isset($datefrom) AND $datefrom != '' AND isset($dateto) AND $dateto != '') {
                $users->whereRaw('DATE_FORMAT(acctstarttime,"%Y-%m-%d") between "' . $datefrom . '" and  "' . $dateto . '"');
            }
        }
        if (isset($routerArr) AND $routerArr != '') {
            $users->whereIn('nas.nasidentifier', $routerArr);
        }
        $users = $users->get();
        
        // return on basis of call from function
        if ($callFrom == 'selList' OR $callFrom == 'indexCount' OR $callFrom == 'formList') {
            $fbCount = $gCount = $eCount = 0;
            foreach ($users as $user) {
                if ($user->favoredconnection == '2')
                    $eCount++;
                else {
                    if ($user->profileurl != '' AND strpos($user->profileurl, 'facebook') !== false) {
                        $fbCount++;
                    } else
                        $gCount++;
                }
            }
            $countRes = ['fbCount' => $fbCount, 'gCount' => $gCount, 'eCount' => $eCount];
            if($callFrom == 'indexCount')
                return $countRes;
            else
                return Response::json($countRes);
        } else if ($callFrom == 'datatable' OR $callFrom == 'expList') {
            return $users;
        }
    }
    
    public function exportUsers($listId,$expType){
           
            $fileName = md5(time()) . rand(11111, 99999) . '.' .$expType;
            $headers = [
                    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-Disposition' => 'attachment; filename='.$fileName
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];
            
            $headers['Content-type']  = 'text/csv';
            if($expType == 'txt')
                $headers['Content-type']  = 'text/plain';
            if($expType == 'xls')
                $headers['Content-type']  = 'application/vnd.ms-excel; charset=utf-8';
            $list =$this->getStatistics($listId,'expList');
            $list = $list->toArray();
            # add headers for each column in the CSV download
            array_unshift($list, array_keys($list[0]));
            
           $callback = function() use ($list)
            {
                $FH = fopen('php://output', 'w');
                //add BOM to fix UTF-8 in Excel
                fputs($FH, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
                foreach ($list as $row) {
                    
                    fputcsv($FH, $row,";");
                    
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);

    }
    

}
