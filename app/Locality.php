<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postal_code', 'locality'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localities';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
