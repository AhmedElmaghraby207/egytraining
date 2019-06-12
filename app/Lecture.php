<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Lecture extends Model
{
    protected $fillable = ['name', 'description', 'course_id', 'coach_id', 'video_link', 'video', 'file',
        'active', 'published'];

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

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function coach()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
