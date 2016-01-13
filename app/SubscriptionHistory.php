<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model {

	protected $table = 'subscription_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['adminid','resourceid', 'amount', 'description', 'nextpaymentdate'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
