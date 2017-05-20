<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 5/17/17
 * Time: 11:26 PM
 */

namespace App\Utils\Calendar;

use Carbon\Carbon;
use App\Utils\Calendar\Day;
use App\Utils\Calendar\Week;


class MyCalendar
{
    protected $calendar;

    /**
     * MyCalendar constructor.
     */
    public function __construct()
    {

    }

    public static function today()
    {
        $today = Carbon::now();
        $day = new Day($today);
        return $day->convertToJalali();
    }

    public function week($state = 0)
    {
        $week = new Week($state);
        return $week->getDays();
    }

    public static function addDay($number)
    {
        $day = Carbon::now()->addDay($number + 1);
        $newDay = new Day($day);
        return $newDay->convertToJalali();
    }

}
