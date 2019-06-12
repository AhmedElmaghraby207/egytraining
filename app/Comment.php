<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'user_id', 'course_id', 'lecture_id', 'active'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Lecture');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
