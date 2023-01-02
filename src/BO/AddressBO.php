<?php

namespace src\BO;

use src\DAO\AddressDAO;
use src\DAO\ClientDAO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Factory\AddressDtoFactory;

class AddressBO extends BasicBO
{
    public AddressDAO $dao;
    public AddressDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new AddressDAO(TableEnum::ADDRESS);
        $this->factory = new AddressDtoFactory();
    }

    public function findByClientId(int $id): null|array
    {
        $addresses = $this->dao->findByClientId($id);
        $addressesFind = array();
        foreach ($addresses as $address) {
            $addressesFind[] = $this->factory->populateDbToDto($address);
        }
        return $addressesFind;
    }

    public function deleteAddressesByClientId(int $id): void
    {
        $this->dao->deleteByClientId($id);
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateClientExistsForApiById($item->clientId);
    }

    public function validateClientExistsForApiById(int $id): void
    {
        $clientDAO = new ClientDAO(TableEnum::CLIENT);
        if (!$clientDAO->countByColumnValue(FieldsEnum::ID, $id)) {
            throw new AttributeNotFoundException(FieldsEnum::CLIENT_ID_JSON);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            throw new NotFoundException();
        }
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateClientExistsForApiById($item->clientId);
    }

    public function validateAddressExistsById(int $addressId): bool
    {
        $addressBO = new AddressBO();
        $address = $addressBO->countById($addressId);
        if (!$address) {
            return false;
        }
        return true;
    }
}