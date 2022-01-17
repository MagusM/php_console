<?php

//2 params : 1 -> name of file, 2->year
//2 times salary each month, NOT on weekends!!!!!!!

include("DateHandler.php");
include("CsvHandler.php");

class SalaryDateUtil
{
    public function generate($fileName = null, $year = null)
    {
        $dateHandler = new DateHandler();
        $dateHandler->setYear($year);
        $dateHandler->calcLastBasePayDay();
        $dateHandler->calcLastBonusPayDay();

        //CsvHandler
        $csvHandler = new CsvHandler(
            is_null($fileName) ?
                'payment_report_' . $dateHandler->getYear() :
                $fileName
        );
        $filePointer = $csvHandler->createFile();
        if (!$filePointer) {
            exit("Failed to create file");
        }
        print_r('file created');
        fputcsv($filePointer, $csvHandler->getCSVHeaders());
        for ($i = 1; $i < 13; $i++) {
            $array = [
                DateTime::createFromFormat("!m", $i)->format('F'),
                $dateHandler->lastBasePayDay[$i][0] . "/" . $dateHandler->lastBasePayDay[$i][1],
                $dateHandler->lastBonusPayDay[$i][0] . "/" . $dateHandler->lastBonusPayDay[$i][1]
            ];
            fputcsv($filePointer, $array);
        }
    }
}

$salaryDateUtil = new SalaryDateUtil();
try {
    $salaryDateUtil->generate(null, 2020);
} catch (Exception $e) {
    print_r('please enter file name in string');
}
