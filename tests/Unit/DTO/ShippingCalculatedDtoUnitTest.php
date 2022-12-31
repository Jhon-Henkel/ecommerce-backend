<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ShippingCalculatedDTO;

class ShippingCalculatedDtoUnitTest extends TestCase
{
    public function testShippingCalculatedDto()
    {
        $calculated = new ShippingCalculatedDTO();
        $calculated->setGrossWeight(1);
        $calculated->setHeight(2);
        $calculated->setLength(3);
        $calculated->setWidth(4);
        $calculated->setPrice(5.67);
        $calculated->setDeliveryTimeInDays(8);
        $calculated->setServiceType('PAC');
        $calculated->setShippingCompany('Correios');
        $this->assertEquals(1, $calculated->getGrossWeight());
        $this->assertEquals(2, $calculated->getHeight());
        $this->assertEquals(3, $calculated->getLength());
        $this->assertEquals(4, $calculated->getWidth());
        $this->assertEquals(5.67, $calculated->getPrice());
        $this->assertEquals(8, $calculated->getDeliveryTimeInDays());
        $this->assertEquals('PAC', $calculated->getServiceType());
        $this->assertEquals('Correios', $calculated->getShippingCompany());
    }
}