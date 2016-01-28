<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersFeedback extends Model
{

    protected $table = 'users_feedback';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'nasidentifier', 'message_id','feedback_code','feedback_confirm','review', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    public $timestamps = true;

}
