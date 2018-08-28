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

    /**
     * Get human readable status name
     * @return string
     */
    public function getStatusName(){
        switch($this->status) {
            case "new":
                return "New Competition";
                break;
            case "accept_submissions":
                return "Accept Submissions";
                break;
            case "submission_closed":
                return "Submission Closed";
                break;
            case "begin_judging":
                return "Begin Judging";
                break;
            case "judging_finished":
                return "Judging Finished";
                break;
            case "result_announced":
                return "Result Announced";
                break;
            case "over":
                return "Over";
                break;
            case "archived":
                return "Archived";
                break;
            default:
                return "Unknown";
                break;
        }
    }

    /**
     * Get human readable next status name
     * @return string
     */
    public function getNextStatusName(){
        switch($this->status) {
            case "new":
                return "Accept Submissions";
                break;
            case "accept_submissions":
                return "Submission Closed";
                break;
            case "submission_closed":
                return "Begin Judging";
                break;
            case "begin_judging":
                return "Judging Finished";
                break;
            case "judging_finished":
                return "Result Announced";
                break;
            case "result_announced":
                return "Over";
                break;
            case "over":
                return "None";
                break;
            default:
                return "Unknown";
                break;
        }
    }

    /**
     * Return next status code
     * @return string
     */
    public function getNextStatus() {
        switch($this->status) {
            case "new":
                return "accept_submissions";
                break;
            case "accept_submissions":
                return "submission_closed";
                break;
            case "submission_closed":
                return "begin_judging";
                break;
            case "begin_judging":
                return "judging_finished";
                break;
            case "judging_finished":
                return "result_announced";
                break;
            case "result_announced":
                return "over";
                break;
            case "over":
                return "none";
                break;
            default:
                return "unknown";
                break;
        }
    }

    /**
     * Get human readable previous status name
     * @return string
     */
    public function getPrevStatusName(){
        switch($this->status) {
            case "new":
                return "None";
                break;
            case "accept_submissions":
                return "New";
                break;
            case "submission_closed":
                return "Accept Submissions";
                break;
            case "begin_judging":
                return "Submission Closed";
                break;
            case "judging_finished":
                return "Begin Judging";
                break;
            case "result_announced":
                return "Judging Finished";
                break;
            case "over":
                return "Result Announced";
                break;
            default:
                return "Unknown";
                break;
        }
    }

    /**
     * Return next status code
     * @return string
     */
    public function getPrevStatus() {
        switch($this->status) {
            case "new":
                return "none";
                break;
            case "accept_submissions":
                return "new";
                break;
            case "submission_closed":
                return "accept_submissions";
                break;
            case "begin_judging":
                return "submission_closed";
                break;
            case "judging_finished":
                return "begin_judging";
                break;
            case "result_announced":
                return "judging_finished";
                break;
            case "over":
                return "result_announced";
                break;
            default:
                return "unknown";
                break;
        }
    }

    /**
     * Return true if specified status code has already been passed
     * @param $status
     * @return bool
     */
    public function hasStatusPassed($status){
        if($this->status === 'accept_submissions') {
            if($status === 'new') return true;
        }
        if($this->status === 'submission_closed') {
            if($status === 'new') return true;
            if($status === 'accept_submissions') return true;
        }
        if($this->status === 'begin_judging') {
            if($status === 'new') return true;
            if($status === 'accept_submissions') return true;
            if($status === 'submission_closed') return true;
        }
        if($this->status === 'judging_finished') {
            if($status === 'new') return true;
            if($status === 'accept_submissions') return true;
            if($status === 'submission_closed') return true;
            if($status === 'begin_judging') return true;
        }
        if($this->status === 'result_announced') {
            if($status === 'new') return true;
            if($status === 'accept_submissions') return true;
            if($status === 'submission_closed') return true;
            if($status === 'begin_judging') return true;
            if($status === 'judging_finished') return true;
        }
        if($this->status === 'over') {
            if($status === 'new') return true;
            if($status === 'accept_submissions') return true;
            if($status === 'submission_closed') return true;
            if($status === 'begin_judging') return true;
            if($status === 'judging_finished') return true;
            if($status === 'result_announced') return true;
        }
        return false;
    }

    /**
     * Get current status percentage, used to display status progress bar
     * @return float|int
     */
    public function getCurrentStatusProgressPercentage(){
        if($this->status === 'new') {
            return 0;
        } else if($this->status === 'accept_submissions') {
            return 16.666666666666667;
        } else if($this->status === 'submission_closed') {
            return 16.666666666666667*2;
        } else if($this->status === 'begin_judging') {
            return 16.666666666666667*3;
        } else if($this->status === 'judging_finished') {
            return 16.666666666666667*4;
        } else if($this->status === 'result_announced') {
            return 16.666666666666667*5;
        } else if($this->status === 'over') {
            return 100;
        }
        return 0;
    }

    /**
     * Return if this competition can accept submissions
     * @return bool
     */
    public function acceptSubmissions(){
        return $this->status === 'accept_submissions';
    }
}
