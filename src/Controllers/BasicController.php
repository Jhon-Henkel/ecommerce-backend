<?php

namespace src\Controllers;

use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyExistsException;
use src\Exceptions\AttributesExceptions\AttributeAlreadyLinkedInProduct;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\AttributesExceptions\RequiredAttributesMissingException;
use src\Exceptions\ClientExceptions\CartOpenForThisClientException;
use src\Exceptions\FieldsExceptions\InvalidFieldValueException;
use src\Exceptions\FieldsExceptions\InvalidUseForFieldException;
use src\Exceptions\GenericExceptions\NotFoundException;
use src\Tools\RequestTools;

abstract class BasicController
{
    public abstract function __construct();

    public function apiPost(\stdClass $object)
    {
        try {
            $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
            $itemToInsert = $this->factory->factory($object);
            $this->bo->insert($itemToInsert);
            $inserted = $this->bo->findLastInserted();
            Response::render(HttpStatusCodeEnum::HTTP_CREATED, $this->factory->makePublic($inserted));
        } catch (AttributeNotFoundException $exception) {
            Response::renderAttributeNotFound($exception->getMessage());
        } catch (CartOpenForThisClientException $exception) {
            Response::renderCartOpenForThisClient();
        } catch (InvalidUseForFieldException $exception) {
            Response::renderInvalidUseForField($exception->getMessage());
        } catch (AttributeAlreadyExistsException $exception) {
            Response::renderAttributeAlreadyExists($exception->getMessage());
        } catch (InvalidFieldValueException $exception) {
            Response::renderInvalidFieldValue($exception->getMessage());
        } catch (RequiredAttributesMissingException $exception) {
            Response::renderRequiredAttributesMissing();
        }
    }

    public function apiPut(\stdClass $object)
    {
        try {
            $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
            $this->bo->validatePutParamsApi($this->fieldsToValidate, $object);
            $itemToUpdate = $this->factory->factory($object);
            $this->bo->update($itemToUpdate);
            Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
        } catch (AttributeNotFoundException $exception) {
            Response::renderAttributeNotFound($exception->getMessage());
        } catch (InvalidFieldValueException $exception) {
            Response::renderInvalidFieldValue($exception->getMessage());
        } catch (NotFoundException $exception) {
            Response::renderNotFound();
        } catch (AttributeAlreadyExistsException $exception) {
            Response::renderAttributeAlreadyExists($exception->getMessage());
        } catch (RequiredAttributesMissingException $exception) {
            Response::renderRequiredAttributesMissing();
        }
    }

    public function apiGet(int $id)
    {
        $item = $this->bo->findById($id);
        if ($item){
            Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($item));
        }
        Response::renderNotFound();
    }

    public function apiIndex()
    {
        $itens = $this->bo->findAll();
        Response::render(HttpStatusCodeEnum::HTTP_OK, $itens);
    }

    public function apiDelete(int $id)
    {
        try {
            $this->bo->deleteById($id);
            Response::render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
        } catch (AttributeAlreadyLinkedInProduct $exception) {
            Response::renderAttributeAlreadyLinkedInProduct();
        }
    }
}