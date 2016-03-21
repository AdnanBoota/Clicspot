<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{

    protected $table = 'email_campaign';
    public $timestamps = false;
    protected $fillable = ['adminid', 'emailListId', 'templateId','currentForm' ,'campaignName','templatePreview','campaignStatus','router','senderEmail','fromName','selectList','gender','age','checkbox','recipientNoOfVisit','duringRecipientLastVisit','datequickselection','noOfDays','testEmailAddress','createdDate','subjectEmail','scheduleTime'];

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

    public function campaignAttributes()
    {
        return $this->hasMany('App\CampaignAttributes', 'campaignid');
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
