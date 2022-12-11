<?php

namespace tests\Unit\Traits;

use src\DTO\BrandDTO;

trait BrandTraits
{
    public function makeDtoBrandTest99(): BrandDTO
    {
        $brand = new BrandDTO();
        $brand->setId(99);
        $brand->setName('Brand Test');
        $brand->setCode('brand-test-99');
        return $brand;
    }
}