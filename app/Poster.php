<?php
/**
 * Author: Jun Zheng (me@jackzh.com)
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

    /**
     * Get human readable group name
     * @return string
     */
    public function getGroupName()
    {
        switch($this->group) {
            case "lower_secondary":
                return "Lower Secondary";
            case "upper_secondary":
                return "Upper Secondary";
            case "undergraduate":
                return "Undergraduate";
            default:
                return "Unknown";
        }
    }
}
