<?php

namespace Tool\Modules\AddressModule\Ward;

use Tool\Modules\AddressModule\District\DistrictInterface;
use Tool\Modules\AddressModule\RepositoryInterface;

interface WardRepositoryInterface extends RepositoryInterface
{
    CONST ROOT_PATH = self::DATA_PATH . '/xa-phuong/';

    /**
     * @return WardInterface[]
     */
    public function getWardsByDistrict(DistrictInterface $district): array;
}