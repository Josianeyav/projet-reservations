<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'representations';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['schedule', 'ref'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function show()
    {
        return $this->belongsTo('App\Show');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function beautifulSchedule()
    {
        return (new Carbon($this->schedule))->toRfc7231String();
    }

}
