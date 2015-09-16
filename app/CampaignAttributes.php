<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignAttributes extends Model
{

    protected $table = 'campaign_attributes';
    public $timestamps = false;
    protected $fillable = ['campaignid', 'attribute', 'op', 'value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [''];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign', 'campaignid', 'id');
    }
    
}
