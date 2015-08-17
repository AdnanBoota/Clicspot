<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Routers extends Model
{

    protected $table = 'routers';

    protected $fillable = ['model', 'macaddress', 'ssid', 'configversion'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['configversion'];

    public function status()
    {
        return $this->hasOne('App\RouterStatus', 'macaddress', 'macaddress');
    }

}
