<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{

    protected $table = 'nas';
    public $timestamps = false;
    protected $fillable = ['adminid', 'shortname', 'nasidentifier','address','latitude','longitude'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['secret'];
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    
    public function router()
    {
        return $this->belongsTo('App\Routers', 'macaddress', 'macaddress');
    }

}
