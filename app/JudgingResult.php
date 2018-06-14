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
 * Class JudgingResult
 * @package App
 */
class JudgingResult extends Model
{
    /**
     * Get parent poster submission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo('App\Poster');
    }

    /**
     * Get parent user (judge)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
