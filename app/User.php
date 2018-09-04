<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'firstname', 'lastname', 'email', 'password', 'langue', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function isAdmin() {
        return $this->role()->firstOrFail()->role == "admin";
    }

    public function fullname() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
