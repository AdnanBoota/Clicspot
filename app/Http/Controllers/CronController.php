<?php

namespace App\Http\Controllers;

use GuzzleHttp;
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
use App\UsersFeedback;


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
            $message->to('me@diegopucci.com', 'example_name')->subject('Welcome!');
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

    public function feedbackMandrillReview(){
        $usrFeedData = UsersFeedback::where("status","=",'0')->where("feedback_confirm","=","0")->get();
        //$usrFeedData = UsersFeedback::where("status","=",'0')->get();
        echo "<pre>";
        //print_r(count($usrFeedData));
        //exit;
        foreach ($usrFeedData as $key=>$usrFeed){
            echo "<br>";
            //echo $usrFeed['id'];
            echo "<br>";
            //$usrFeed['message_id'];

            $response = \MandrillMail::messages()->info($usrFeed['message_id']);
            if($response){
                $userFeedUpdate = UsersFeedback::find($usrFeed['id']);
                if($response['opens'])
                    $userFeedUpdate->review = 2;
//                if($response['clicks'])
//                    $userFeedUpdate->review = 3;
                $userFeedUpdate->status = 1;
                $userFeedUpdate->update();
            }


            echo "<br>";
            print_r($response);
//            exit;
        }
        exit;

    }

//TODO This one should be removed
    public function emailSetupSchedulTime(){
        // echo $mytime=Carbon\Carbon::now();
        $emailCamp=  \App\EmailCampaign::where(DB::raw('date(scheduleTime)'),'<', date(Carbon\Carbon::today()))
            ->where('campaignStatus','schedule')
            ->get();
//       echo '<pre>';
        // print_r($emailCamp);
//        exit;
        if(isset($emailCamp) && count($emailCamp)>0){
//             echo '<pre>';
//       print_r($emailCamp);
            $msgBody="";
            $emailArr=array();
            foreach ( $emailCamp as $email) {
                //      echo $email->templateId;
                $template=  \App\Emails::where('id',$email->templateId)->first();
                // print_r($template);
                $emailArr=explode(',',$email['checkbox']);
                $firstname=explode(',',$email['checkboxName']);
//exit;                
                Mail::send('email.emailTemplate', array('msgBody' => $msgBody, 'templateId' => $template->id, 'templateName' => $template->templateName, 'userId' => $email->adminid), function ($message) use ($email,$emailArr) {
                    $message->to($emailArr);
                    $message->from($email->senderEmail, $email->fromName);
                    $message->subject($email->subjectEmail);
                });
            }

            if(count(Mail::failures()) > 0){
                echo  $errors = 'Failed to send and reset email, please try again.';
            }else{
                foreach ( $emailCamp as $email) {
                    $emailSent=  \App\EmailCampaign::find($email->id);
                    $emailSent->campaignStatus='send';
                    $emailSent->save();

                }
                echo 'success';
            }
        }
    }

    protected function updatePoints($eventsToUpdate = array()){

        foreach($eventsToUpdate as $transmissionResult){

            // getting the state of current data about the transmission in the db
            $emailInfo = \App\EmailEvents::where("emailid", "=", $transmissionResult["emailid"])
                ->where("transmission_id", "=", $transmissionResult["transmission_id"])
                ->select('adminid', 'emailid', 'points')
                ->get()->toArray();

            if(count($emailInfo) > 0){

                $adminId = $emailInfo[0]["adminid"];
                $emailId = $emailInfo[0]["emailid"];
                $transmissionPrevPoints = $emailInfo[0]["points"];
                $transmissionNewPoints = $transmissionResult["points"];

                //checking if there is a row for this email based on Admin ID.
                $hasRating = \App\StarsRating::where(['email_id' => $emailId, 'admin_id' => $adminId])->get()->toArray();
                //checking if we have already submitted the points for this transmission or there are no additional updates
                if($transmissionNewPoints != $transmissionPrevPoints){
                    $currentPoints = $hasRating[0]["points"] + ($transmissionNewPoints);

                    //updating the overall rating
                    \App\StarsRating::where(['email_id' => $emailId, 'admin_id' => $adminId])
                        ->update(['points' => $currentPoints, 'stars' => \App\StarsRating::returnStarsByPoints($currentPoints)]);
                }

                //finally updating the transmission info inside the email_events table
                \App\EmailEvents::where('emailid','=', $transmissionResult["emailid"])
                    ->where('transmission_id','=', $transmissionResult["transmission_id"])
                    ->update($transmissionResult);
            }
        }
        die;
    }
    /*
     * Diego Pucci me@diegopucci.com @pucci_diego
     * Actual call to the SparkPost API
    */
    protected function sparkPostLoop($sparkPostRes = null){
        $perPage = 10000;
        $auth = "ac0acd4c1cb4665cd46edb4ada4aea6d24c2f278";
        $client = new GuzzleHttp\Client();

        $sparkpost = $client->get('https://api.sparkpost.com/api/v1/message-events?per_page='.$perPage, array(
            'headers' => array(
                'Accept' => 'application/json',
                'Authorization' => $auth
            )
        ));
        $res = json_decode($sparkpost->getBody(), true);

        return $res;
    }


    /*
     * Diego Pucci me@diegopucci.com @pucci_diego
     * Assigns points.
     * Each 6 points is a star (positive or negative). Starts from 2 stars at 5 points
     */
    protected function emailFeedback($event){
        $casesTree = array(
            "click" => array(
                "points" => 3,
                "feedback_confirm" => 5
            ),
            "open" => array(
                "points" => 2,
                "feedback_confirm" => 4
            ),
            "delivery" => array(
                "points" => -1,
                "feedback_confirm" => 2
            ),
            "injection" => array(
                "points" => 0,
                "feedback_confirm" => 1
            ),
            "bounce" => array(
                "points" => -3,
                "feedback_confirm" => 3
            ),
            "policy_rejection" => array(
                "points" => -3,
                "feedback_confirm" => 6 //policy_rejection
            ),
            "delay" => array(
                "points" => 0,
                "feedback_confirm" => 7 //delay
            ),
            "out_of_band" => array(
                "points" => -3,
                "feedback_confirm" => 8 //out of band
            ),
            "generation_failure" => array(
                "points" => 0, //TODO
                "feedback_confirm" => 9 //generation_failure
            ),
            "generation_rejection" => array(
                "points" => 0, //TODO
                "feedback_confirm" => 10 //generation_failure
            ),
            "spam_complaint" => array(
                "points" => -6, //TODO
                "feedback_confirm" => 11 //spam_complaint
            ),
            "list_unsubscribe" => array(
                "points" => -6, //TODO
                "feedback_confirm" => 6 //list_unsubscribe
            ),
            "link_unsubscribe" => array(
                "points" => 0, //TODO
                "feedback_confirm" => 13 //link_unsubscribe
            )
        );

        return array(
            "transmission_id" => $event["transmission_id"],
            "emailid" => $event["rcpt_to"],
            "points" => $casesTree[$event["type"]]["points"],
            "feedback_confirm" => $casesTree[$event["type"]]["feedback_confirm"]
        );
    }

    /*
     * Diego Pucci me@diegopucci.com @pucci_diego
     * Calls SparkPost API to get transmissions events
     * Runs every hour on the crontab.
    */
    public function emailTrack(){

        $events = $this->sparkPostLoop();

        if($events != null && count($events["results"]) > 0){
            //just making data in a format that will be useful later
            $eventsToUpdate = array();
            $alreadyParsed = array(); //will track all the events already parsed, since SparkPost returns the events from top to bottom fo the JSON based on date DESC

            foreach($events["results"] as $event){
                    // checking only the first results parsing the json. Since sparkpost already orders the events based on importance. From click to injection.
                    // this way we make sure to add points only for the most valuable events (like click or bounce).
                    $toBeParsed = $event["transmission_id"] . $event["rcpt_to"]; //combination of the transmission ID and the email to avoid parsing more than one events for the couple transmission + recipient
                    if(!in_array($toBeParsed, $alreadyParsed)){
                        $alreadyParsed[] = $event["transmission_id"] . $event["rcpt_to"];

                        //generating an array to be used on updatePoints function. The array will use the name of the DB columns involved.
                        $eventsToUpdate[] = $this->emailFeedback($event);
                    }
            }

            //it's time to update
            $this->updatePoints($eventsToUpdate);
            die;
        }
        die;
    }
}
