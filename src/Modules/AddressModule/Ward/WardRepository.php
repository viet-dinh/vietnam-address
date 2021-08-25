<?php

namespace Tool\Modules\AddressModule\Ward;

use Tool\Modules\AddressModule\District\DistrictInterface;
use Tool\Utils\FileUtil;

class WardRepository implements WardRepositoryInterface
{
    public function getWardsByDistrict(DistrictInterface $district): array
    {
        $filePath = self::ROOT_PATH . $district->getCode() . self::DATA_EXTENSION;

        $arrayWardData = FileUtil::parseFileToArray($filePath);
        $result = [];

        if (!is_array($arrayWardData)) {
            // data source fail
            echo "District: " . $district->getName() . " has no ward" . PHP_EOL;
            return [];
        }

        foreach ($arrayWardData as $wardData)
            $result[] = Ward::createFromData($wardData);

        return $result;
    }
}