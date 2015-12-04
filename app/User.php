<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $rules = '';

    public function hotspots()
    {
        return $this->hasMany('App\Hotspot','adminid');
    }
    
    public function campaigns()
    {
        return $this->hasMany('App\Campaign','adminid');
    }
    
    public function emailTemplates()
    {
        return $this->hasMany('App\Emails','adminid');
    }
    
    public function emailList()
    {
        return $this->hasMany('App\EmailList','adminid');
    }

}
