<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 5/17/17
 * Time: 11:26 PM
 */

namespace App\Utils\Calendar;


use Morilog\Jalali\jDateTime;

class Day
{
    protected $day;

    /**
     * MyCalendar constructor.
     *
     * @param day $day
     */
    public function __construct($day)
    {
        $this->calendar = new jDateTime();
        $this->day = $day;
    }

    public function convertToJalali()
    {
        return $this->calendar->date("l j F ", $this->day, 'Asia/Tehran');
    }


}
