<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;
use src\Tools\DateTools;
use src\Tools\SecurityTools;

class ClientDtoUnitTest extends TestCase
{
    public object $client;

    protected function setUp(): void
    {
        $this->client = new ClientDTO();
    }

    public function testGettersAndSettersClient()
    {
        $pass = SecurityTools::strEncryptAes('passTest123');
        $this->client->setId(741);
        $this->client->setPassword($pass);
        $this->client->setBirthDate(new \DateTime('1995-12-10'));
        $this->client->setEmail('test@testmail.com');
        $this->client->setSecondPhone('(48)98475-5588');
        $this->client->setMainPhone('(48)99655-4577');
        $this->client->setDocument('985.785.258-88');
        $this->client->setDocumentType(DocumentEnum::CPF);
        $this->client->setName('Fulaninho da Silva');
        $this->client->setCreatedAt(new \DateTime('2022-10-01'));
        $this->client->setUpdatedAt(new \DateTime('2022-11-10'));
        $this->assertEquals(741, $this->client->getId());
        $this->assertEquals($pass, $this->client->getPassword());
        $this->assertEquals('1995-12-10', DateTools::dateTimeToStringConverter($this->client->getBirthDate()));
        $this->assertEquals('test@testmail.com', $this->client->getEmail());
        $this->assertEquals('(48)98475-5588', $this->client->getSecondPhone());
        $this->assertEquals('(48)99655-4577', $this->client->getMainPhone());
        $this->assertEquals('985.785.258-88', $this->client->getDocument());
        $this->assertEquals(DocumentEnum::CPF, $this->client->getDocumentType());
        $this->assertEquals('Fulaninho da Silva', $this->client->getName());
        $this->assertEquals('2022-10-01', DateTools::dateTimeToStringConverter($this->client->getCreatedAt()));
        $this->assertEquals('2022-11-10', DateTools::dateTimeToStringConverter($this->client->getUpdatedAt()));
    }
}