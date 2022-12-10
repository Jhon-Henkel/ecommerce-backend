<?php

namespace src\Controllers;

use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Tools\RequestTools;

class BasicController
{
    public function apiPost(\stdClass $object)
    {
        $this->bo->validatePostParamsApi($this->fieldsToValidate, $object);
        $categoryToInsert = $this->factory->factory($object);
        $this->bo->insert($categoryToInsert);
        $inserted = $this->bo->findLastInserted();
        Response::Render(HttpStatusCodeEnum::HTTP_CREATED, $this->factory->makePublic($inserted));
    }

    public function apiPut(\stdClass $object)
    {
        $object->id = (int)RequestTools::inputGet(FieldsEnum::ID);
        $this->bo->validatePutParamsApi($this->fieldsToValidate, $object);
        $categoryToUpdate = $this->factory->factory($object);
        $this->bo->update($categoryToUpdate);
        Response::Render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($categoryToUpdate));
    }

    public function apiGet(int $id)
    {
        $item = $this->bo->findById($id);
        if ($item){
            Response::Render(HttpStatusCodeEnum::HTTP_OK, $this->factory->makePublic($item));
        }
        Response::RenderNotFound();
    }

    public function apiIndex()
    {
        $itens = $this->bo->findAll();
        Response::Render(HttpStatusCodeEnum::HTTP_OK, $itens);
    }

    public function apiDelete(int $id)
    {
        $this->bo->deleteById($id);
        Response::Render(HttpStatusCodeEnum::HTTP_OK, 'Ok');
    }
}