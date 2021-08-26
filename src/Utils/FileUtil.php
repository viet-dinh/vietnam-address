<?php

namespace Tool\Utils;

use Tool\Modules\ExcelModule\CustomReader;
use Tool\Modules\ExcelModule\ExcelModule;
use Tool\Modules\ExcelModule\Utils\EscapeUtil;

class FileUtil
{
    public static function parseFileToArray($filePath)
    {
        $fileString = file_get_contents($filePath);
        return json_decode($fileString,true);
    }

    /**
     * @param $filePath
     */
    public static function getDataFromExcel($filePath)
    {
        $spreadsheet = ExcelModule::getInstance()->getExcelHandler()->getSpreadsheet($filePath);

        $provinces = [];
        foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $row) {
            //ignore title
            if ($row->getRowIndex() == 1)
                continue;

            $provinceName = null;
            $districtName = null;
            foreach ($row->getCellIterator() as $cell) {
                if ($cell->getColumn() === CustomReader::PROVINCE_COLUMN) {
                    $provinceName = EscapeUtil::escapeProvinceName($cell->getValue());
                }

                if ($cell->getColumn() === CustomReader::DISTRICT_COLUMN) {
                    $districtName = EscapeUtil::escapeDistrictName($cell->getValue());
                }

                if ($cell->getColumn() === CustomReader::WARD_COLUMM) {
                    if (!$cell->getValue()) {
                        //Huyện không có xã -> Cấp nhỏ nhất là huyện VD: Bạch Long Vĩ - Hải Phòng
                        $provinces[$provinceName][$districtName] = [];
                    } else {
                        $provinces[$provinceName][$districtName][] = EscapeUtil::escapeWardName($cell->getValue());
                    }
                }
            }
        }

        SortVNUtil::ksort($provinces);

        foreach ($provinces as &$districts) {
            SortVNUtil::ksort($districts);

            foreach ($districts as &$wards) {
                SortVNUtil::sort($wards);
            }
        }

        return $provinces;
    }
}