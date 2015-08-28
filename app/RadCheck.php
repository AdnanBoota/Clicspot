<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RadCheck extends Model
{

    public $timestamps = false;

    protected $table = 'radcheck';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'attribute', 'op', '	value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function Users()
    {
        return $this->belongsTo('App\Users', 'username', 'username');
    }

}
