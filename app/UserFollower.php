<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{

    protected $fillable = [
        'user_id','follower_id'
    ];

    protected $hidden = [
         'created_at', 'updated_at'
    ];

    protected $dates = [
         'created_at', 'updated_at',
    ];
}
