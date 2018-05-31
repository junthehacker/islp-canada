<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JudgingRule extends Model
{
    //

    protected $fillable = ['name', 'description', 'score', 'weight', 'group'];
}
