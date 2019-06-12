<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content', 'coach_id', 'active'];


    public function coach()
    {
        return $this->belongsTo('App\User');
    }
}
