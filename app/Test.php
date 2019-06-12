<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Test extends Model
{
    protected $fillable = ['question', 'first_ans', 'second_ans', 'third_ans', 'correct_ans', 'course_id', 'coach_id', 'active'];

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'question',
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
