<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{

    protected $table = 'transactions';
    public $timestamps = false;
    protected $fillable = ['resourceid', 'amount','status','reason'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [''];

 
}
