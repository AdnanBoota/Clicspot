<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Hotspot;
use App\Http\Requests;
use App\HotspotAttributes;
use App\SubscriptionHistory;
use GoCardless;
use App\Transactions;
use Request;
use Session;
use DB;
use Mail;
use App\UsersFeedback;
use App\Users;

class HotspotLoginController extends Controller {

    protected $redirectURL;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $mac = Request::get('called');
        //put in session for feedback review url
        Session::put('calledmac', $mac);
        $hotspot = Hotspot::where('nasidentifier', "=", $mac)->first();
        if ($hotspot) {
            $campaign = $hotspot->campaign;
            //$redirectURLOnSuccess = $hotspot->redirectUrl;
            if($campaign->fakebrowser && $campaign->fakebrowser != "")
            $redirectURLOnSuccess = $campaign->fakebrowser;
            session(
                    [
                        'redirectURL' => $redirectURLOnSuccess
                    ]
            );
        }

        if ($hotspot) {
            $res = Request::get('res');
            if ($res == 'notyet' || $res == 'failed' || $res == 'logoff') {
                return $this->display_notyet(Request::all(), $hotspot);
            } elseif ($res == 'already' || $res == 'success') {
                return $this->display_success(Request::all(), $hotspot);
            }
        } else {
            Session::put('mac', $mac);
            return redirect('/hotspot/create');
        }
    }

    public function login() {
        $flag = "true";
        $updateSubscriber = array();
         $mac = Session::get('mac');
        $calledmacd = Session::get('calledmac'); 
        $hotspot = Hotspot::where('nasidentifier', "=", $calledmacd)->first();
        $mac = Session::get('mac');
        $hotspotAttr = $campaign = array();
        
        $redirectURL = "https://www.google.com";
        if ($hotspot) {
            
            $hotspotAttr = HotspotAttributes::select(DB::raw('users.username,users.type,nas_attributes.nasid,nas_attributes.type,nas_attributes.attribute,nas_attributes.value'))
                    ->join('nas', 'nas_attributes.nasid', '=', 'nas.id')
                    ->join('users', 'nas_attributes.type', '=', 'users.type')
                    ->where('users.username', '=', Request::get('username'))
                    ->where('nas.id', '=', $hotspot->id)
                    ->get();
             $campaign = $hotspot->campaign;
            if($campaign->fakebrowser && $campaign->fakebrowser != ""){
                 //$redirectURL = $hotspot->redirectUrl;
                 $redirectURL = $campaign->fakebrowser;
            } else {
                $redirectURL = "https://www.google.com";
            }
            session(
                    [
                        'redirectURL' => $redirectURL
                    ]
            );
        }

        $username = Request::get('username');
        ///*
        //$username = "2C-D0-5A-91-3A-A6";
        //$mac = "14-CC-20-44-0D-68";
        $calledmac = Session::get('calledmac'); 
        $usrFeedData = UsersFeedback::where("username","=",$username)->where("nasidentifier","=",$calledmac)->first(); 
        $hotspotData = Hotspot::where('nasidentifier', "=", $calledmac)->first();
       
        if($hotspotData AND $hotspotData->reviewstatus){
            if(!$usrFeedData){ 
                $userDetail = Users::where('username', "=", $username)->first();
                $feedback_code = str_random(60);
                //send feedback mail
                if($userDetail){
                    $response = Mail::send('emails.feedbackTemplate', array('feedback_code' => $feedback_code ,'userDetail' => $userDetail,'hotspot' => $hotspotData), function ($message) use ($userDetail,$hotspotData) {
                        $message->to($userDetail->email, $userDetail->name);
                        $message->from($hotspotData->user->email, $hotspotData->user->businessname);
                        $message->subject("Thank you for visiting ".$hotspotData->shortname." !");
                    });

                    if($response){
                        $resBody = json_decode($response->getBody()->getContents());
                        if(count($resBody) > 0){
    //                        echo "<pre>";
    //                        print_r($resBody);
                            if($resBody[0]->status == "sent"){ 
                                $usrFeedback = new UsersFeedback();
                                $usrFeedback->message_id =  $resBody[0]->_id;
                                $usrFeedback->username =  $username;
                                $usrFeedback->nasidentifier =  $calledmac;
                                $usrFeedback->feedback_code =  $feedback_code;
                                $usrFeedback->save(); 
                                //exit;
                            }
                        }
                    }
                }
            } 
        }
        // */
        $password = 1;
        //exit;
        if(isset($campaign->delayPeriod) && $campaign->delayPeriod>0)
        return view('hotspotlogin.login', compact('username', 'password', 'redirectURL', 'hotspotAttr','campaign'));
       else
           return redirect("{$redirectURL}");
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_notyet($request, $hotspot) {
        session(
                [
                    'uamip' => $request['uamip'],
                    'uamport' => $request['uamport'],
                    'mac' => $request['mac'],
                    'challenge' => $request['challenge']
                ]
        );
        $campaign = $hotspot->campaign;
        return view('hotspotlogin.notyet', compact('request', 'hotspot', 'campaign'));
    }

    /**
     *
     * @param  Request $request
     * @return Response
     */
    public function display_success($request, $hotspot) {
        $redirectPathToSite = Session::get('redirectURL');
        return redirect("{$redirectPathToSite}");
        //  echo Session::get('redirectURL');
        // return redirect("{$redirectPathToSite}");
        //  return redirect(Session::get('redirectURL'));
        // return view('hotspotlogin.success', compact('request', 'hotspot'));
    }

    public function goCardlessAPI() {
        $userId = Hotspot::select(DB::raw('nas.adminid,admin_user.resourceid'))
                ->join('admin_user', 'admin_user.id', '=', 'nas.adminid')
                ->where('nas.nasidentifier', "=", Request::get('username'))
                ->get();

        if ($userId[0]) {
            $resourceid = $userId[0]->resourceid;
            $getSubScribedUser = SubscriptionHistory::select('*')
                    ->where('nextpaymentdate', '=', new \DateTime('today'))
                    ->whereRaw("resourceid='" . $resourceid . "'")
                    ->first();

            if (!empty($getSubScribedUser) && $getSubScribedUser->paymentstatus != "paid") {
                $account_details = array(
                    'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
                    'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
                    'merchant_id' => "12BP5Z9GEW",
                    'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
                );
                \GoCardless::set_account_details($account_details);
                $pre_auth = \GoCardless_PreAuthorization::find($userId[0]->resourceid);
                $bill_details = array(
                    'name' => 'asda',
                    'amount' => '200.00',
                    'currency' => 'EUR',
                    'charge_customer_at' => date('Y-m-d', strtotime('+1 years'))
                );
                $input['resourceid'] = $userId[0]->resourceid;
                $input['amount'] = $bill_details['amount'];
                $input['status'] = 'success';
                $subScriptionHistory['amount'] = $bill_details['amount'];
                $subScriptionHistory['resourceid'] = $userId[0]->resourceid;
                $subScriptionHistory['nextpaymentdate'] = date('Y-m-d', strtotime('+1 years'));
                $subScriptionHistory['description'] = $bill_details['amount'] . " will submitted to your account on " . date('Y-m-d', strtotime('+1 years'));
                try {
                    $bill = $pre_auth->create_bill($bill_details);
                    $subScriptionHistory['billid'] = $bill->id;

                    $updateSubscriber['paymentstatus'] = "paid";
                    $input['billid'] = $bill->id;
                    $input['paymentstatus'] = "paid";
                } catch (\GoCardless_ApiException $e) {

                    $response = $e->getResponse();
                    $message = substr($response['errors']['pre_authorization'][0], 0, 24);
                    $input['reason'] = $message;
                    $input['status'] = 'fail';
                    $flag = 'false';
//            $payouts = \GoCardless_Merchant::find($bill->merchant_id);
                }
                $updatesubscriber = SubscriptionHistory::findOrFail($getSubScribedUser->id);
                $update = $updatesubscriber->update($updateSubscriber);
                $sub = new SubscriptionHistory($subScriptionHistory);
                $result = $sub->save();
                $trans = new Transactions($input);
                $res = $trans->save();
            }
        }
    }

}
