<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RouterStatus extends Model
{

    protected $table = 'router_status';

    protected $fillable = ['macaddress', 'publicip'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['configversion'];

    public function router()
    {
        return $this->belongsTo('App\Routers', 'macaddress', 'macaddress');
    }

}
