<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StringResource extends Model
{
    protected $fillable = ['identifier', 'content_en', 'content_fr'];

    static public function get($key){
        $resource = StringResource::where('identifier', $key)->first();
        if($resource){
            if(request()->input('lang') === 'fr'){
                return $resource['content_fr'];
            } else {
                return $resource['content_en'];
            }
        } else {
            return "";
        }
    }
}
