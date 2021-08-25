<?php

namespace Tool\Modules\ExcelModule;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class CustomReader implements IReadFilter
{
    CONST MIN_ROW_NUMBER = 1;
    CONST MAX_ROW_NUMBER = 20000;
    CONST FROM_COLUMN_CHAR = 'A';
    CONST TO_COLUMN_CHAR = 'H';

    CONST PROVINCE_COLUMN = 'A';
    CONST DISTRICT_COLUMN = 'C';
    CONST WARD_COLUMM = 'E';

    public function readCell($column, $row, $worksheetName = '') {
        //  Read rows 1 to 7 and columns A to E only
        if ($row >= self::MIN_ROW_NUMBER && $row <= self::MAX_ROW_NUMBER) {
            if (in_array($column, range(self::FROM_COLUMN_CHAR,self::TO_COLUMN_CHAR))) {
                return true;
            }
        }
        return false;
    }
}