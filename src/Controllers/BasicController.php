<?php

namespace src\Controllers;

use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Exceptions\ClientExceptions\CartOpenForThisClientException;
use src\Exceptions\FieldsExceptions\InvalidUseForFieldException;
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
        }
    }

    public function apiPut(\stdClass $object)
    {
        $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $this->bo->validatePutParamsApi($this->fieldsToValidate, $object);
        $itemToUpdate = $this->factory->factory($object);
        $this->bo->update($itemToUpdate);
        Response::render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($itemToUpdate));
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
        $this->bo->deleteById($id);
        Response::render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
    }
}