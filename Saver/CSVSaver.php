<?php

namespace Saver;

use Exception\CsvException;

/**
 * Class CSVSaver
 * @package Saver
 */
class CSVSaver implements SaverInterface
{
    /**
     * @var resource
     */
    private $file;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @param string $fileName
     * @throws CsvException
     */
    public function openFile(string $fileName)
    {
        $this->fileName = $fileName;
        $this->file = fopen($fileName, 'a+');
        if ($this->file === false) {
            throw new CsvException('File '. $fileName. ' open failed check file name and try again later');
        }
    }

    /**
     * @param array $array
     * @throws CsvException
     */
    public function save(array $array)
    {
        foreach ($array as $value) {
            $result = fputcsv($this->file, $value);
            if (!$result) {
                throw new CsvException('File '. $this->fileName. ' save failed please try again later');
            }
        }
    }

    /**
     * @throws CsvException
     */
    public function closeFile()
    {
        $result = fclose($this->file);
        if ($result === false) {
            throw new CsvException('File '. $this->fileName. ' close failed try again later');
        }
    }
}