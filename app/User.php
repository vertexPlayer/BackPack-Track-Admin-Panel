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
        'name', 'username', 'phone', 'address', 'country_id', 'email', 'password', 'avatar_url', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function itinerary()
    {
    	return $this->hasMany('App\Itinerary');
    }

    public function comment()
    {
    	return $this->hasMany('App\Comment');
    }

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}