<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\ShippingCalculatedDTO;
use src\DTO\ShippingPackageDTO;
use src\Factory\ShippingFactory;
use stdClass;
use tests\Traits\ProductStockTrait;
use tests\Traits\ShippingCorreiosCalculateTraits;
use tests\Traits\ShippingPackageTraits;

class ShippingFactoryUnitTest extends TestCase
{
    use ShippingPackageTraits, ShippingCorreiosCalculateTraits, ProductStockTrait;

    public ShippingFactory $factory;
    public stdClass $correiosCalculated;
    public ShippingPackageDTO $package;

    protected function setUp(): void
    {
        $this->factory = new ShippingFactory();
        $this->package = $this->makeDtoShippingPackage();
        $this->correiosCalculated = $this->makeCalculatedResponseCorreiosMock();
    }

    public function testGetShippingCalculatedCorreios()
    {
        $calculated = $this->factory->getShippingCalculatedCorreios($this->package, $this->correiosCalculated);
        $this->assertInstanceOf(ShippingCalculatedDTO::class, $calculated);
        $this->assertEquals('Correios', $calculated->shippingCompany);
        $this->assertEquals('PAC', $calculated->serviceType);
        $this->assertEquals(6, $calculated->deliveryTimeInDays);
        $this->assertEquals(105.7, $calculated->price);
        $this->assertEquals(20, $calculated->height);
        $this->assertEquals(10, $calculated->width);
        $this->assertEquals(15, $calculated->length);
        $this->assertEquals(1, $calculated->grossWeight);
    }

    public function testFactoryShippingPackageDtoFromItemStock()
    {
        $calculated = $this->factory->factoryShippingPackageDtoFromItemStock($this->makeDtoProductStockTest74());
        $this->assertInstanceOf(ShippingPackageDTO::class, $calculated);
        $this->assertEquals(1500, $calculated->getGrossWeight());
        $this->assertEquals(5, $calculated->getHeight());
        $this->assertEquals(15, $calculated->getWidth());
        $this->assertEquals(10, $calculated->getLength());

    }
}