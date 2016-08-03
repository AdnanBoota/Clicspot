<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPass extends Model
{

    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
