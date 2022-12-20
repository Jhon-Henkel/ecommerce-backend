<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\ClientDAO;
use src\DTO\AddressDTO;
use src\DTO\ClientDTO;
use src\Enums\DocumentEnum;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Factory\AddressDtoFactory;
use src\Factory\ClientDtoFactory;
use src\Tools\CpfTools;
use src\Tools\ValidateTools;

class ClientBO extends BasicBO
{
    public ClientDAO $dao;
    public ClientDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ClientDAO(TableEnum::CLIENT);
        $this->factory = new ClientDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $client): void
    {
        $paramsFields = array_merge($paramsFields, array(FieldsEnum::ADDRESS));
        $this->validateFieldsExist($paramsFields, $client);
        $this->validateClientDataApi($client);
        $this->validateItemValueMustNotExistsInDb(FieldsEnum::getClientRequiredFieldsMustNotExistsInDb(), $client);
    }

    public function validateAddressInClientInsert(\stdClass $address):void
    {
        $addressBO = new AddressBO();
        $addressBO->validateFieldsExist(FieldsEnum::getAddressRequiredFieldsInClientInsert(), $address);
    }

    public function validateDocumentType(int $documentType): bool
    {
        return in_array($documentType, DocumentEnum::getDocumentTypesArray());
    }

    public function validateDocument(string $document, int $type): bool
    {
        if ($type == DocumentEnum::CPF) {
            return CpfTools::validate($document);
        }
        return false;
    }

    public function validateClientDataApi(\stdClass $client): void
    {
        if (!$this->validateDocumentType($client->documentType)) {
            Response::renderInvalidFieldValue(FieldsEnum::DOCUMENT_TYPE_JSON);
        }
        if (!$this->validateDocument($client->document, $client->documentType)) {
            Response::renderInvalidFieldValue(FieldsEnum::DOCUMENT);
        }
        if (!ValidateTools::validateEmail($client->email)) {
            Response::renderInvalidFieldValue(FieldsEnum::EMAIL);
        }
    }

    public function factoryAddressToInsertInClient(\stdClass $address, int $clientId): AddressDTO
    {
        $addressDtoFactory = new AddressDtoFactory();
        $address->clientId = $clientId;
        return $addressDtoFactory->factory($address);
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            Response::renderNotFound();
        }
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateClientDataApi($item);
        $fields = FieldsEnum::getClientRequiredFieldsMustNotExistsInDb();
        $this->validateItemValueMustNotExistsInDbExceptId($fields, $item, $item->id);
    }

    public function findById(int $id): \stdClass|null
    {
        $client = parent::findById($id);
        if (!$client) {
            return null;
        }
        $addressBO = new AddressBO();
        $addresses = $addressBO->findByClientId($id);
        return $this->factoryClientWithAddressesPublic($client, $addresses);
    }

    public function factoryClientWithAddressesPublic(ClientDTO $client, array $addresses): \stdClass
    {
        $addressBO = new AddressBO();
        $publicAddresses = array();
        foreach ($addresses as $address) {
            $publicAddresses[] = $addressBO->factory->makePublic($address);
        }
        return $this->factory->factoryClientWithAddressesPublic($client, $publicAddresses);
    }

    public function findAll(): array
    {
        $addressBO = new AddressBO();
        $clients = parent::findall();
        $clientWhitAddresses = array();
        foreach ($clients as $client) {
            $addresses = $addressBO->findByClientId($client->id);
            $client = $this->factory->factory($client);
            $clientWhitAddresses[] = $this->factoryClientWithAddressesPublic($client, $addresses);
        }
        return $clientWhitAddresses;
    }

    public function deleteById(int $id): void
    {
        $addressBO = new AddressBO();
        $addressBO->deleteAddressesByClientId($id);
        parent::deleteById($id);
    }
}