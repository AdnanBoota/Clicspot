<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $table = 'campaign';
    public $timestamps = false;
    protected $fillable = ['adminid', 'name', 'backgroundimage', 'logoimage', 'fontcolor'];

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
        return $this->hasMany('App\CampaignAttributes','campaignid');
    }
}
