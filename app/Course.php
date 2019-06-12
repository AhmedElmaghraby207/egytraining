<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use willvincent\Rateable\Rateable;

class Course extends Model
{
    use Rateable;

    protected $fillable = ['name', 'description', 'cover', 'coach_id', 'category_id', 'certificate_id', 'active',
    'published', 'status', 'price', 'start_at', 'finish_at', 'needs', 'video_link', 'video', 'male', 'female'];

    protected $attributes = [
        'male' => 0,
        'female' => 0
    ];

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]

        ];
    }


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function coach()
    {
        return $this->belongsTo('App\User');
    }

    public function certificate()
    {
        return $this->hasOne('App\Certificate');
    }

    public function lectures()
    {
        return $this->hasMany('App\Lecture');
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }

    public function trainers()
    {
        return $this->belongsToMany('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function alerts()
    {
        return $this->hasMany('App\Alert');
    }
}

