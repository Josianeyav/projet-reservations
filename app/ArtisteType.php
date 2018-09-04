<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisteType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'artiste_type';

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

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function info() {
        return $this->artist()->firstOrFail()->fullname() . ' (' . $this->type()->firstOrFail()->type . ')';
    }

}
