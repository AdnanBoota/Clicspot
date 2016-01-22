<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use GoCardless;
use DB;
use Auth;
use Response;
use App\Transactions;
use Carbon;
use Mail;
use Illuminate\Support\Facades\Input;


class CronController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        
    }

    public function sendmailTestCron() {
        $userId['userId'] = "1";
        $userId['templateName'] = "sdfs";
        Mail::send('email.emailTemplate', $userId, function ($message) {
            $message->to('bindeshpandya@hotmail.com', 'example_name')->subject('Welcome!');
        });
    }

    public function allUserSubscriptionCheck() {

        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        $userId = SubscriptionHistory::select('*')
                ->join('admin_user', 'admin_user.id', '=', 'subscription_history.adminid')
                ->where('nextpaymentdate', '=', new \DateTime('today'))
                ->get();

        if (!empty($userId)) {
            foreach ($userId as $key => $value) {


                $resourceid = $value->resourceid;
                \GoCardless::set_account_details($account_details);
                $pre_auth = \GoCardless_PreAuthorization::find($resourceid);
                $bill_details = array(
                    'name' => $value->username,
                    'amount' => '200.00',
                    'currency' => 'EUR',
                    'charge_customer_at' => date('Y-m-d', strtotime('+1 years'))
                );
                $input['resourceid'] = $resourceid;
                $input['amount'] = $bill_details['amount'];
                $input['status'] = 'success';
                $subScriptionHistory['amount'] = $bill_details['amount'];
                $subScriptionHistory['resourceid'] = $resourceid;
                $subScriptionHistory['nextpaymentdate'] = date('Y-m-d', strtotime('+1 years'));
                $subScriptionHistory['description'] = $bill_details['amount'] . " will submitted to your account on " . date('Y-m-d', strtotime('+1 years'));
                try {
                    $bill = $pre_auth->create_bill($bill_details);
                    $subScriptionHistory['billid'] = $bill->id;
                    $input['billid'] = $bill->id;
                    $input['paymentstatus'] = "paid";
                    $subScriptionHistory['paymentstatus'] = "Success";
                } catch (\GoCardless_ApiException $e) {
                    $response = $e->getResponse();
                    $message = substr($response['errors']['pre_authorization'][0], 0, 24);
                    $input['reason'] = $message;
                    $input['status'] = 'fails';
                    $input['paymentstatus'] = "fails";
                    $subScriptionHistory['paymentstatus'] = "fails";
                }

                $sub = new SubscriptionHistory($subScriptionHistory);
                $result = $sub->save();
                $trans = new Transactions($input);
                $res = $trans->save();
            }
        }
    }

}
