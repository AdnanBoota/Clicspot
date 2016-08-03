<?php

/*
 * me@diegopucci.com
 */

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class StarsRating extends Model
{

    protected $table = 'stars_rating';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_id', 'email_id', 'points'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    public $timestamps = true;

    public static function getStarsRating($userId){

        $email = $userId;
        if(is_numeric($userId)) {
            $email = \App\Users::where(['id' => $userId])
                ->take(1)
                ->lists('email');
            $email = $email[0];
        }

        $stars = \App\StarsRating::where(['admin_id' => Auth::user()->id, "email_id" => $email])
            ->take(1)
            ->lists('stars');

        if(count($stars) > 0) return $stars[0];
        else return 2;
    }

    public static function returnStarsByPoints($points){
        $stars = null;
        if(count($points) == 0) $points = 0;
        if(count($points) > 0) $points = $points[0];
        if($points <= - 6) $stars = 0;
        if($points <= 0) $stars = 1;
        if($points == 0 || $points > 0) $stars = 2;
        if($points >= 6 ) $stars = 3;
        if($points >= 12 ) $stars = 4;
        if($points >= 18 ) $stars = 5;

        return $stars;
    }
}
