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

class Week
{
    protected $days;

    /**
     * MyCalendar constructor.
     *
     * @param int $number
     */
    public function __construct($number)
    {
        $this->weekDays($number);
    }


    public function getDays()
    {
        return $this->days;
    }

    private function weekDays($num)
    {
        $num *= 7;
        for ($i = 1; $i < 7; $i++) {
            $day = Carbon::now()->addDay($i + $num);
            $day = new Day($day);
            $this->days [$i] = $day->convertToJalali();
        }

    }

}
