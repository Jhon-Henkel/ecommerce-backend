<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\AddressDTO;
use src\Factory\AddressDtoFactory;
use tests\Traits\AddressTraits;

class AddressDtoFactoryUnitTest  extends TestCase
{
    use AddressTraits;

    public \stdClass $stdItem;
    public AddressDTO $dtoItem;
    public array $dbItem;
    public AddressDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdItem = $this->makeStdAddressTest1234();
        $this->dtoItem = $this->makeDtoAddressTest1234();
        $this->dbItem = $this->makeDbAddressTest1234();
        $this->factory = new AddressDtoFactory();
    }

    public function testFactory(): void
    {
        $item = $this->factory->factory($this->stdItem);
        $this->assertInstanceOf(AddressDTO::class, $item);
        $this->assertEquals(1234 ,$item->getId());
        $this->assertEquals(899 ,$item->getClientId());
        $this->assertEquals(88 ,$item->getNumber());
        $this->assertEquals('Reference' ,$item->getReference());
        $this->assertEquals('State' ,$item->getState());
        $this->assertEquals('City' ,$item->getCity());
        $this->assertEquals('District' ,$item->getDistrict());
        $this->assertEquals('Complement' ,$item->getComplement());
        $this->assertEquals('88780-000' ,$item->getZipCode());
        $this->assertEquals('Street' ,$item->getStreet());
    }

    public function testMakePublic(): void
    {
        $item = $this->factory->makePublic($this->dtoItem);
        $this->assertInstanceOf(\stdClass::class, $item);
        $this->assertEquals(1234 ,$item->id);
        $this->assertEquals(899 ,$item->clientId);
        $this->assertEquals(88 ,$item->number);
        $this->assertEquals('Reference' ,$item->reference);
        $this->assertEquals('State' ,$item->state);
        $this->assertEquals('City' ,$item->city);
        $this->assertEquals('District' ,$item->district);
        $this->assertEquals('Complement' ,$item->complement);
        $this->assertEquals('88780-000' ,$item->zipCode);
        $this->assertEquals('Street' ,$item->street);
    }

    public function testPopulateDbToDto(): void
    {
        $item = $this->factory->populateDbToDto($this->dbItem);
        $this->assertInstanceOf(AddressDTO::class, $item);
        $this->assertEquals(1234 ,$item->getId());
        $this->assertEquals(899 ,$item->getClientId());
        $this->assertEquals(88 ,$item->getNumber());
        $this->assertEquals('Reference' ,$item->getReference());
        $this->assertEquals('State' ,$item->getState());
        $this->assertEquals('City' ,$item->getCity());
        $this->assertEquals('District' ,$item->getDistrict());
        $this->assertEquals('Complement' ,$item->getComplement());
        $this->assertEquals('88780-000' ,$item->getZipCode());
        $this->assertEquals('Street' ,$item->getStreet());
    }
}