<?php
include('SalaryDateUtil.php');

$year = $_GET['year'];

$util = new SalaryDateUtil();
$util->generate(null, $year);

$salaryDates = $util->salaryDates;
$bonusDates = $util->bonusDates;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Here is the dates where you will receive your salary and bonus for year <?= $year ?></h1>
    <!-- create html table and put salary dates -->
</body>

</html>