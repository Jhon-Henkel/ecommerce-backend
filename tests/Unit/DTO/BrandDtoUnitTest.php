<?php

namespace Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\BrandDTO;

class BrandDtoUnitTest extends TestCase
{
    public object $brand;

    protected function setUp(): void
    {
        $this->brand = new BrandDTO();
    }

    public function testGetterAndSettersBrand()
    {
        $this->brand->setId(123);
        $this->brand->setCode('brand-1');
        $this->brand->setName('test brand');
        $this->assertEquals(123, $this->brand->getId());
        $this->assertEquals('brand-1', $this->brand->getCode());
        $this->assertEquals('test brand', $this->brand->getName());
    }
}