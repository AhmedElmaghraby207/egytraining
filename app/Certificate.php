<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Certificate extends Model
{
    protected $fillable = ['cer_name', 'cer_owner', 'coach_id', 'course_id', 'cer_status', 'cer_price'];

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'cer_name',
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
