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
    protected $fillable = ['username', 'name', 'email', 'gender', 'profileurl'];

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

}
