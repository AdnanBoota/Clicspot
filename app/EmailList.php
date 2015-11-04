<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{

    protected $table = 'email_list';
    
    protected $fillable = ['adminid', 'listname', 'favoredconnection', 'visitors', 'age', 'firstname', 'lastname','numberofvisit', 'isdatequickselection', 'datequickselection', 'datefrom', 'dateto', 'router','rate'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public function user()
    {
        return $this->belongsTo('App\User', 'adminid', 'id');
    }

}
