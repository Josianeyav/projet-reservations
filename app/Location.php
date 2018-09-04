<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'designation', 'address', 'website', 'phone', 'slug'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the locality in which this locations belongs
     */
    public function locality()
    {
        return $this->belongsTo('App\Locality');
    }

    /**
     * Get the shows that are happening in this locality
     */
    public function shows()
    {
        return $this->hasMany('App\Locality');
    }

    /**
     * Gets the reservations for the location
     */
    public function reservations()
    {
        return $this->hasMany('App\Representation');
    }
}
