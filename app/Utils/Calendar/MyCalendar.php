<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 5/17/17
 * Time: 11:26 PM
 */

namespace App\Utils\Calendar;


use Carbon\Carbon;


class MyCalendar extends Carbon
{
    protected $time;

    public function __construct($time = null, $tz = null)
    {
        parent::__construct($time, $tz);
    }

//    public function mToday()
//    {
//        return $this->time;
//    }

}