<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    //
    protected $table = 'subscription_history';
    public $timestamps = false;
    protected $fillable = ['adminid', 'name', 'backgroundimage', 'logoimage', 'fontcolor', 'description', 'logoposition', 'backgroundzoom'];

}
