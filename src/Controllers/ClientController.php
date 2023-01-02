<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\AddressBO;
use src\BO\ClientBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyExistsException;
use src\Exceptions\FieldsExceptions\InvalidFieldValueException;
use src\Factory\ClientDtoFactory;

class ClientController extends BasicController
{
    public ClientBO $bo;
    public ClientDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new ClientBO();
        $this->factory = new ClientDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getClientRequiredFields();
    }

    public function apiPost(\stdClass $object)
    {
        try {
            $addressBO = new AddressBO();
            $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
            $this->bo->validateAddressInClientInsert($object->address);
            $clientToInsert = $this->factory->factory($object);
            $this->bo->insert($clientToInsert);
            $clientInserted = $this->bo->findLastInserted();
            $addressToInsert = $this->bo->factoryAddressToInsertInClient($object->address, $clientInserted->getId());
            $addressBO->insert($addressToInsert);
            $addressInserted = $addressBO->findLastInserted();
            $clientWithAddress = $this->factory->factoryClientWithAddress($clientInserted, $addressInserted);
            Response::render(HttpStatusCodeEnum::HTTP_CREATED, $clientWithAddress);
        } catch (InvalidFieldValueException $exception) {
            Response::renderInvalidFieldValue($exception->getMessage());
        } catch (AttributeAlreadyExistsException $exception) {
            Response::renderAttributeAlreadyExists($exception->getMessage());
        }
    }

    public function apiGet(int $id)
    {
        $client = $this->bo->findById($id);
        if (!$client){
            Response::renderNotFound();
        }
        Response::render(HttpStatusCodeEnum::HTTP_OK, $client);
    }

    public function apiIndex()
    {
        Response::render(HttpStatusCodeEnum::HTTP_OK, $this->bo->findAll());
    }
}