<?php

class DateHandler
{

    /**
     * @var array | 0->day as a number, 1->day name
     */
    public $lastBasePayDay;

    /**
     * @var array | 0->day as a number, 1->day name
     */
    public $lastBonusPayDay;

    /**
     * @var int | year
     */
    private $year;

    public function calcLastBasePayDay()
    {
        $this->lastBasePayDay = $this->calcPayDay();
    }

    public function calcLastBonusPayDay()
    {
        $this->lastBonusPayDay = $this->calcPayDay(true);
    }

    /**
     * @var bool
     * 
     * if false -> return calc of end of month
     * if true -> return calc of bonus
     */
    private function calcPayDay($isBonus = false)
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

        @$dayName = date('D', strtotime(sprintf("%s-%s-%s", $this->year, $month, $dayNum)));
        switch ($dayName) {
            case "Sat":
                $dayNum -= 2;
                break;
            case 'Fri':
                $dayNum -= 1;
                break;
        }
        @$dayName = date('D', strtotime(sprintf("%s-%s-%s", $this->year, $month, $dayNum)));

        return array($dayNum, $dayName);
    }

    public function setYear($year = null)
    {
        if (empty($year)) {
            $this->year = date("Y");
        } else {
            $this->year = $year;
        }
    }

    public function getYear()
    {
        return $this->year;
    }
}
