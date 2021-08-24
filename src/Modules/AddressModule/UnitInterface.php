<?php

namespace Tool\Modules\AddressModule;

use Tool\Modules\Common\RepositoryInterface;
use Tool\Modules\AddressModule\District\ProvinceRepository;
use Tool\Modules\AddressModule\District\ProvinceRepositoryInterface;
use Tool\Modules\AddressModule\Product\ProductRepository;
use Tool\Modules\AddressModule\Product\ProductRepositoryInterface;

interface UnitInterface
{
    public function getCode(): string;

    public function getName(): string;

    public function getParentCode(): ?string;
}