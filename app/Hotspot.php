<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{

    protected $table = 'nas';
    public $timestamps = false;
    protected $fillable = ['adminid', 'shortname', 'nasidentifier', 'campaignid', 'address', 'latitude', 'longitude','redirectUrl'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['secret'];

    public function user()
    {
        return $this->belongsTo('App\User', 'adminid', 'id');
    }

    public function router()
    {
        return $this->belongsTo('App\Routers', 'nasidentifier', 'macaddress');
    }

    public function status()
    {
        return $this->belongsTo('App\RouterStatus', 'nasidentifier', 'macaddress');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign', 'campaignid', 'id');
    }
    
    public function hotspotAttributes()
    {
        return $this->hasMany('App\HotspotAttributes', 'nasid');
    }
    
    public function RadacctH()
    {
        return $this->hasMany('App\Radacct', 'calledstationid');
    }

}
