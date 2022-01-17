<?php

//2 params : 1 -> name of file, 2->year
//2 times salary each month, NOT on weekends!!!!!!!

include("DateHandler.php");

class SalaryDateUtil
{
    public function generate($fileName = null, $year = null)
    {
        $dateHandler = new DateHandler();
        $dateHandler->setYear($year);
        $dateHandler->calcLastBasePayDay();
        $dateHandler->calcLastBonusPayDay();

        //CsvHandler

        //file
    }
}

// $obj = new SalaryDateUtil();
