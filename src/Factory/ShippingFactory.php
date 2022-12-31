<?php

namespace src\Factory;

use src\DTO\ShippingCalculatedDTO;
use src\DTO\ShippingPackageDTO;
use src\Enums\ShippingCorreiosEnum;
use src\Enums\ShippingEnum;
use src\Tools\StringTools;

class ShippingFactory
{
    public function getShippingCalculatedCorreios(ShippingPackageDTO $package, $calculation): ShippingCalculatedDTO
    {
        $packageCalculation = new ShippingCalculatedDTO();
        $packageCalculation->setShippingCompany(ShippingEnum::SHIPPING_COMPANY_CORREIOS);
        $packageCalculation->setServiceType(ShippingCorreiosEnum::getDescriptionFromCode((int)$calculation->Codigo));
        $packageCalculation->setDeliveryTimeInDays((int)$calculation->PrazoEntrega);
        $packageCalculation->setPrice(StringTools::priceFloatConvert($calculation->Valor));
        $packageCalculation->setWidth($package->getWidth());
        $packageCalculation->setHeight($package->getHeight());
        $packageCalculation->setLength($package->getLength());
        $packageCalculation->setGrossWeight($package->getGrossWeight());
        return $packageCalculation;
    }
}