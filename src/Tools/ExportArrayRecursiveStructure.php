<?php

require __DIR__ . '/../Autoload.php';

use Tool\Modules\AddressModule\AddressModule;
use Tool\Modules\AddressModule\Province\ProvinceRepository;
use Tool\Modules\AddressModule\District\DistrictRepository;
use Tool\Modules\AddressModule\Ward\WardRepository;

$addressModule = AddressModule::getInstance();

$provinceRepository = new ProvinceRepository();
$districtRepository = new DistrictRepository();
$wardRepository = new WardRepository();

$addressModule = AddressModule::getInstance();
$addressModule->implement($provinceRepository);
$addressModule->implement($districtRepository);
$addressModule->implement($wardRepository);

//make data structure recursive
$output['items'] = [];

$allProvinces = $addressModule->getProvinceRepository()->getAll();

foreach ($allProvinces as $province) {
    $districtDatas = [];

    $districts = $addressModule->getDistrictRepository()->getDistrictsByProVince($province);
    foreach ($districts as $district) {
        $wards = $addressModule->getWardRepository()->getWardsByDistrict($district);
        foreach ($wards as $ward) {
            $districtDatas[$district->getName()][] = $ward->getName();
        }
    }

    $output['items'][$province->getName()] = $districtDatas;
}

//write file
file_put_contents(RootDir . '/output/vn-address.json', json_encode($output));
