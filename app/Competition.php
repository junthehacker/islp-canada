<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public function judging_rules(){
        return $this->hasMany('App\JudgingRule');
    }

    public function posters(){
        return $this->hasMany('App\Poster');
    }
}
