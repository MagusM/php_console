<?php

class CsvHandler
{
    private $filaName;
    private $filePointer;
    private $path;

    function __construct($filaName)
    {
        if (!is_string($filaName)) {
            throw new Exception('File name must be of type string', 500);
        }
        $this->filaName = $filaName;
        $this->path = $this->getTempPath();
    }

    private function getTempPath()
    {
        return getcwd() . "/payment/";
    }

    public function getFullFileName()
    {
        return $this->filaName . ".csv";
    }

    public function getFilePath()
    {
        return $this->path;
    }

    public function createFile()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }
        $pathAndFileName = $this->path . $this->getFullFileName();
        $this->filePointer = fopen($pathAndFileName, "a+");

        return $this->filePointer;
    }

    public function getCSVHeaders()
    {
        return [
            'Month Name',
            'Salary Payment Date',
            'Bonus Payment Date'
        ];
    }
}
