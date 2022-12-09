<?php

namespace Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\BrandDTO;
use src\Factory\BrandDtoFactory;

class BrandDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdBrand;
    public BrandDTO $dtoBrand;

    protected function setUp(): void
    {
        $this->stdBrand = $this->makeStdBrand();
        $this->dtoBrand = $this->makeDtoBrand();
    }

    public function testMakePublic()
    {
        $publicBrand = BrandDtoFactory::makePublic($this->dtoBrand);
        $this->assertInstanceOf(\stdClass::class, $publicBrand);
        $this->assertEquals(123, $publicBrand->id);
        $this->assertEquals('unit test dto brand', $publicBrand->name);
        $this->assertEquals('unit-test-dto-brand', $publicBrand->code);
    }

    public function testFactory()
    {
        $factored = BrandDtoFactory::factory($this->stdBrand);
        $this->assertInstanceOf(BrandDTO::class, $factored);
        $this->assertEquals(789, $factored->getId());
        $this->assertEquals('unit test std brand', $factored->getName());
        $this->assertEquals('unit-test-std-brand', $factored->getCode());
    }

    public function makeStdBrand(): \stdClass
    {
        $brand = new \stdClass();
        $brand->id = 789;
        $brand->name = 'unit test std brand';
        $brand->code = 'unit-test-std-brand';
        return $brand;
    }

    public function makeDtoBrand(): BrandDTO
    {
        $brand = new BrandDTO();
        $brand->setId(123);
        $brand->setName('unit test dto brand');
        $brand->setCode('unit-test-dto-brand');
        return $brand;
    }
}