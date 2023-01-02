<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;
use src\Factory\ClientDtoFactory;
use stdClass;
use tests\Traits\AddressTraits;
use tests\Traits\ClientTraits;
use src\Tools\DateTools;

class ClientDtoFactoryUnitTest extends TestCase
{
    use ClientTraits, AddressTraits;

    public ClientDtoFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new ClientDtoFactory();
    }

    public function testFactory()
    {
        $client = $this->factory->factory($this->makeStdClientTest741());
        $this->assertInstanceOf(ClientDTO::class, $client);
        $this->assertEquals(741, $client->getId());
        $this->assertEquals('Fulaninho da Silva', $client->getName());
        $this->assertEquals(DocumentEnum::CPF, $client->getDocumentType());
        $this->assertEquals('985.785.258-88', $client->getDocument());
        $this->assertEquals('(48)99655-4577', $client->getMainPhone());
        $this->assertEquals('(48)98475-5588', $client->getSecondPhone());
        $this->assertEquals('test@testmail.com', $client->getEmail());
        $this->assertEquals('1995-12-10', DateTools::dateTimeToStringConverter($client->getBirthDate()));
        $this->assertEquals('12345678', $client->getPassword());
    }

    public function testMakePublic()
    {
        $client = $this->factory->makePublic($this->makeDtoClientTest741());
        $this->assertInstanceOf(stdClass::class, $client);
        $this->assertEquals(741, $client->id);
        $this->assertEquals('Fulaninho da Silva', $client->name);
        $this->assertEquals(DocumentEnum::CPF, $client->documentType);
        $this->assertEquals('985.785.258-88', $client->document);
        $this->assertEquals('(48)99655-4577', $client->mainPhone);
        $this->assertEquals('(48)98475-5588', $client->secondPhone);
        $this->assertEquals('test@testmail.com', $client->email);
        $this->assertEquals('1995-12-10', $client->birthDate);
        $this->assertEquals('12345678', $client->password);
    }

    public function testPopulateDbToDto()
    {
        $client = $this->factory->populateDbToDto($this->makeDbClientTest741());
        $this->assertInstanceOf(ClientDTO::class, $client);
        $this->assertEquals(741, $client->getId());
        $this->assertEquals('Fulaninho da Silva', $client->getName());
        $this->assertEquals(DocumentEnum::CPF, $client->getDocumentType());
        $this->assertEquals('985.785.258-88', $client->getDocument());
        $this->assertEquals('(48)99655-4577', $client->getMainPhone());
        $this->assertEquals('(48)98475-5588', $client->getSecondPhone());
        $this->assertEquals('test@testmail.com', $client->getEmail());
        $this->assertEquals('1995-12-10', DateTools::dateTimeToStringConverter($client->getBirthDate()));
        $this->assertEquals('12345678', $client->getPassword());
    }

    public function testFactoryClientWithAddress()
    {
        $client = $this->factory->factoryClientWithAddress($this->makeDtoClientTest741(), $this->makeDtoAddressTest1234());
        $this->assertInstanceOf(stdClass::class, $client);
        $this->assertTrue(isset($client->address));
        $this->assertInstanceOf(stdClass::class, $client->address);
    }

    public function testFactoryClientWithAddressesPublic()
    {
        $client = $this->factory->factoryClientWithAddressesPublic($this->makeDtoClientTest741(), $this->makeDbAddressTest1234());
        $this->assertInstanceOf(stdClass::class, $client);
        $this->assertTrue(isset($client->address));
        $this->assertIsArray($client->address);
    }
}