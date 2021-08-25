<?php

namespace Tool\Modules\ExcelModule;

use Tool\Modules\AbstractModule;
use Tool\Modules\ExcelModule\Handlers\ExcelHandlerInterface;

class ExcelModule extends AbstractModule
{
    private ExcelHandlerInterface $excelHandler;

    public function getExcelHandler(): ExcelHandlerInterface
    {
        return $this->excelHandler;
    }

    public function implement(HandlerInterface $handler)
    {
        if ($handler instanceof ExcelHandlerInterface)
            $this->excelHandler = $handler;
        else
            throw new \LogicException('went wrong');
    }
}