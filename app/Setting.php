<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['site_name', 'logo', 'icon', 'about_content', 'about_image', 'trainer_privacy',
        'coach_privacy', 'facebook', 'twitter', 'linkedin', 'percent', 'reply_msg'];
}
