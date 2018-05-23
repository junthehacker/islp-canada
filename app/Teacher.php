<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'teaching_subject', 'school', 'heard_from', 'additional_resources'];
}
