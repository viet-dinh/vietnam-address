<?php

namespace Tool\Modules\AddressModule\Province;

use Tool\Utils\FileUtil;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    /**
     * @return Province[]
     */
    public function getAll(): array
    {
        $arrayProvinceData = FileUtil::parseFileToArray(self::ROOT_PATH);

        $result = [];

        foreach ($arrayProvinceData as $provinceData)
            $result[] = Province::createFromData($provinceData);

        return $result;
    }
}