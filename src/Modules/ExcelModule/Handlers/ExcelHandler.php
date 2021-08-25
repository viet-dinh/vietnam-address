<?php

namespace Tool\Modules\ExcelModule\Handlers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Tool\Modules\ExcelModule\CustomReader;

class ExcelHandler implements ExcelHandlerInterface
{
    CONST ACCEPTABLE_FILE_TYPES = ['Xls', 'Xlsx'];

    /**
     * @throws Exception
     */
    public function getSpreadsheet(string $filePath): Spreadsheet
    {
        $inputFileType = IOFactory::identify($filePath);

        if (!in_array($inputFileType, self::ACCEPTABLE_FILE_TYPES))
            throw new Exception('Not support data file extension: ' . $inputFileType);

        $reader = IOFactory::createReader($inputFileType);

        /**  Load only the rows and columns that match our filter to CustomReader **/
        $reader->setReadFilter(new CustomReader());

        return $reader->load($filePath);
    }
}