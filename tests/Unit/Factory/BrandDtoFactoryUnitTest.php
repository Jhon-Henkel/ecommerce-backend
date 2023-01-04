<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\BrandDTO;
use src\Factory\BrandDtoFactory;

class BrandDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdBrand;
    public BrandDTO $dtoBrand;
    public array $dbBrand;
    public BrandDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdBrand = $this->makeStdBrand();
        $this->dtoBrand = $this->makeDtoBrand();
        $this->dbBrand = $this->makeArrayBrandDb();
        $this->factory = new BrandDtoFactory();
    }

    public function testMakePublic()
    {
        $publicBrand = $this->factory->makePublic($this->dtoBrand);
        $this->assertInstanceOf(\stdClass::class, $publicBrand);
        $this->assertEquals(123, $publicBrand->id);
        $this->assertEquals('unit test dto brand', $publicBrand->name);
        $this->assertEquals('unit-test-dto-brand', $publicBrand->code);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdBrand);
        $this->assertInstanceOf(BrandDTO::class, $factored);
        $this->assertEquals(789, $factored->getId());
        $this->assertEquals('unit test std brand', $factored->getName());
        $this->assertEquals('unit-test-std-brand', $factored->getCode());
    }

    public function testPopulateDbToDto()
    {
        $brand = $this->factory->populateDbToDto($this->dbBrand);
        $this->assertInstanceOf(BrandDTO::class, $brand);
        $this->assertEquals(123, $brand->getId());
        $this->assertEquals('Brand Test', $brand->getName());
        $this->assertEquals('brand-test', $brand->getCode());
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
        $brand->setCreatedAt(null);
        $brand->setUpdatedAt(null);
        return $brand;
    }

    public function makeArrayBrandDb(): array
    {
        $item = array();
        $item['brand_id'] = 123;
        $item['brand_name'] = 'Brand Test';
        $item['brand_code'] = 'brand-test';
        $item['brand_created_at'] = null;
        $item['brand_updated_at'] = null;
        return $item;
    }
}