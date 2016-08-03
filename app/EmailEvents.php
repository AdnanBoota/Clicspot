<?php
/*
  * me@diegopucci.com
  */

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailEvents extends Model
{

    protected $table = 'email_events';
    public $timestamps = false;
    protected $fillable = ['transmission_id', 'adminid','emailid' ,'email_name','feedback_confirm'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [''];

    public function user()
    {
        return $this->belongsTo('App\User', 'adminid', 'id');
    }

    public function campaign()
    {
        return $this->belongsTo('App\EmailCampaign', 'transmission_id','id');
    }

    public static function getDefaultCampaign()
    {
        return self::where('name','=','Default');
    }

    public static function reportData($type, $id = NULL){
        $adminId = Auth::user()->id;

        if($type=="campaign") {
            $users = self::where('email_campaign.id','=',$id)
                ->leftJoin('email_campaign','email_campaign.transmission_id','=','email_events.transmission_id')
                ->leftJoin('email_template','email_template.id','=','email_campaign.templateId')
                ->select('email_events.id','email_events.emailid','email_events.created_at','email_events.feedback_confirm','email_campaign.id as camid','email_campaign.emailListId','email_campaign.adminid','email_campaign.templateId','email_template.templateName')
                ->get();
        }elseif($type=="transactionals"){
            if($id != null && $id != "") {
                $users = self::where('email_events.adminid','=',$adminId)
                    ->where('email_events.transmission_type','=',"transactional")
                    ->where('email_events.router_id','=',$id)
                    ->select('email_events.id','email_events.emailid','email_events.created_at','email_events.feedback_confirm', 'email_events.adminid')
                    ->get();
            }else{
                $users = self::where('email_events.adminid','=',$adminId)
                    ->where('email_events.transmission_type','=',"transactional")
                    ->select('email_events.id','email_events.emailid','email_events.created_at','email_events.feedback_confirm', 'email_events.adminid')
                    ->get();
            }
        }


        $total_count = count($users);
        $date = null;
        $adminId = null;
        $templateName = null;
        $rateuser = array();
        $click = 0;
        $open = 0;
        $deliver = 0;
        $bounce = 0;
        $filteredUsers = array();
        foreach($users as $finduser)
        {
            $counter = $finduser->feedback_confirm;

            //me@diegopucci.com
            //email sent but not data received from SparkPost yet

            $rate['email'] = $finduser->emailid;
            $rate['feedback_confirm'] = $finduser->feedback_confirm;
            $rate['stars'] = \App\StarsRating::getStarsRating($finduser->emailid);
            $rate['date'] = substr($finduser->created_at, 0, 11);


            if($counter=='2'){
                if(isset($_GET["filter"]) && $_GET["filter"] == "delivered"){
                    array_push($filteredUsers, $rate);
                }
                $deliver=$deliver+1;
            }else if($counter=='4'){
                if(isset($_GET["filter"]) && $_GET["filter"] == "open"){
                    array_push($filteredUsers, $rate);
                }
                $open=$open+1;
            }else if($counter=='5'){
                if(isset($_GET["filter"]) && $_GET["filter"] == "clicks"){
                    array_push($filteredUsers, $rate);
                }
                $click=$click+1;
            }else{
                if(isset($_GET["filter"]) && $_GET["filter"] == "bounce"){
                    array_push($filteredUsers, $rate);
                }
                $bounce=$bounce+1;
            }
            $date = $rate['date'];
            if($type=="campaign") $templateName = $finduser->templateName;
            $adminId = $finduser->adminid;
            $rateuser[] = $rate;
        }

        $total_deliver = $deliver;
        $total_open = $open;

        $total_deliver_per = $total_count > 0 ? number_format(($total_deliver /$total_count) * 100,2) : 0;
        $total_open_per = $total_count > 0 ? number_format(($total_open /$total_count) * 100,2) : 0;
        $total_click_per= $total_count > 0  ? number_format(($click /$total_count) * 100,2) : 0;

        $statictic = array('total_count'=>$total_count,
            'deliver'=> $total_deliver,
            'open'=> $total_open,
            'click'=> $click,
            'bounce' => $bounce,
            'total_deliver_per'=>$total_deliver_per,
            'total_open_per' =>$total_open_per,
            'total_click_per' =>$total_click_per,
            'date'=> $date,
            'adminId'=> $adminId,
            'templateName'=>$templateName,
        );

        return array(
            "statictic" => $statictic,
            "rateuser" => $rateuser,
            "filteredUsers" => $filteredUsers
        );
    }
}
