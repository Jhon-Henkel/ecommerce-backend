<?php

namespace tests\Traits;

use src\DTO\ShippingPackageDTO;

trait ShippingPackageTraits
{
    public function makeDtoShippingPackage(): ShippingPackageDTO
    {
        $package = new ShippingPackageDTO();
        $package->setWidth(10);
        $package->setLength(15);
        $package->setHeight(20);
        $package->setGrossWeight(1);
        return $package;
    }
}