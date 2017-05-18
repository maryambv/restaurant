<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 5/17/17
 * Time: 11:26 PM
 */

namespace App\Utils\Calendar;


use Morilog\Jalali\jDateTime;


class MyCalendar
{
    protected $calendar;

    /**
     * MyCalendar constructor.
     */
    public function __construct()
    {
        $this->calendar = new jDateTime(true, true, 'Asia/Tehran');
    }

    public function today()
    {

        return $this->calendar->date("l j F Y ");
    }

    public function weekDays()
    {
        $day = $this->calendar->date("w");
        $passDays = [];
        for ($i = 0; $i < intval($day); $i++) {
            $passDays[$i] = $this->calendar->getWeekName($i);
        }
        return $passDays;
    }

}
