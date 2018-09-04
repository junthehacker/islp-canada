<?php
/**
 * Author: Jun Zheng (me@jackzh.com)
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
        return $this->hasMany('App\Poster')->orderByDesc('created_at');
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

    /**
     * Return if this is a teacher account
     * @return bool
     */
    public function isTeacher(){
        return $this->role === 1;
    }
}
