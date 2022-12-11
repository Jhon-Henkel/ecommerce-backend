<?php

namespace src\BO;

use src\Api\Response;
use src\Enums\FieldsEnum;
use src\Tools\ValidateTools;

abstract class BasicBO
{
    abstract public function __construct();

    public function validateFieldsExist(array $paramsFields, \stdClass $item): void
    {
        if (!ValidateTools::validateParamsFieldsInArray($paramsFields, (array)$item)) {
            Response::RenderRequiredAttributesMissing();
        }
    }

    public function deleteById(int $id): void
    {
        $this->dao->deleteById($id);
    }

    public function findById(int $id)
    {
        $item = $this->dao->findById($id);
        return $item ? $this->factory->populateDbToDto($item) : null;
    }

    public function countById(int $id): int
    {
        return $this->dao->countByColumnValue(FieldsEnum::ID, $id);
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

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateItemValueMustNotExistsInDb($paramsFields, $item);
    }

    public function insert($item): void
    {
        $columns = $this->dao->getColumnsToInsert();
        $values = $this->dao->getParamsStringToInsert();
        $params = $this->dao->getParamsArrayToInsert($item);
        $this->dao->insert($columns, $values, $params);
    }

    public function update($item)
    {
        $values = $this->dao->getUpdateSting();
        $where = $this->dao->getWhereClausuleToUpdate();
        $params = $this->dao->getParamsArrayToUpdate($item);
        $this->dao->update($values, $where, $params);
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $item->id)) {
            Response::RenderNotFound();
        }
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateItemValueMustNotExistsInDbExceptId($paramsFields, $item, $item->id);
    }

    public function validateItemValueShouldExistsInDb(array $shouldExists, \stdClass $item): void
    {
        foreach ($shouldExists as $field) {
            if (!$this->dao->countByColumnValue($field, $item->$field)) {
                Response::RenderAttributeNotFound($field . " " . $item->$field);
            }
        }
    }

    public function validateItemValueMustNotExistsInDb(array $mustNotExists, \stdClass $item): void
    {
        foreach ($mustNotExists as $paramField) {
            if ($this->dao->countByColumnValue($paramField, $item->$paramField)) {
                Response::RenderAttributeAlreadyExists($paramField);
            }
        }
    }

    public function validateItemValueMustNotExistsInDbExceptId(array $mustNotExists, \stdClass $item, int $id): void
    {
        foreach ($mustNotExists as $paramField) {
            if ($this->dao->countByColumnValueExceptId($paramField, $item->$paramField, $id)) {
                Response::RenderAttributeAlreadyExists($paramField);
            }
        }
    }
}