<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','text','image'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $dates = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    public function user(){

        return $this->belongsTo(User::class,'user_id');

    }
}
