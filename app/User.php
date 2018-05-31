<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

    protected $fillable = ['email', 'password', 'role'];

    /**
     * Get the teacher object associated
     * @return \App\Teacher
     */
    public function teacher(){
        return $this->hasOne('App\Teacher');
    }

    public function mentor(){
        return $this->hasOne('App\Mentor');
    }

    public function posters(){
        return $this->hasMany('App\Poster');
    }
}
