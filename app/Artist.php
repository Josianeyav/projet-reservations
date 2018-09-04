<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Gets the representations for the show
     */
    public function artisteTypes()
    {
        return $this->hasMany('App\ArtisteType');
    }

    /**
     * Gets the artists' full name
     * @return string
     */
    public function fullname() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
