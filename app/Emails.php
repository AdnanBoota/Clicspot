<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{

    protected $table = 'email_template';
    public $timestamps = false;
    protected $fillable = ['adminid', 'templateName','description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [''];

    public function user() {
        
        return $this->belongsTo('App\User', 'adminid', 'id');
        
    }
}
