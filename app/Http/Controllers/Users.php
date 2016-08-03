<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'type', 'name', 'email', 'gender', 'profileurl','avatar','birthday','language','firstname','lastname'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function RadCheckRecord()
    {
        return $this->hasOne('App\RadCheck', 'username', 'username');
    }
    
    public function RadacctU()
    {
        return $this->hasOne('App\Radacct', 'username', 'username');
    }

}
