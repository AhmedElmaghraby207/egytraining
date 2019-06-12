<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Alert extends Model
{
    protected $fillable = ['title', 'content', 'course_id', 'coach_id', 'active'];

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
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
}
