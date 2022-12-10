<?php

namespace src\BO;

use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Tools\ValidateTools;

abstract class BasicBO
{
    abstract public function __construct();

    public function validateFields(array $paramsFields, \stdClass $category): void
    {
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$category)) {
            Response::RenderRequiredAttributesMissing();
        }
    }

    public function deleteById(int $id)
    {
        $this->dao->deleteById($id);
    }

    public function findById(int $id)
    {
        $item = $this->dao->findById($id);
        return $item ? $this->factory->populateDbToDto($item) : null;
    }

    public function findAll()
    {
        $item =  $this->dao->findAll();
        if (!$item) {
            return null;
        }
        return $this->factory->makeItensPublic($item);
    }

    public function findLastInserted()
    {
        $search = $this->dao->findLastInserted();
        return $this->factory->populateDbToDto($search);
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $object): void
    {
        $this->validateFields($paramsFields, $object);
        if ($this->dao->findByCode($object->code)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByName($object->name)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $object): void
    {
        $this->validateFields($paramsFields, $object);
        if (!$this->dao->findById($object->id)) {
            Response::RenderNotFound();
        }
        if ($this->dao->findByCodeExceptId($object->code, $object->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::CODE);
        }
        if ($this->dao->findByNameExceptId($object->name, $object->id)) {
            Response::RenderAttributeAlreadyExists(FieldsEnum::NAME);
        }
    }
}