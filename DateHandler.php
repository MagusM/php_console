<?php

class DateHandler
{

    /**
     * @var array | 0->day as a number, 1->day name
     */
    private $lastBasePayDay;

    /**
     * @var array | 0->day as a number, 1->day name
     */
    private $lastBonusPayDay;

    /**
     * @var int | year
     */
    public $year;

    function __construct($year = null)
    {
        if (is_null($year)) {
            $this->year = date("Y");
        } else {
            $this->year = $year;
        }

        $this->lastBasePayDay = $this->calcPayDay();
        $this->lastBonusPayDay = $this->calcPayDay(true);
    }

    public function calcPayDay($isBonus = false)
    {
        $arrayToReturn = array();

        for ($i = 1; $i < 13; $i++) {
            $arrayToReturn[$i] = $this->getPayDayArray($i, $isBonus ? 15 : null);
        }

        return $arrayToReturn;
    }

    public function getPayDayArray($month, $day = null)
    {
        if (is_null($day)) {
            $dayNum = cal_days_in_month(CAL_GREGORIAN, $month, $this->year);
        } else {
            $dayNum = $day;
        }

        $timestamp = sprintf("%s-%s-%s", $this->year, $month, $dayNum);

        @$dayName = date('D', strtotime($timestamp));
        switch ($dayName) {
            case "Sat":
                $dayNum -= 2;
                break;
            case 'Fri':
                $dayNum -= 1;
                break;
        }
        @$dayName = date('D', strtotime($timestamp));


        return array($dayNum, $dayName);
    }

    public function getYear()
    {
        return $this->year;
    }
}
