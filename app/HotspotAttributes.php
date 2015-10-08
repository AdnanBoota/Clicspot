<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HotspotAttributes extends Model
{

    protected $table = 'nas_attributes';
    public $timestamps = false;
    protected $fillable = ['nasid', 'attribute', 'op', 'value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [''];

    public function hotspot()
    {
        return $this->belongsTo('App\Hotspot', 'nasid', 'id');
    }
    
}
