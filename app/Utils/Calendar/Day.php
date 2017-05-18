<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 5/17/17
 * Time: 11:26 PM
 */

namespace App\Utils\Calendar;




use Jenssegers\Date\Date;

class Day
{
    protected $day;

    /**
     * MyCalendar constructor.
     */
    public function __construct($day)
    {

        $this->day = Date::now()->format('l j F Y H:i:s'); ;
    }

    public function today()
    {

        return $this->day;
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
