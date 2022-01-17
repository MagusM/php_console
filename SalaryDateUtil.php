<?php

//2 params : 1 -> name of file, 2->year
//2 times salary each month, NOT on weekends!!!!!!!

include("DateHandler.php");
include("CsvHandler.php");

class SalaryDateUtil
{


    public $salaryDates;
    public $bonusDates;

    //TODO: expose $csvHandler->getCSVHeaders() in a function to index.php

    public function generate($fileName = null, $year = null)
    {
        $dateHandler = new DateHandler();
        $dateHandler->setYear($year);
        $dateHandler->calcLastBasePayDay();
        $dateHandler->calcLastBonusPayDay();

        $this->salaryDates = $dateHandler->lastBasePayDay;
        $this->bonusDates = $dateHandler->lastBonusPayDay;

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
        fputcsv($filePointer, $csvHandler->getCSVHeaders());
        for ($i = 1; $i < 13; $i++) {
            $array = [
                $i,
                $dateHandler->lastBasePayDay[$i][1] . ", " . $dateHandler->lastBasePayDay[$i][0],
                $dateHandler->lastBonusPayDay[$i][1] . ", " . $dateHandler->lastBasePayDay[$i][0]
            ];
            fputcsv($filePointer, $array);
        }
    }
}




// $salaryDateUtil = new SalaryDateUtil();
// try {
//     $salaryDateUtil->generate(null, 2020);
// } catch (Exception $e) {
//     print_r('please enter file name in string');
// }
