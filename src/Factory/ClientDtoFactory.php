<?php

namespace src\Factory;

use src\DTO\AddressDTO;
use src\DTO\ClientDTO;
use src\Tools\DateTools;

class ClientDtoFactory extends BasicDtoFactory
{
    public function factory(\stdClass $item): ClientDTO
    {
        $client = new ClientDTO();
        $client->setId($item->id ?? null);
        $client->setName($item->name);
        $client->setDocumentType($item->documentType);
        $client->setDocument($item->document);
        $client->setMainPhone($item->mainPhone ?? null);
        $client->setSecondPhone($item->secondPhone ?? null);
        $client->setEmail($item->email);
        $client->setBirthDate(DateTools::dateTimeConverter($item->birthDate));
        $client->setPassword($item->password);
        return $client;
    }

    /**
     * @param ClientDTO $item
     * @return \stdClass
     */
    public function makePublic($item): \stdClass
    {
        $client = new \stdClass();
        $client->id = $item->getId();
        $client->name = $item->getName();
        $client->documentType = $item->getDocumentType();
        $client->document = $item->getDocument();
        $client->mainPhone = $item->getMainPhone();
        $client->secondPhone = $item->getSecondPhone();
        $client->email = $item->getEmail();
        $client->birthDate = DateTools::dateTimeToString($item->getBirthDate());
        $client->password = $item->getPassword();
        return $client;
    }

    public function populateDbToDto(array $item): ClientDTO
    {
        $client = new ClientDTO();
        $client->setId($item['client_id']);
        $client->setName($item['client_name']);
        $client->setDocumentType($item['client_document_type']);
        $client->setDocument($item['client_document']);
        $client->setMainPhone($item['client_main_phone']);
        $client->setSecondPhone($item['client_second_phone']);
        $client->setEmail($item['client_email']);
        $client->setBirthDate(DateTools::dateTimeConverter($item['client_birth_date']));
        $client->setPassword($item['client_password']);
        return $client;
    }

    public function factoryClientWithAddress(ClientDTO $client, AddressDTO $address): \stdClass
    {
        $addressFactory = new AddressDtoFactory();
        $client = $this->makePublic($client);
        $client->address = $addressFactory->makePublic($address);
        return $client;
    }

    public function factoryClientWithAddressesPublic(ClientDTO $client, array $addresses): \stdClass
    {
        $clientFactored = $this->makePublic($client);
        $clientFactored->address = $addresses;
        return $clientFactored;
    }
}