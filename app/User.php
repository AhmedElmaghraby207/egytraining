<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'user_name', 'email', 'password', 'verifyToken', 'phone', 'country_id', 'gender', 'trainer', 'coach', 'about',
        'interest_id', 'qualification', 'career', 'specialize', 'image', 'active', 'cv' ,'cv_url'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'user_name',
                'onUpdate' => true,
            ]

        ];
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Interest');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function lectures()
    {
        return $this->hasMany('App\Lecture');
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }

    public function certificates()    //For coach or trainer
    {
        return $this->hasMany('App\Certificate');
    }


}
