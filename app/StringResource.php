<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StringResource extends Model
{
    protected $fillable = ['identifier', 'content_en', 'content_fr'];
}
