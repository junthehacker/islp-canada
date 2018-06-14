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
 * Class Poster
 * @package App
 */
class Poster extends Model
{
    /**
     * Get parent user (teacher)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get parent competition
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }

    /**
     * Get all results
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function judging_results()
    {
        return $this->hasMany('App\JudgingResult');
    }
}
