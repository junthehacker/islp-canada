<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

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

    public function judging_results(){
        return $this->hasMany('App\JudgingResult');
    }
}
