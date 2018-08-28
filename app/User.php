<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App
 */
class User extends Model
{

    /**
     * Fillable properties
     * @var array
     */
    protected $fillable = ['email', 'password', 'role'];


    /**
     * Get teacher (if role is teacher)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher(){
        return $this->hasOne('App\Teacher');
    }

    /**
     * Get mentor (if role is mentor)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mentor(){
        return $this->hasOne('App\Mentor');
    }

    /**
     * Get posters (if role is teacher)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posters(){
        return $this->hasMany('App\Poster');
    }

    /**
     * Get judging_results (if role is judge)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function judging_results(){
        return $this->hasMany('App\JudgingResult');
    }

    /**
     * Get human readable role names
     * @return mixed
     */
    public function getRoleName(){
        $roleNames = [
            0 => 'administrator',
            1 => 'teacher',
            2 => 'judge',
            3 => 'mentor'
        ];
        return $roleNames[$this->role];
    }
}
