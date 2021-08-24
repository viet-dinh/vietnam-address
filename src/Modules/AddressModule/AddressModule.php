<?php

namespace Tool\Modules\AddressModule;

use Tool\Modules\AbstractModule;
use Tool\Modules\AddressModule\District\DistrictRepository;
use Tool\Modules\AddressModule\District\DistrictRepositoryInterface;
use Tool\Modules\AddressModule\Province\ProvinceRepositoryInterface;
use Tool\Modules\AddressModule\Ward\WardRepositoryInterface;

class AddressModule extends AbstractModule
{
    private ProvinceRepositoryInterface $provinceRepository;
    private DistrictRepository $districtRepository;
    private WardRepositoryInterface $wardRepository;

    public function getProvinceRepository(): ProvinceRepositoryInterface
    {
        return $this->provinceRepository;
    }

    public function getDistrictRepository(): DistrictRepositoryInterface
    {
        return $this->districtRepository;
    }

    public function getWardRepository(): WardRepositoryInterface
    {
        return $this->wardRepository;
    }
    
    /**
     * @param RepositoryInterface $repository
     */
    public function implement(RepositoryInterface $repository)
    {
        if ($repository instanceof ProvinceRepositoryInterface)
            $this->provinceRepository = $repository;

        elseif ($repository instanceof DistrictRepositoryInterface)
            $this->districtRepository = $repository;

        elseif ($repository instanceof WardRepositoryInterface)
            $this->wardRepository = $repository;

        else
            throw new \LogicException('went wrong');
    }
}