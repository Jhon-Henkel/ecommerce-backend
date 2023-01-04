<?php

namespace tests\Traits;

use src\DTO\BrandDTO;
use stdClass;

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

    public function makeStdBrandTest99(): stdClass
    {
        $brand = new stdClass();
        $brand->id = 99;
        $brand->name = 'Brand Test Feature Test 99';
        $brand->code = 'brand-test-99';
        return $brand;
    }

    public function makeStdBrandTest98(): stdClass
    {
        $brand = new stdClass();
        $brand->id = 98;
        $brand->name = 'Brand Test Feature Test 98';
        $brand->code = 'brand-test-98';
        return $brand;
    }
}