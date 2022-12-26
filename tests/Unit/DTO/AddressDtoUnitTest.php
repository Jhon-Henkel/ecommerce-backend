<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\AddressDTO;
use src\Tools\DateTools;

class AddressDtoUnitTest extends TestCase
{
    public object $address;

    protected function setUp(): void
    {
        $this->address = new AddressDTO();
    }

    public function testGettersAndSettersAddress()
    {
        $this->address->setId(1234);
        $this->address->setClientId(899);
        $this->address->setNumber(88);
        $this->address->setReference('Reference');
        $this->address->setState('State');
        $this->address->setCity('City');
        $this->address->setDistrict('District');
        $this->address->setComplement('Complement');
        $this->address->setZipCode('88780-000');
        $this->address->setStreet('Street');
        $this->address->setCreatedAt(new \DateTime('2022-10-01'));
        $this->address->setUpdatedAt(new \DateTime('2022-11-10'));
        $this->assertEquals(1234, $this->address->getId());
        $this->assertEquals(899, $this->address->getClientId());
        $this->assertEquals(88, $this->address->getNumber());
        $this->assertEquals('Reference', $this->address->getReference());
        $this->assertEquals('State', $this->address->getState());
        $this->assertEquals('City', $this->address->getCity());
        $this->assertEquals('District', $this->address->getDistrict());
        $this->assertEquals('Complement', $this->address->getComplement());
        $this->assertEquals('88780-000', $this->address->getZipCode());
        $this->assertEquals('Street', $this->address->getStreet());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($this->address->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($this->address->getUpdatedAt()));
    }
}