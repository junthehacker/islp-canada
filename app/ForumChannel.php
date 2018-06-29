<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumChannel extends Model
{
    public function forum_posts(){
        return $this->hasMany('App\ForumPost')->orderByDesc('updated_at');
    }
}
