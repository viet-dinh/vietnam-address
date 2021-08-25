<?php

namespace Tool\Modules\AddressModule\District;

use Tool\Modules\AddressModule\Province\ProvinceInterface;
use Tool\Utils\FileUtil;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function getDistrictsByProVince(ProvinceInterface $province): array
    {
        $filePath = self::ROOT_PATH . $province->getCode() . self::DATA_EXTENSION;

        $arrayDistrictData = FileUtil::parseFileToArray($filePath);

        $result = [];

        foreach ($arrayDistrictData as $districtData)
            $result[] = District::createFromData($districtData);

        return $result;
    }
}