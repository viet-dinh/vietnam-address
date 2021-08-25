<?php

require __DIR__ . '/../Autoload.php';

use Tool\Modules\ExcelModule\ExcelModule;
use Tool\Modules\ExcelModule\Handlers\ExcelHandler;
use Tool\Utils\FileUtil;

$excelHandler = new ExcelHandler();
ExcelModule::getInstance()->implement($excelHandler);

$filePath = RootDir . '/data/original-excel/25_08_2021.xls';

$data = FileUtil::getDataFromExcel($filePath);

//write file
file_put_contents(RootDir . '/output/vn-address.json', json_encode($data));
