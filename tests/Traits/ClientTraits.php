<?php

namespace tests\Traits;

use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;

trait ClientTraits
{
    public function makeDtoClientTest741(): ClientDTO
    {
        $client = new ClientDTO();
        $client->setId(741);
        $client->setPassword('12345678');
        $client->setBirthDate(new \DateTime('1995-12-10'));
        $client->setEmail('test@testmail.com');
        $client->setSecondPhone('(48)98475-5588');
        $client->setMainPhone('(48)99655-4577');
        $client->setDocument('985.785.258-88');
        $client->setDocumentType(DocumentEnum::CPF);
        $client->setName('Fulaninho da Silva');
        $client->setCreatedAt(new \DateTime('2022-10-01'));
        $client->setUpdatedAt(new \DateTime('2022-11-10'));
        return $client;
    }
}