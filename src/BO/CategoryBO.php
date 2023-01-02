<?php

namespace src\BO;

use src\DAO\CategoryDAO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeNotFoundException;
use src\Factory\CategoryDtoFactory;

class CategoryBO extends BasicBO
{
    public CategoryDAO $dao;
    public CategoryDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new CategoryDAO(TableEnum::CATEGORY);
        $this->factory = new CategoryDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $object): void
    {
        parent::validatePostParamsApi($paramsFields, $object);
        if (isset($object->fatherId) && !$this->dao->findById($object->fatherId)) {
            throw new AttributeNotFoundException(FieldsEnum::FATHER_ID_JSON);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $object): void
    {
        parent::validatePutParamsApi($paramsFields, $object);
        if (isset($object->fatherId) && !$this->dao->findById($object->fatherId)) {
            throw new AttributeNotFoundException(FieldsEnum::FATHER_ID_JSON);
        }
    }
}