<?php

namespace Tool\Modules\AddressModule;

interface UnitInterface
{
    public function getCode(): string;

    public function getName(): string;

    public function getParentCode(): ?string;
}