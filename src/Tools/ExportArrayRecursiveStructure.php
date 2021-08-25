<?php

require __DIR__ . '/../Autoload.php';

/**
 * Deprecated (because use data source third party). Should use tool ExportArrayRecursiveStructureUseMXLSource
 */

use Tool\Modules\AddressModule\AddressModule;
use Tool\Modules\AddressModule\Province\ProvinceRepository;
use Tool\Modules\AddressModule\District\DistrictRepository;
use Tool\Modules\AddressModule\Ward\WardRepository;

$provinceRepository = new ProvinceRepository();
$districtRepository = new DistrictRepository();
$wardRepository = new WardRepository();

AddressModule::getInstance()->implement($provinceRepository);
AddressModule::getInstance()->implement($districtRepository);
AddressModule::getInstance()->implement($wardRepository);

//make data structure recursive
$output['items'] = [];

$allProvinces = AddressModule::getInstance()->getProvinceRepository()->getAll();

foreach ($allProvinces as $province) {
    $districtDatas = [];

    $districts = AddressModule::getInstance()->getDistrictRepository()->getDistrictsByProVince($province);
    foreach ($districts as $district) {
        $wards = AddressModule::getInstance()->getWardRepository()->getWardsByDistrict($district);
        foreach ($wards as $ward) {
            $districtDatas[$district->getName()][] = $ward->getName();
        }
    }

    $output['items'][$province->getName()] = $districtDatas;
}

//write file
file_put_contents(RootDir . '/output/vn-address.json', json_encode($output));
