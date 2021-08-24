<?php

namespace Tool\Modules\AddressModule\District;

use Tool\Modules\AddressModule\Province\ProvinceInterface;
use Tool\Modules\AddressModule\RepositoryInterface;

interface DistrictRepositoryInterface extends RepositoryInterface
{
    CONST ROOT_PATH = self::DATA_PATH . '/quan-huyen/';

    /**
     * @return DistrictInterface[]
     */
    public function getDistrictsByProVince(ProvinceInterface $province): array;
}