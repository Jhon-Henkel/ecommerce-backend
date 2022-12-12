<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\CategoryDAO;
use src\Enums\ApiResponseMessageEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Enums\TableEnum;
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
            $statusCode = HttpStatusCodeEnum::HTTP_NOT_FOUND;
            $message = ApiResponseMessageEnum::FATHER_CATEGORY_NOT_FOUND;
            Response::render($statusCode, $message);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $object): void
    {
        parent::validatePutParamsApi($paramsFields, $object);
        if (isset($object->fatherId) && !$this->dao->findById($object->fatherId)) {
            $statusCode = HttpStatusCodeEnum::HTTP_NOT_FOUND;
            $message = ApiResponseMessageEnum::FATHER_CATEGORY_NOT_FOUND;
            Response::render($statusCode, $message);
        }
    }
}