<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function forum_posts(){
        return $this->hasMany('App\ForumPost');
    }

    public function forum_channel(){
        return $this->belongsTo('App\ForumChannel');
    }
}
