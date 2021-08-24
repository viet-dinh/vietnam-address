<?php

namespace Tool\Modules\AddressModule\Province;

use Tool\Modules\AddressModule\RepositoryInterface;

interface ProvinceRepositoryInterface extends RepositoryInterface
{
    CONST ROOT_PATH = self::DATA_PATH . '/tinh_tp.json';

    /**
     * @return ProvinceInterface[]
     */
    public function getAll(): array;
}