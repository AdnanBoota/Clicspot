<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampaignFeedback extends Model
{

    protected $table = 'campaign_feedback';
    public $timestamps = false;
    protected $fillable = ['email_campaign_id', 'message_id','emailid' ,'email_name','feedback_confirm','status'];

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
        return $this->belongsTo('App\EmailCampaign', 'email_campaign_id','id');
    }

    public static function getDefaultCampaign()
    {
        return self::where('name','=','Default');
    }
    
    public function hotspot()
    {
        return $this->hasMany('App\Hotspot','campaignid');
    }
}
