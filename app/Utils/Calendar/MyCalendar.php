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
        $now = Carbon::now();
        $today = $now->dayOfWeek;
        $day = $day = $number - $today;
        if ($today > $number) {
            $day = $number - $today + 7;
        } else {
            $day = $number - $today;
        }
        $nextDay = $now->addDay($day);
        $newDay = new Day($nextDay);
        return $newDay->convertToJalali();
    }

}
