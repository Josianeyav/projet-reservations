<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'artiste_type_show';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function artisteType()
    {
        return $this->belongsTo('App\ArtisteType');
    }

    public function show()
    {
        return $this->belongsTo('App\Show');
    }
    
}
