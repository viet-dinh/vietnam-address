<?php

namespace Tool\Modules\AddressModule;

abstract class AbstractUnit implements UnitInterface
{
    private string $code;
    private string $name;

    public static function createFromData($data): AbstractUnit
    {
        $unit = new static();

        $unit->setCode($data['code'] ?? '');
        $unit->setName($data['name'] ?? '');

        if (isset($data['parent_code'])) {
            $unit->setParentCode($data['parent_code']);
        }

        return $unit;
    }

    /**
     * @var string|null
     */
    private $parentCode;

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setParentCode($parentCode)
    {
        $this->parentCode = $parentCode;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentCode(): ?string
    {
        return $this->parentCode;
    }
}