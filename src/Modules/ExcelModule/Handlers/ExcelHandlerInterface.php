<?php

namespace Tool\Modules\ExcelModule\Handlers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Tool\Modules\ExcelModule\HandlerInterface;

interface ExcelHandlerInterface extends HandlerInterface
{
    public function getSpreadsheet(string $filePath): Spreadsheet;
}